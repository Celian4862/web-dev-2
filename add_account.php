<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require "config.php";

        if (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['dob'])) {
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $birthdate = $_POST['dob'];

            // Server-side validation
            $checkEmailSql = "SELECT id FROM accounts WHERE email = ?";
            $checkEmailStmt = $conn->prepare($checkEmailSql);
            $checkEmailStmt->bind_param("s", $email);
            $checkEmailStmt->execute();
            $checkEmailStmt->store_result();

            if ($checkEmailStmt->num_rows > 0) {
                die("Email already exists.");
            }

            $checkEmailStmt->close();

            $checkUsernameSql = "SELECT id FROM accounts WHERE username = ?";
            $checkUsernameStmt = $conn->prepare($checkUsernameSql);
            $checkUsernameStmt->bind_param("s", $username);
            $checkUsernameStmt->execute();
            $checkUsernameStmt->store_result();

            if ($checkUsernameStmt->num_rows > 0) {
                die("Username already exists.");
            }

            $checkUsernameStmt->close();

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                die("Invalid email format");
            }

            if (!preg_match("/^[a-zA-Z0-9_]+$/", $username)) {
                die("Username can only contain letters, numbers, and underscores.");
            }

            $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
            $username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
            $password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO accounts (email, username, password, birthdate) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $email, $username, $password, $birthdate);

            if ($stmt->execute()) {
                header("Location: ./dashboard.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $stmt->close();
        } else {
            echo "Error: Missing required fields.";
        }

        $conn->close();
    } else {
        header("Location: ./signup.php");
        exit();
    }