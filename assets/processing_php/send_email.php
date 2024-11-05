<?php
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
                $stmt = $conn->prepare("UPDATE accounts SET reset_token = ?, token_expiry = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = ?");
                $stmt->bind_param("ss", $token, $email);
                $stmt->execute();

                // Send reset password email
                $resetLink = "localhost/web-dev-2/reset_password.php?token={$token}";
                $subject = "Password Reset Request";
                $message = "Click the following link to reset your password: {$resetLink}";
                $headers = "From: no-reply@yourwebsite.com";

                if (mail($email, $subject, $message, $headers)) {
                    header("Location: ./../../fpass.php?status=sent");
                } else {
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