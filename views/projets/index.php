<?php
require_once 'db.php';
require_once 'EntityControllers.php';
require_once 'RelatedEntityControllers.php';

// Récupérer les données pour l'affichage rapide
$projets = EntityControllers::getAllProjets($pdo);
$taches = EntityControllers::getAllTaches($pdo);
$membres = EntityControllers::getAllMembres($pdo);
$livrables = EntityControllers::getAllLivrables($pdo);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de Bord - Gestion de Projets</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        .dashboard {
            display: flex;
            gap: 30px;
            margin-top: 30px;
        }
        .card {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
            width: 200px;
            text-align: center;
            background-color: #f9f9f9;
        }
        .card a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }
        .card a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h1>📊 Tableau de Bord – Gestion de Projets</h1>

<div class="dashboard">
    <div class="card">
        <h2>📁 Projets</h2>
        <p><?= count($projets) ?> projet(s)</p>
        <a href="projets.php">Voir les projets</a>
    </div>

    <div class="card">
        <h2>✅ Tâches</h2>
        <p><?= count($taches) ?> tâche(s)</p>
        <a href="taches.php">Voir les tâches</a>
    </div>

    <div class="card">
        <h2>👥 Membres</h2>
        <p><?= count($membres) ?> membre(s)</p>
        <a href="membres.php">Voir les membres</a>
    </div>

    <div class="card">
        <h2>📎 Livrables</h2>
        <p><?= count($livrables) ?> livrable(s)</p>
        <a href="livrables.php">Voir les livrables</a>
    </div>
</div>

</body>
</html>
