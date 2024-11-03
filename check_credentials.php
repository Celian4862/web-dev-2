<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require 'vendor/autoload.php';

        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        $servername = $_ENV['DB_SERVER'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];
        $dbname = $_ENV['DB_NAME'];

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

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
                    header("Location: ./dashboard.php");
                } else {
                    echo "Error: Incorrect password.";
                }
            } else {
                echo "Error: Account not found.";
            }

            $stmt->close();
        } else {
            echo "Error: Missing required fields.";
        }
    } else {
        header("Location: ./login.php");
    }