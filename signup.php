<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Sign Up - A&ccedil;a&iacute;</title>
        <?php require "./components/head/head.html"; ?>
    </head>
    <body style="font-family: Poppins, serif;">
        <?php include "./components/nav/nav.html"; ?>
        <div class="container mt-5">
            <h2 class="text-center">Sign Up</h2>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <form action="./add_account.php" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter your email">
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" placeholder="Enter your username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter your password">
                        </div>
                        <div class="mb-3">
                            <label for="confirm-password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm-password" placeholder="Confirm your password">
                        </div>
                        <div class="mb-3">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="dob">
                        </div>
                        <!-- <div class="mb-3">
                            <label for="bio" class="form-label">Bio</label>
                            <textarea class="form-control" id="bio" rows="3" placeholder="Tell us a little about yourself"></textarea>
                        </div> -->
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Create account</button>
                            <a href="./login.php" class="btn btn-outline-secondary">Log in</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>