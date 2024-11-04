<?php
    session_set_cookie_params([
        'lifetime' => 0, // Session cookie, expires when the browser closes
        'path' => '/',
        'secure' => true, // Only send cookie over HTTPS
        'httponly' => true // Prevent JavaScript access to the cookie
    ]);
    session_start();
    session_regenerate_id(false);