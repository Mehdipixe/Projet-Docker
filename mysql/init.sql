CREATE DATABASE IF NOT EXISTS 'animtrack';
USE 'animtrack';

CREATE TABLE projets (
    'id' INT AUTO_INCREMENT PRIMARY KEY,
    'titre' VARCHAR(100),
    'description' TEXT,
    'date_debut' DATE,
    'date_fin' DATE
);

CREATE TABLE membres (
    'id' INT AUTO_INCREMENT PRIMARY KEY,
    'nom' VARCHAR(100),
    role VARCHAR(100)
);

CREATE TABLE taches (
    'id' INT AUTO_INCREMENT PRIMARY KEY,
    'titre'VARCHAR(100),
    statut ENUM('à faire', 'en cours', 'terminée') DEFAULT 'à faire',
    'id_projet' INT,
    'id_membre' INT,
    FOREIGN KEY ('id_projet') REFERENCES 'projets'('id'),
    FOREIGN KEY ('id_membre') REFERENCES 'membres'('id')
);

CREATE TABLE livrables (
    'id' INT AUTO_INCREMENT PRIMARY KEY,
    'nom_fichier'VARCHAR(255),
    'chemin' VARCHAR(255),
    'id_projet' INT,
    'date_upload' DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY ('id_projet') REFERENCES 'projets'('id')
);
