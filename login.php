<?php
    require "./components/session_details.php";

    if (isset($_SESSION['username'])) {
        header("Location: ./dashboard.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login - A&ccedil;a&iacute;</title>
        <?php require "./components/head.html"; ?>
    </head>
    <body style="font-family: Poppins, serif;">
        <?php include "./components/nav.php"; ?>
        <div class="container mt-5">
            <div class="row">
                <div class="col login-bg"> imago dei </div>
                <div class="col justify-content-center">
                    <div class = "m-5">
                        <h2>Log In</h2>
                        <form action="./assets/processing_php/check_credentials.php" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address / Username</label>
                                <input type="text" class="form-control" id="name_email" name="name_email" placeholder="Enter your email or username" required value="<?php echo isset($_SESSION['name_email']) ? $_SESSION['name_email'] : ''; ?>">
                                <?php if (isset($_GET["invalid_user"])) { ?>
                                    <div class="form-text text-danger">User not found.</div>
                                <?php } ?>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                                <!-- DISPLAY ERROR MESSAGE -->
                                <?php if (isset($_GET["invalid_pass"])) { ?>
                                    <div class="form-text text-danger">Wrong password.</div>
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
        </div>
    </body>
</html>
<?php
    unset($_SESSION['user_email']);