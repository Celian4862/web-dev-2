<?php
    switch ($_SERVER["REQUEST_METHOD"]) {
        case "POST":
            include "./../SQL_queries/accounts.php";
            require "./../../components/session_details.php";
            require "./config.php";

            array_map(function ($key) {
                $_SESSION[$key] = $_POST[$key];
            }, ['username', 'email', 'dob']);
            array_map(function ($key) use (&$username, &$email, &$birthdate) {
                $_SESSION[$key] = $$key = $_POST[$key];
            }, ['username', 'email', 'dob']);
            $password = $_POST['password'];
            $flag = false;

            // For displaying errors
            array_map(function($key) {
                $_SESSION[$key] = false;
            }, ['email_exists', 'name_exists', 'invalid_email', 'invalid_name', 'invalid_password', 'password_nomatch']);

            // Server-side validation
            // First section: check if email and username already exist
            $checkEmailSql = "SELECT id FROM accounts WHERE email = ?";
            $checkEmailStmt = $conn->prepare($checkEmailSql);
            $checkEmailStmt->bind_param("s", $email);
            $checkEmailStmt->execute();
            $checkEmailStmt->store_result();

            if ($checkEmailStmt->num_rows > 0) {
                $flag = $_SESSION['email_exists'] = true;
                unset($_SESSION['email']);
            }
            $checkEmailStmt->close();

            $checkUsernameSql = "SELECT id FROM accounts WHERE username = ?";
            $checkUsernameStmt = $conn->prepare($checkUsernameSql);
            $checkUsernameStmt->bind_param("s", $username);
            $checkUsernameStmt->execute();
            $checkUsernameStmt->store_result();

            if ($checkUsernameStmt->num_rows > 0) {
                $flag = $_SESSION['name_exists'] = true;
                unset($_SESSION['username']);
            }
            $checkUsernameStmt->close();

            if ($flag) {
                $conn->close();
                header("Location: ./../../signup.php");
                exit();
            }

            // Second section: validate email, username, and password
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $flag = $_SESSION['invalid_email'] = true;
                unset($_SESSION['email']);
            }

            if (!preg_match("/^[a-zA-Z0-9_]+$/", $username)) {
                $flag = $_SESSION['invalid_name'] = true;
                unset($_SESSION['username']);
            }

            if (strlen($password) < 8 || !preg_match("/^(?=.*\w)(?=.*\d)(?=.*\W)[\w\d\W]{8,}$/", $password) && strlen($password) < 16) {
                $flag = $_SESSION['invalid_password'] = true;
            }

            if ($flag) {
                $conn->close();
                header("Location: ./../../signup.php");
                exit();
            }

            if ($password !== $_POST['confirm-password']) {
                $conn->close();
                $_SESSION['password_nomatch'] = true;
                header("Location: ./../../signup.php");
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
                $_SESSION['user'] = $conn->insert_id;
                header("Location: ./../../dashboard.php");
            } else {
                echo "Error: {$sql}<br>{$conn->error}";
                header("refresh:2;url=./../../signup.php");
            }
            $stmt->close();
            $conn->close();
            break;
        default:
            header("Location: ./../../signup.php");
    }