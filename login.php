<!doctype html>
<html lang="en">
    <head>
        <title>Login - Build Your City Your Way</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS and JS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Poppins -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <!-- Tailwind CSS -->
        <!-- <link rel="stylesheet" type="text/css" href="./assets/css/output.css"> -->
        <!-- Custom CSS -->
        <link rel="stylesheet" type="text/css" href="./assets/css/login.css">
    </head>
    <body style="font-family: Poppins, serif;">
        <?php include "./components/nav/nav.html"; ?>
        <div class="container mt-5">
            <h2 class="text-center">Log In</h2>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <form>
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
                            <a href="signup.html" class="btn btn-outline-secondary">Sign Up</a>
                        </div>
                        <div class="text-center mt-3">
                            <a href="fpass.html">Forgot password?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>