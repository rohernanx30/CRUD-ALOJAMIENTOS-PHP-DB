<?php
session_start();

$env = parse_ini_file(__DIR__ . '/../.env');

$HOST = $env['DB_HOST'];
$PORT = $env['DB_PORT'];
$NAME = $env['DB_NAME'];
$USER = $env['DB_USER'];
$PASS = $env['DB_PASS']; 

try {
    $pdo = new PDO("mysql:host=$HOST;port=$PORT;dbname=$NAME;charset=utf8mb4", $USER, $PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    exit('Error conexión: ' . $e->getMessage());
}

function is_logged_in() {
    return !empty($_SESSION['user_id']);
}

function is_admin() {
    return !empty($_SESSION['is_admin']);
}
