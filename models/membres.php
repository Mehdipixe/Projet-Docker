<?php

class Membre
{
    private $id;
    private $nom;
    private $role;

    public function __construct($nom, $role, $id = null)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->role = $role;
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

    public function getRole()
    {
        return $this->role;
    }

    // --- Setters ---
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    // --- Sauvegarde en base de données ---
    public function save($pdo)
    {
        if ($this->id) {
            // Mise à jour
            $stmt = $pdo->prepare("UPDATE membres SET nom = ?, role = ? WHERE id = ?");
            return $stmt->execute([$this->nom, $this->role, $this->id]);
        } else {
            // Insertion
            $stmt = $pdo->prepare("INSERT INTO membres (nom, role) VALUES (?, ?)");
            $success = $stmt->execute([$this->nom, $this->role]);
            if ($success) {
                $this->id = $pdo->lastInsertId();
            }
            return $success;
        }
    }

    // --- Suppression ---
    public function delete($pdo)
    {
        if ($this->id) {
            $stmt = $pdo->prepare("DELETE FROM membres WHERE id = ?");
            return $stmt->execute([$this->id]);
        }
        return false;
    }

    // --- Récupérer tous les membres ---
    public static function getAll($pdo)
    {
        $stmt = $pdo->query("SELECT * FROM membres ORDER BY nom ASC");
        $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $membres = [];

        foreach ($resultats as $row) {
            $membres[] = new Membre($row['nom'], $row['role'], $row['id']);
        }

        return $membres;
    }

    // --- Récupérer un membre par son ID ---
    public static function getById($pdo, $id)
    {
        $stmt = $pdo->prepare("SELECT * FROM membres WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Membre($row['nom'], $row['role'], $row['id']);
        }

        return null;
    }
}
