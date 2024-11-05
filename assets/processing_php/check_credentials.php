<?php
    switch ($_SERVER["REQUEST_METHOD"]) {
        case "POST":
            include "./../SQL_queries/accounts.php";
            require "./../../components/session_details.php";
            require "config.php";

            if (isset($_POST['name_email']) && isset($_POST['password'])) {
                $_SESSION['name_email'] = $_POST['name_email'];
                $name_email = $_POST['name_email'];
                $password = $_POST['password'];

                $name_email = htmlspecialchars($name_email, ENT_QUOTES, 'UTF-8');

                $sql = "SELECT * FROM accounts WHERE email = ? OR username = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $name_email, $name_email);
                $stmt->execute();
                $result = $stmt->get_result();
                $user = $result->fetch_assoc();

                if ($user) {
                    if (password_verify($password, $user['password'])) {
                        session_start();
                        $_SESSION['user'] = $user['id'];
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['birthdate'] = $user['birthdate'];
                        header("Location: ./../../dashboard.php");
                    } else {
                        header("Location: ./../../login.php?invalid_pass");
                    }
                } else {
                    unset($_SESSION["name_email"]);
                    header("Location: ./../../login.php?invalid_user");
                }
                $stmt->close();
            } else {
                header("Location: ./../../login.php");
            }
            $conn->close();
            break;
        default:
            header("Location: ./../../login.php");
    }