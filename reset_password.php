<?php
    if (isset($_GET['token'])) {
        require './vendor/autoload.php';

        $dotenv = Dotenv\Dotenv::createImmutable('./assets/processing_php');
        $dotenv->load();

        $servername = $_ENV['DB_SERVER'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];
        $dbname = $_ENV['DB_NAME'];

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $token = $_GET['token'];

        // Prepare the SQL statement
        $stmt = $conn->prepare("SELECT * FROM accounts WHERE reset_token = ?");
        $stmt->bind_param("s", $token);

        // Execute the query
        $stmt->execute();

        // Fetch the result
        $result = $stmt->get_result();

        // Check if a row is returned
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $tokenExpiry = $row['token_expiry'];
?>
            <!DOCTYPE html>
            <html>
                <head>
                    <?php require "./components/head.html"; ?>
<?php
            // Check if the token expiry date has passed
            if (strtotime($tokenExpiry) < time()) {
                // Token has expired
?>
                    <title>Invalid Token</title>
                </head>
                <body>
                    <?php require "./components/nav.php"; ?>
                    <h2 class="text-center">Invalid token.</h2>
                </body>
<?php 
            } else {
                // Token is valid
?>
                    <title>Reset Password - A&ccedil;a&iacute;</title>
                </head>
                <body>
                    <div class="container mt-5">
                        <h2 class="text-center">Reset Password</h2>
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <form action="./assets/processing_php/update_pass.php" method="POST">
                                    <div class="mb-3">
                                        <label for="new-pass"></label>
                                        <!-- To be continued -->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </body>
<?php
            }
            echo "</html>";
        } else {
            // Token not found in database
            header('Location: ./index.php');
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    } else {
        header('Location: ./index.php');
    }