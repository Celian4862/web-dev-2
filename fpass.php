<!DOCTYPE html>
<html>
    <head>
        <title>Forgot Password - A&ccedil;a&iacute;</title>
        <?php require "./components/head/head.html"; ?>
    </head>
    <body>
        <?php include "./components/nav/nav.html";
            if (isset($_GET['status']) && $_GET['status'] == 'sent') {
                echo '<div class="alert alert-success">An email has been sent to your address.</div>';
            } else {
                ?>
                <div class="container">
                    <h2>Forgot Password</h2>
                    <form action="send_email.php" method="post">
                        <div class="form-group">
                            <label for="email">Email address:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            <?php } ?>
    </body>
</html>