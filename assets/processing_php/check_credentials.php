<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require "config.php";

        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');

            $sql = "SELECT * FROM accounts WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    session_start();
                    $_SESSION['username'] = $user['username'];
                    header("Location: ./../../dashboard.php");
                } else {
                    header("Location: ./../../login.php?error");
                }
            } else {
                header("Location: ./../../login.php?error");
            }
            $stmt->close();
        }
        $conn->close();
    } else {
        header("Location: ./login.php");
    }