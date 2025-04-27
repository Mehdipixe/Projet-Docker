<?php
$host = 'localhost';
$dbname = 'animtrack';
$user = 'root';
$pass = ''; // ou 'root' selon XAMPP/WAMP

try {
    $pdo = new PDO('mysql:host=localhost;dbname=plateforme', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur de connexion à la base de données : ' . $e->getMessage());
}
?>

