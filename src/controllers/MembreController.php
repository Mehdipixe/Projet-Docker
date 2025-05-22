<?php
include_once 'config/db.php';
include_once 'models/Membres.php';

class MembreController {
    private $membre;
    private $db;
    
    public function __construct() {
        $db = new Database();
        $this->db = $db->getConnection();
        $this->membre = new Membre($this->db);
    }
    
    // Afficher la liste des salariés
    public function index() {
        $stmt = $this->salarie->read();
        $salaries = $stmt->fetchAll(PDO::FETCH_ASSOC);
        include_once 'views/membres/index.php';
    }
    
    // Afficher le formulaire de création
    public function create() {
        // Si le formulaire est soumis
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Récupérer et valider les données du formulaire
            $this->salarie->nom = htmlspecialchars(strip_tags($_POST['nom']));
            $this->salarie->prenom = htmlspecialchars(strip_tags($_POST['prenom']));
            $this->salarie->email = htmlspecialchars(strip_tags($_POST['email']));
            $this->salarie->role = htmlspecialchars(strip_tags($_POST['role']));
            $this->salarie->date_inscription = htmlspecialchars(strip_tags($_POST['date_inscription']));
            
            // Créer le salarié
            if($this->salarie->create()) {
                header('Location: membre.php');
                exit;
            } else {
                $error = "Une erreur est survenue lors de la création du client.";
            }
        }
        
        include_once 'views/membres/create.php';
    }
    
    // Afficher les détails d'un salarié
    public function show($id) {
        $this->salarie->id = $id;
        if($this->salarie->readOne()) {
            include_once 'views/membres/show.php';
        } else {
            echo "Membres non trouvé.";
        }
    }
    
    // Afficher et traiter le formulaire de modification
    public function edit($id) {
        $this->membre->id = $id;
        
        // Si le formulaire est soumis
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Récupérer et valider les données du formulaire
            $this->membre->nom = htmlspecialchars(strip_tags($_POST['nom']));
            $this->membre->prenom = htmlspecialchars(strip_tags($_POST['prenom']));
            $this->membre->email = htmlspecialchars(strip_tags($_POST['email']));
            $this->membre->role = htmlspecialchars(strip_tags($_POST['role']));
            $this->membre->date_inscription = htmlspecialchars(strip_tags($_POST['date_inscription']));
            
            // Mettre à jour le salarié
            if($this->membre->update()) {
                header('Location: membre.php');
                exit;
            } else {
                $error = "Une erreur est survenue lors de la mise à jour du membre.";
            }
        } else {
            // Charger les données du salarié
            if(!$this->membre->readOne()) {
                echo "Membres non trouvé.";
                return;
            }
        }
        
        include_once 'views/membres/edit.php';
    }
    
    // Supprimer un salarié
    public function delete($id) {
        $this->salarie->id = $id;
        
        if($this->salarie->delete()) {
            header('Location: membre.php');
            exit;
        } else {
            echo "Une erreur est survenue lors de la suppression du membre.";
        }
    }
}