<?php
    session_set_cookie_params([
        'lifetime' => 0, // Session cookie, expires when the browser closes
        'path' => '/',
        'secure' => true, // Only send cookie over HTTPS
        'httponly' => true // Prevent JavaScript access to the cookie
    ]);
    session_start();
    session_regenerate_id(false);

    if (isset($_SESSION['username'])) {
        header("Location: ./dashboard.php");
        exit();
    } ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login - A&ccedil;a&iacute;</title>
        <?php require "./components/head/head.html"; ?>
    </head>
    <body style="font-family: Poppins, serif;">
        <?php include "./components/nav/nav.html"; ?>
        <div class="container mt-5">
            <h2 class="text-center">Log In</h2>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <form action="./assets/processing_php/check_credentials.php" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                            <!-- DISPLAY ERROR MESSAGE -->
                            <?php if (isset($_GET["error"])) { ?>
                                <div class="form-text text-danger">Invalid email or password.</div>
                            <?php } ?>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Log In</button>
                            <a href="./signup.php" class="btn btn-outline-secondary">Create account</a>
                        </div>
                        <div class="text-center mt-3">
                            <a href="./fpass.php">Forgot password?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>