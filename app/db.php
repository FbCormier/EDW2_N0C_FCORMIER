<?php

$envPath = __DIR__ . '/../.env';

if (!file_exists($envPath)) {
    die("Erreur : le fichier .env est manquant.");
}

$env = [];

foreach (file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
    if (substr(trim($line), 0, 1) === '#') {
        continue;
    }

    [$key, $value] = array_map('trim', explode('=', $line, 2));
    $env[$key] = $value;
}

$host = $env['DB_HOST'] ?? 'localhost';
$dbname = $env['DB_NAME'] ?? '';
$user = $env['DB_USER'] ?? '';
$password = $env['DB_PASS'] ?? '';
$charset = $env['DB_CHARSET'] ?? 'utf8mb4';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=$charset",
        $user,
        $password
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}