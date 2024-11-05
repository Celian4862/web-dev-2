<?php
    require "./components/session_details.php";
    if (!isset($_SESSION['username'])) {
        header("Location: ./login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <?php require "./components/head.html"; ?>
        <title>User Settings - A&ccedil;a&iacute;</title>
    </head>
    <body>
        <?php require "./components/nav.php"; ?>
        <form>
            <ul>
                <li>
                    <input type="text" />
                </li>
            </ul>
        </form>
    </body>
</html>