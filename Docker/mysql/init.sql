-- Création de la table membres
CREATE TABLE IF NOT EXISTS membres (
    'id' INT AUTO_INCREMENT PRIMARY KEY,
    'nom' VARCHAR(100) NOT NULL,
    'prenom' VARCHAR(100) NOT NULL,
    'email' VARCHAR(100),
    'role' VARCHAR(100),
    'date_inscription' DATE
);

-- Création de la table projets
CREATE TABLE IF NOT EXISTS projets (
    'id' INT AUTO_INCREMENT PRIMARY KEY,
    'membre_id' INT,
    'nom_projet' VARCHAR(100) NOT NULL,
    'objectif' VARCHAR(255),
    'date_debut' DATE,
    'date_fin' DATE
    FOREIGN KEY ('membre_id') REFERENCES salaries('id'),
);


-- Table d'association projet <-> membres
-- CREATE TABLE IF NOT EXISTS projet_membres (
--     'id' INT AUTO_INCREMENT PRIMARY KEY,
--     'projet_id' INT,
--     'membre_id' INT,
--     'role' VARCHAR(100),
--     'date_affectation' DATE,
--     FOREIGN KEY ('projet_id') REFERENCES projets('id'),
--     FOREIGN KEY ('salarie_id') REFERENCES salaries('id')
-- );

-- Insertion de salariés
INSERT INTO membres ('nom', 'prenom', 'email', 'rôle', 'date_inscription') VALUES
('Durand', 'Alice', 'alice.durand@email.com', 'Chef de projet', '2024-01-20'),
('Petit', 'Marc', 'marc.petit@email.com', 'DevOps', '2024-01-22'),
('Bernard', 'Claire', 'claire.bernard@email.com', 'Designer UI/UX', '2024-02-03'),
('Robert', 'Luc', 'luc.robert@email.com', 'Développeur mobile', '2024-03-12');

-- Insertion de projets
INSERT INTO projets ('nom', 'objectif', 'date_debut', 'date_fin') VALUES
('Migration Serveur', 'Migrer l’infrastructure vers le cloud', '2024-01-15', '2024-03-30'),
('Refonte site web', 'Moderniser l’interface utilisateur', '2024-02-01', '2024-05-01'),
('Développement application mobile', 'Créer une app Android/iOS', '2024-03-10', '2024-06-15');


-- Affectation des salariés aux projets
-- INSERT INTO projet_membres ('projet_id', 'membre_id', 'role', 'date_affectation') VALUES
-- (1, 1, 'Chef de projet', '2024-01-20'),
-- (1, 2, 'DevOps', '2024-01-22'),
-- (2, 3, 'Designer UI/UX', '2024-02-03'),
-- (3, 2, 'Développeur mobile', '2024-03-12'),
-- (3, 4, 'Testeur QA', '2024-03-14');