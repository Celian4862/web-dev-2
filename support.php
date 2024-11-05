<?php
    require "./components/session_details.php";
    if (isset($_SESSION['user'])) {
        header ("Location: ./dashboard.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Support - A&ccedil;a&iacute;</title>
        <?php require "./components/head.html"; ?>
    </head>
    <body>
        <?php include "./components/nav.php"; ?>
        <div class="text-center">
            <h1>Need assistance?</h1>
            <p style="font-size: 150%;">Contact our support team using the details below!</p>
            <ul id="support-list">
                <li>support@acai.com
            </ul>
        </div>
    </body>
</html>
