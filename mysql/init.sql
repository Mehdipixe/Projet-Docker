CREATE DATABASE IF NOT EXISTS 'Projet Docker';
USE 'Projet Docker';

CREATE TABLE IF NOT EXISTS 'projets' (
    'nom' INT AUTO_INCREMENT PRIMARY KEY,
    'titre' VARCHAR(100),
    'description' TEXT,
    'date_debut' DATE,
    'date_fin' DATE
     INSERT INTO 'projets'('titre', 'description', 'date_debut', 'date_fin')
VALUES 
('Création d\un court-métrage', 'Projet d\animation 2D pour un festival.', '2025-05-01', '2025-09-01'),
('Développement d\un jeu mobile', 'Jeu éducatif pour enfants.', '2025-06-15', '2025-12-15');
);

CREATE TABLE IF NOT EXISTS 'membres' (
    'id' INT AUTO_INCREMENT PRIMARY KEY,
    'nom' VARCHAR(100),
    'role' VARCHAR(100), INSERT INTO 'membres' ('nom', role)
VALUES 
('Alice Dupont', 'Chef de projet'),
('Bob Martin', 'Développeur'),
('Claire Morel', 'Graphiste');

);

CREATE TABLE IF NOT EXISTS 'taches' (
    'nom' INT AUTO_INCREMENT PRIMARY KEY,
    'titre'VARCHAR(100),
    statut ENUM('à faire', 'en cours', 'terminée') DEFAULT 'à faire',
    'id_projet' INT,
    'id_membre' INT,
    FOREIGN KEY ('id_projet') REFERENCES 'projets'('id'),
    FOREIGN KEY ('id_membre') REFERENCES 'membres'('id')
    INSERT INTO 'taches' ('titre', 'description', 'date_debut', 'date_fin', 'id_projet')
VALUES 
('Storyboard du film', 'Créer les scènes principales du court-métrage.', '2025-05-01', '2025-05-15', 1),
('Design personnages', 'Créer les personnages du jeu mobile.', '2025-06-20', '2025-07-20', 2);

   

);

CREATE TABLE IF NOT EXISTS 'livrables' (
    'id' INT AUTO_INCREMENT PRIMARY KEY,
    'nom_fichier'VARCHAR(255),
    'chemin' VARCHAR(255),
    'id_projet' INT,
    'date_upload' DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY ('id_projet') REFERENCES 'projets'('id')
    INSERT INTO 'livrables' ('titre', 'description', 'date_livraison', 'id_projet')
VALUES 
('Storyboard final', 'Storyboard validé pour le court-métrage.', '2025-05-16', 1),
('Prototype du jeu', 'Première version testable du jeu mobile.', '2025-09-01', 2);

);
