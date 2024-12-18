<?php
    require "./components/session_details.php";
    if (isset($_SESSION['user'])) {
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
        <div class="container mt-5">
            <h2 class="text-center">Forgot Password</h2>
            <div class ="row justify-content-center">
                <div class="col-md-4">
                    <form action="./assets/processing_php/send_email.php" method="post">
                        <div class="mb-3">
                            <label for="email">Email address:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <?php if (isset($_GET['status']) && $_GET['status'] == "email_not_found") {
                                echo "<div style='color: red;'>Email not found.</div>";
                            } ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>