<?php
    require "./../processing_php/config.php";
    $sql = "CREATE TABLE IF NOT EXISTS accounts (
        id INT(8) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        email VARCHAR(254) NOT NULL,
        username VARCHAR(30) NOT NULL,
        password VARCHAR(255) NOT NULL,
        birthdate DATE NOT NULL,
        reset_token VARCHAR(255) DEFAULT NULL,
        token_expiry DATE DEFAULT NULL
    )";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->close();
    $conn->close();