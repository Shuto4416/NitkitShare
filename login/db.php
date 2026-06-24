<?php
// db.php
$dsn = 'mysql:host=localhost;dbname=your_db_name;charset=utf8mb4';
$user = 'root';
$password = ''; // XAMPPデフォルトは空欄

try {
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("接続エラー: " . $e->getMessage());
}