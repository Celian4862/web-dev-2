<?php
    session_start();
    if (isset($_SESSION['username'])) { ?>
        <!DOCTYPE html>
        <html>
            <head>
                <title>Dashboard - A&ccedil;a&iacute;</title>
                <?php require "./components/head/head.html" ?>
            </head>
            <body>
                <?php require "./components/nav/nav.html"; ?>
                <div class="container mt-5">
                    <h2 class="text-center">Dashboard</h2>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <p>Welcome, <?php echo $_SESSION['username']; ?>!</p>
                            <a href="./assets/processing_php/logout.php" class="btn btn-primary">Log out</a>
                        </div>
                    </div>
                </div>
            </body>
        </html>
    <?php } else {
        header("Location: ./login.php");
        exit();
    }