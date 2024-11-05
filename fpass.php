<?php
    require "./assets/components/session_details.php";

    if (isset($_SESSION['username'])) {
        header ("Location: ./dashboard.php");
        exit();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Forgot Password - A&ccedil;a&iacute;</title>
        <?php require "./components/head.html"; ?>
    </head>
    <body>
        <?php include "./components/nav.php";
            if (isset($_GET['status'])) {
                if ($_GET['status'] == 'sent') {
                    echo '<div class="alert alert-success">An email has been sent to your address.</div>';
                } else if ($_GET['status'] == 'fail') {
                    echo '<div class="alert alert-danger">Failed to send an email.</div>';
                }} ?>
        <div class="container">
            <h2>Forgot Password</h2>
            <form action="./assets/processing_php/send_email.php" method="post">
                <div class="form-group">
                    <label for="email">Email address:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                    <?php if (isset($_GET['status']) && $_GET['status'] == "email_not_found") {
                        echo "<div style='color: red;'>Email not found.</div>";
                    } ?>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </body>
</html>