<?php

class Projet
{
    private $id;
    private $titre;
    private $description;
    private $date_debut;
    private $date_fin;

    public function __construct($titre, $description, $date_debut, $date_fin, $id = null)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
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

    public function getDateDebut()
    {
        return $this->date_debut;
    }

    public function getDateFin()
    {
        return $this->date_fin;
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

    public function setDateDebut($date_debut)
    {
        $this->date_debut = $date_debut;
    }

    public function setDateFin($date_fin)
    {
        $this->date_fin = $date_fin;
    }

    // --- Sauvegarde en base de données ---
    public function save($pdo)
    {
        if ($this->id) {
            // Mise à jour
            $stmt = $pdo->prepare("UPDATE projets SET titre = ?, description = ?, date_debut = ?, date_fin = ? WHERE id = ?");
            return $stmt->execute([$this->titre, $this->description, $this->date_debut, $this->date_fin, $this->id]);
        } else {
            // Insertion
            $stmt = $pdo->prepare("INSERT INTO projets (titre, description, date_debut, date_fin) VALUES (?, ?, ?, ?)");
            $success = $stmt->execute([$this->titre, $this->description, $this->date_debut, $this->date_fin]);
            if ($success) {
                $this->id = $pdo->lastInsertId();
            }
            return $success;
        }
    }

}

