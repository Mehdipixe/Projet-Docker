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


