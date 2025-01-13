<?php
// Veritabanı bağlantısı için PDO kullanımı
$dsn = 'mysql:dbname=ysoft;host=127.0.0.1:3307';
$user = 'root';
$password = '';

try {
    $connect = new PDO($dsn, $user, $password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Bağlantı kurulamadı: ' . $e->getMessage());
}
?>
