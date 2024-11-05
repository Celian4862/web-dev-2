<?php
    require "./components/session_details.php";
    if (!isset($_SESSION['user'])) {
        header("Location: ./login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard - A&ccedil;a&iacute;</title>
        <?php require "./components/head.html" ?>
    </head>
    <body>
        <?php require "./components/nav.php"; ?>
        <div class="container mt-5">
            <h2 class="text-center">Dashboard</h2>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <p>Welcome, <?php echo $_SESSION['username']; ?>!</p>
                </div>
            </div>
        </div>
    </body>
</html>