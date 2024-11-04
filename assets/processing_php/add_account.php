<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require "./../../components/session_details.php";

        require "./config.php";

        if (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['dob'])) {
            $_SESSION['_username'] = $_POST['username'];
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['dob'] = $_POST['dob'];
            $flag = false;
            $get_req = "?";

            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $birthdate = $_POST['dob'];

            // Server-side validation
            // First section: check if email and username already exist
            $checkEmailSql = "SELECT id FROM accounts WHERE email = ?";
            $checkEmailStmt = $conn->prepare($checkEmailSql);
            $checkEmailStmt->bind_param("s", $email);
            $checkEmailStmt->execute();
            $checkEmailStmt->store_result();

            if ($checkEmailStmt->num_rows > 0) {
                $flag = true;
                $get_req .= "email_exists&";
                unset($_SESSION['email']);
            }
            $checkEmailStmt->close();

            $checkUsernameSql = "SELECT id FROM accounts WHERE username = ?";
            $checkUsernameStmt = $conn->prepare($checkUsernameSql);
            $checkUsernameStmt->bind_param("s", $username);
            $checkUsernameStmt->execute();
            $checkUsernameStmt->store_result();

            if ($checkUsernameStmt->num_rows > 0) {
                $flag = true;
                $get_req .= "name_exists&";
                unset($_SESSION['_username']);
            }
            $checkUsernameStmt->close();

            if ($flag) {
                $conn->close();
                header("Location: ./../../signup.php{$get_req}");
                exit();
            }

            // Second section: validate email, username, and password
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $flag = true;
                $get_req .= "invalid_email&";
                unset($_SESSION['email']);
            }

            if (!preg_match("/^[a-zA-Z0-9_]+$/", $username)) {
                $flag = true;
                $get_req .= "invalid_name&";
                unset($_SESSION['_username']);
            }

            if (strlen($password) < 8 || !preg_match("/^(?=.*\w)(?=.*\d)(?=.*\W)[\w\d\W]{8,}$/", $password) && strlen($password) < 16) {
                $flag = true;
                $get_req .= "invalid_password&";
            }

            if ($flag) {
                $conn->close();
                header("Location: ./../../signup.php{$get_req}");
                exit();
            }

            if ($password !== $_POST['confirm-password']) {
                $conn->close();
                header("Location: ./../../signup.php?password_nomatch");
                exit();
            }

            $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
            $username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
            $password = password_hash(trim($password), PASSWORD_DEFAULT);

            $sql = "INSERT INTO accounts (email, username, password, birthdate) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $email, $username, $password, $birthdate);

            if ($stmt->execute()) {
                session_start();
                $_SESSION['username'] = $username;
                header("Location: ./../../dashboard.php");
            } else {
                echo "Error: {$sql}<br>{$conn->error}";
                header("refresh:2;url=./../../signup.php");
            }

            $stmt->close();
        }

        $conn->close();
    } else {
        header("Location: ./../../signup.php");
        exit();
    }