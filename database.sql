-- Création de la base de données
CREATE DATABASE IF NOT EXISTS auth_secure;
USE auth_secure;

-- Création de la table users
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    last_login DATETIME NULL,
    INDEX idx_username (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertion d'un utilisateur de test 
-- Identifiant: admin
-- Mot de passe: admin123
INSERT INTO users (username, password, created_at) 
VALUES ('admin', '$2y$10$Yw7QvJYQZqGmLKOGXh4IYeYrCzxHPV3wZ9vVCBQnJXKQH8qKPYYiO', NOW());

-- Afficher la structure de la table
DESCRIBE users;

-- Afficher les utilisateurs (pour vérification)
SELECT id, username, created_at FROM users;