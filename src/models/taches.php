<?php

class Tache {
    private $conn;
    private $table = 'taches';

    public $id;
    public $titre;
    public $statut;
    public $id_projet;
    public $id_membre;

    // Constructeur avec connexion à la base de données
    public function __construct($db) {
        $this->conn = $db;
    }

    // 🔍 Lire toutes les tâches
    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // 🔍 Lire les tâches d’un projet spécifique
    public function getByProjet($id_projet) {
        $query = "SELECT * FROM " . $this->table . " WHERE id_projet = :id_projet";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_projet', $id_projet);
        $stmt->execute();
        return $stmt;
    }

    // ➕ Créer une tâche
    public function create() {
        $query = "INSERT INTO " . $this->table . " 
                  (titre, statut, id_projet, id_membre) 
                  VALUES (:titre, :statut, :id_projet, :id_membre)";
        $stmt = $this->conn->prepare($query);

        // Sécuriser les données
        $this->titre = htmlspecialchars(strip_tags($this->titre));
        $this->statut = htmlspecialchars(strip_tags($this->statut));

        $stmt->bindParam(':titre', $this->titre);
        $stmt->bindParam(':statut', $this->statut);
        $stmt->bindParam(':id_projet', $this->id_projet);
        $stmt->bindParam(':id_membre', $this->id_membre);

        return $stmt->execute();
    }

    // ✏️ Mettre à jour une tâche
    public function update($id) {
        $query = "UPDATE " . $this->table . }
                  
}
    