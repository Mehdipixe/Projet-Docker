<?php
require_once 'config/db.php';
require_once 'models/projet.php';
require_once 'models/taches.php';
require_once 'models/membres.php';
require_once 'classes/livrables.php';

class RelatedEntityControllers {

    // ================= Lier une Tâche à un Membre =================
    public static function assignTacheToMembre($pdo, $tacheId, $membreId) {
        $stmt = $pdo->prepare("UPDATE taches SET membre_id = ? WHERE id = ?");
        return $stmt->execute([$membreId, $tacheId]);
    }

    // ================= Lier une Tâche à un Projet =================
    public static function assignTacheToProjet($pdo, $tacheId, $projetId) {
        $stmt = $pdo->prepare("UPDATE taches SET projet_id = ? WHERE id = ?");
        return $stmt->execute([$projetId, $tacheId]);
    }

    // ================= Lier un Livrable à un Projet =================
    public static function assignLivrableToProjet($pdo, $livrableId, $projetId) {
        $stmt = $pdo->prepare("UPDATE livrables SET projet_id = ? WHERE id = ?");
        return $stmt->execute([$projetId, $livrableId]);
    }

    // ================= Voir toutes les Tâches d'un Projet =================
    public static function getTachesByProjet($pdo, $projetId) {
        $stmt = $pdo->prepare("SELECT * FROM taches WHERE projet_id = ?");
        $stmt->execute([$projetId]);
        return $stmt->fetchAll();
    }

    // ================= Voir toutes les Tâches d'un Membre =================
    public static function getTachesByMembre($pdo, $membreId) {
        $stmt = $pdo->prepare("SELECT * FROM taches WHERE membre_id = ?");
        $stmt->execute([$membreId]);
        return $stmt->fetchAll();
    }

    // ================= Voir tous les Livrables d'un Projet =================
    public static function getLivrablesByProjet($pdo, $projetId) {
        $stmt = $pdo->prepare("SELECT * FROM livrables WHERE projet_id = ?");
        $stmt->execute([$projetId]);
        return $stmt->fetchAll();
    }
}
