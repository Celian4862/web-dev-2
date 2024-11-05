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
        header("Location: ./../../index.php");
    } else {
        header("Location: ./../../index.php");
    }