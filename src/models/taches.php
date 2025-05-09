<?php

class Tache
{
    private $id;
    private $titre;
    private $description;
    private $date_echeance;
    private $statut;
    private $projet_id; // clé étrangère vers un projet
    private $membre_id; // clé étrangère vers un membre assigné

    public function __construct($titre, $description, $date_echeance, $statut, $projet_id, $membre_id = null, $id = null)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->date_echeance = $date_echeance;
        $this->statut = $statut;
        $this->projet_id = $projet_id;
        $this->membre_id = $membre_id;
    }

    // --- Getters ---
    public function getId()
    {
        return $this->id;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getDateEcheance()
    {
        return $this->date_echeance;
    }

    public function getStatut()
    {
        return $this->statut;
    }

    public function getProjetId()
    {
        return $this->projet_id;
    }

    public function getMembreId()
    {
        return $this->membre_id;
    }

    // --- Setters ---
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setDateEcheance($date_echeance)
    {
        $this->date_echeance = $date_echeance;
    }

    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    public function setProjetId($projet_id)
    {
        $this->projet_id = $projet_id;
    }

    public function setMembreId($membre_id)
    {
        $this->membre_id = $membre_id;
    }

    // --- Sauvegarder la tâche ---
    public function save($pdo)
    {
        if ($this->id) {
            // Mise à jour
            $stmt = $pdo->prepare("UPDATE taches SET titre = ?, description = ?, date_echeance = ?, statut = ?, projet_id = ?, membre_id = ? WHERE id = ?");
            return $stmt->execute([
                $this->titre,
                $this->description,
                $this->date_echeance,
                $this->statut,
                $this->projet_id,
                $this->membre_id,
                $this->id
            ]);
        } else {
            // Insertion
            $stmt = $pdo->prepare("INSERT INTO taches (titre, description, date_echeance, statut, projet_id, membre_id) VALUES (?, ?, ?, ?, ?, ?)");
            $success = $stmt->execute([
                $this->titre,
                $this->description,
                $this->date_echeance,
                $this->statut,
                $this->projet_id,
                $this->membre_id
            ]);
            if ($success) {
                $this->id = $pdo->lastInsertId();
            }
            return $success;
        }
    }

    // --- Supprimer la tâche ---
    public function delete($pdo)
    {
        if ($this->id) {
            $stmt = $pdo->prepare("DELETE FROM taches WHERE id = ?");
            return $stmt->execute([$this->id]);
        }
        return false;
    }

    // --- Récupérer toutes les tâches ---
    public static function getAll($pdo)
    {
        $stmt = $pdo->query("SELECT * FROM taches ORDER BY date_echeance ASC");
        $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $taches = [];

        foreach ($resultats as $row) {
            $taches[] = new Tache(
                $row['titre'],
                $row['description'],
                $row['date_echeance'],
                $row['statut'],
                $row['projet_id'],
                $row['membre_id'],
                $row['id']
            );
        }

        return $taches;
    }

    // --- Récupérer une tâche par ID ---
    public static function getById($pdo, $id)
    {
        $stmt = $pdo->prepare("SELECT * FROM taches WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Tache(
                $row['titre'],
                $row['description'],
                $row['date_echeance'],
                $row['statut'],
                $row['projet_id'],
                $row['membre_id'],
                $row['id']
            );
        }

        return null;
    }
}
