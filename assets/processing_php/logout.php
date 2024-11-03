<?php
    // Set secure session cookie parameters
    session_set_cookie_params([
        'lifetime' => 0, // Session cookie, expires when the browser closes
        'path' => '/',
        'secure' => true, // Only send cookie over HTTPS
        'httponly' => true // Prevent JavaScript access to the cookie
    ]);

    session_start();
    if (isset($_SESSION['username'])) {
        session_regenerate_id(true); // Regenerate session ID to prevent fixation
        session_unset();
        session_destroy();
?>
        <h2 style="text-align: center;">You have been logged out. Redirecting to login page...</h2>
<?php
        header("refresh:2;url=./../../login.php");
        exit();
    } else {
        header("Location: ./../../login.php");
        exit();
    }