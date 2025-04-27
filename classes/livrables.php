<?php

class Livrable
{
    private $id;
    private $nom;
    private $description;
    private $date_livraison;
    private $projet_id; // Clé étrangère vers un projet

    public function __construct($nom, $description, $date_livraison, $projet_id, $id = null)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->date_livraison = $date_livraison;
        $this->projet_id = $projet_id;
    }

    // --- Getters ---
    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getDateLivraison()
    {
        return $this->date_livraison;
    }

    public function getProjetId()
    {
        return $this->projet_id;
    }

    // --- Setters ---
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setDateLivraison($date_livraison)
    {
        $this->date_livraison = $date_livraison;
    }

    public function setProjetId($projet_id)
    {
        $this->projet_id = $projet_id;
    }

    // --- Sauvegarder le livrable ---
    public function save($pdo)
    {
        if ($this->id) {
            // Mise à jour
            $stmt = $pdo->prepare("UPDATE livrables SET nom = ?, description = ?, date_livraison = ?, projet_id = ? WHERE id = ?");
            return $stmt->execute([$this->nom, $this->description, $this->date_livraison, $this->projet_id, $this->id]);
        } else {
            // Insertion
            $stmt = $pdo->prepare("INSERT INTO livrables (nom, description, date_livraison, projet_id) VALUES (?, ?, ?, ?)");
            $success = $stmt->execute([$this->nom, $this->description, $this->date_livraison, $this->projet_id]);
            if ($success) {
                $this->id = $pdo->lastInsertId();
            }
            return $success;
        }
    }

    // --- Supprimer ---
    public function delete($pdo)
    {
        if ($this->id) {
            $stmt = $pdo->prepare("DELETE FROM livrables WHERE id = ?");
            return $stmt->execute([$this->id]);
        }
        return false;
    }

    // --- Récupérer tous les livrables ---
    public static function getAll($pdo)
    {
        $stmt = $pdo->query("SELECT * FROM livrables ORDER BY date_livraison DESC");
        $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $livrables = [];

        foreach ($resultats as $row) {
            $livrables[] = new Livrable(
                $row['nom'],
                $row['description'],
                $row['date_livraison'],
                $row['projet_id'],
                $row['id']
            );
        }

        return $livrables;
    }

    // --- Récupérer un livrable par ID ---
    public static function getById($pdo, $id)
    {
        $stmt = $pdo->prepare("SELECT * FROM livrables WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Livrable(
                $row['nom'],
                $row['description'],
                $row['date_livraison'],
                $row['projet_id'],
                $row['id']
            );
        }

        return null;
    }
}
