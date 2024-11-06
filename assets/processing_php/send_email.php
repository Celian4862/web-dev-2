<?php
    require './../../vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    switch ($_SERVER["REQUEST_METHOD"]) {
        case "POST":
            require "config.php";

            $email = $_POST['email'];
            // Check if email exists in the database
            $stmt = $conn->prepare("SELECT * FROM accounts WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Email exists, generate a unique token
                $token = bin2hex(random_bytes(50));
                $stmt = $conn->prepare("UPDATE accounts SET reset_token = ?, token_expiry = CONVERT_TZ(NOW(), @@session.time_zone, '+00:00') + INTERVAL 1 HOUR WHERE email = ?");
                $stmt->bind_param("ss", $token, $email);
                $stmt->execute();

                // Send reset password email using PHPMailer
                $resetLink = "localhost/web-dev-2/reset_password.php?token={$token}";
                $subject = "Password Reset Request";
                $message = "Click the following link to reset your password: {$resetLink}";

                $mail = new PHPMailer(true);
                try {
                    require './../../vendor/autoload.php';

                    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
                    $dotenv->load();
                    //Server settings
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = $_ENV['SENDER_EMAIL'];
                    $mail->Password = $_ENV['EMAIL_PASS'];
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;
            
                    //Recipients
                    $mail->setFrom('no-reply@acai.com', 'Acai');
                    $mail->addAddress($email);
            
                    //Content
                    $mail->isHTML(true);
                    $mail->Subject = $subject;
                    $mail->Body    = $message;
            
                    $mail->send();
                    header("Location: ./../../fpass.php?status=sent");
                } catch (Exception $e) {
                    header("Location: ./../../fpass.php?status=fail");
                }
            } else {
                header("Location: ./../../fpass.php?status=email_not_found");
            }
            $stmt->close();
            $conn->close();
            break;
        default:
            header("Location: ./../../fpass.php");
    }