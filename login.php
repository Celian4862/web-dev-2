<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login - A&ccedil;a&iacute;</title>
        <?php require "./components/head/head.html"; ?>
    </head>
    <body style="font-family: Poppins, serif;">
        <?php include "./components/nav/nav.html"; ?>
        <div class="container mt-5">
            <h2 class="text-center">Log In</h2>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <form action="./check_credentials.php" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter your email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter your password">
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
    </body>
</html>