<?php
require_once 'config/db.php';
require_once 'models/Membre.php';
require_once 'models/Projet.php';
require_once 'classes/taches.php';
require_once 'models/livrables.php';

class EntityControllers {

    // ======================= Membres =========================
    public static function getAllMembres($pdo) {
        return Membre::getAll($pdo);
    }

    public static function getMembreById($pdo, $id) {
        return Membre::getById($pdo, $id);
    }

    public static function createMembre($pdo, $nom, $role) {
        $membre = new Membre($nom, $role);
        return $membre->save($pdo);
    }

    public static function deleteMembre($pdo, $id) {
        $membre = Membre::getById($pdo, $id);
        if ($membre) {
            return $membre->delete($pdo);
        }
        return false;
    }

    // ======================= Projets =========================
    public static function getAllProjets($pdo) {
        return Projet::getAll($pdo);
    }

    public static function getProjetById($pdo, $id) {
        return Projet::getById($pdo, $id);
    }

    public static function createProjet($pdo, $titre, $description, $dateDebut, $dateFin) {
        $projet = new Projet($titre, $description, $dateDebut, $dateFin);
        return $projet->save($pdo);
    }

    public static function deleteProjet($pdo, $id) {
        $projet = Projet::getById($pdo, $id);
        if ($projet) {
            return $projet->delete($pdo);
        }
        return false;
    }

    // ======================= Tâches =========================
    public static function getAllTaches($pdo) {
        return Tache::getAll($pdo);
    }

    public static function getTacheById($pdo, $id) {
        return Tache::getById($pdo, $id);
    }

    public static function createTache($pdo, $titre, $description, $dateEcheance, $statut, $projetId = null, $membreId = null) {
        $tache = new Tache($titre, $description, $dateEcheance, $statut, $projetId, $membreId);
        return $tache->save($pdo);
    }

    public static function deleteTache($pdo, $id) {
        $tache = Tache::getById($pdo, $id);
        if ($tache) {
            return $tache->delete($pdo);
        }
        return false;
    }

    // ======================= Livrables =========================
    public static function getAllLivrables($pdo) {
        return Livrable::getAll($pdo);
    }

    public static function getLivrableById($pdo, $id) {
        return Livrable::getById($pdo, $id);
    }

    public static function createLivrable($pdo, $titre, $fichier, $projetId = null) {
        $livrable = new Livrable($titre, $fichier, $projetId);
        return $livrable->save($pdo);
    }

    public static function deleteLivrable($pdo, $id) {
        $livrable = Livrable::getById($pdo, $id);
        if ($livrable) {
            return $livrable->delete($pdo);
        }
        return false;
    }
}
