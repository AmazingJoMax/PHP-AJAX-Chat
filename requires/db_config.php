<?php 
    define("DB_NAME", 'php_chat');
    define("DB_HOST", 'localhost');
    define("DB_USER", 'root');
    define("DB_PASS", '');

    // DSN Setup
    $dsn = 'mysql:host='. DB_HOST .';dbname='. DB_NAME;

    // Creating PDO instance
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
?>