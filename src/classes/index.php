<?php
require_once 'config/db.php';
require_once 'classes/Projet.php';
require_once 'classes/Tache.php';
require_once 'classes/Membre.php';
require_once 'classes/Livrable.php';

echo "<h1>Test des classes de gestion de projets 🚀</h1>";

// ========== Créer un nouveau projet ==========
$nouveauProjet = new Projet(null, "Projet Animation 3D", "Créer un court-métrage en 3D", "2025-05-01", "2025-09-30");
if ($nouveauProjet->save($pdo)) {
    echo "<p style='color:green;'>✅ Projet créé avec succès : {$nouveauProjet->titre}</p>";
} else {
    echo "<p style='color:red;'>❌ Erreur lors de la création du projet.</p>";
}

// ========== Créer un nouveau membre ==========
$nouveauMembre = new Membre(null, "Alice Dupont", "Graphiste 3D");
if ($nouveauMembre->save($pdo)) {
    echo "<p style='color:green;'>✅ Membre ajouté : {$nouveauMembre->nom}</p>";
} else {
    echo "<p style='color:red;'>❌ Erreur lors de l'ajout du membre.</p>";
}

// ========== Créer une nouvelle tâche ==========
$nouvelleTache = new Tache(null, "Modélisation Personnage", "Créer les personnages principaux", "2025-05-10", "2025-06-15", null, null);
if ($nouvelleTache->save($pdo)) {
    echo "<p style='color:green;'>✅ Tâche ajoutée : {$nouvelleTache->titre}</p>";
} else {
    echo "<p style='color:red;'>❌ Erreur lors de l'ajout de la tâche.</p>";
}

// ========== Créer un nouveau livrable ==========
$nouveauLivrable = new Livrable(null, "Storyboard Complet", "Storyboard de toutes les scènes validé", null);
if ($nouveauLivrable->save($pdo)) {
    echo "<p style='color:green;'>✅ Livrable créé : {$nouveauLivrable->titre}</p>";
} else {
    echo "<p style='color:red;'>❌ Erreur lors de la création du livrable.</p>";
}

// ========== Afficher tous les projets existants ==========
echo "<h2>📁 Liste des projets existants :</h2>";
$stmt = $pdo->query("SELECT * FROM projets ORDER BY id DESC");
$projets = $stmt->fetchAll();
foreach ($projets as $projet) {
    echo "<p><strong>{$projet['titre']}</strong> – {$projet['date_debut']} ➔ {$projet['date_fin']}</p>";
}

?>
