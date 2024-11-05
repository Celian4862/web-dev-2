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
        <?php require "./components/head.html"; ?>
        <title>User Settings - A&ccedil;a&iacute;</title>
    </head>
    <body>
        <?php require "./components/nav.php"; ?>
        <div class="container mt-5">
            <h2 class="text-center">User Settings</h2>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <form action="./assets/processing_php/update_user.php" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $_SESSION['email'] ?>" />
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="username" class="form-control" id="username" name="username" value="<?= $_SESSION['username'] ?>" />
                        </div>
                        <div class="mb-3">
                            <label for="old-pass" class="form-label">Old password</label>
                            <input type="password" class="form-control" id="old-pass" name="old-pass" />
                        </div>
                        <div class="mb-3">
                            <label for="new-pass" class="form-label">New password</label>
                            <input type="password" class="form-control" id="new-pass" name="new-pass" />
                        </div>
                        <div class="mb-3">
                            <label for="conf-new-pass" class="form-label">Confirm new password</label>
                            <input type="password" class="form-control" id="conf-new-pass" name="conf-new-pass" />
                        </div>
                        <div class="mb-3">
                            <label for="birthdate" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="birthdate" name="birthdate" value="<?= $_SESSION['birthdate'] ?>" />
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>