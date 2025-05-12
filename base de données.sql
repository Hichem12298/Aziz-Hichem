CREATE DATABASE IF NOT EXISTS gestion_entites;
USE gestion_entites;

-- Table pour la Conservation
CREATE TABLE IF NOT EXISTS conservation (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    adresse VARCHAR(255) NOT NULL,
    conservateur VARCHAR(255) NOT NULL
);

-- Table pour l'Espèce
CREATE TABLE IF NOT EXISTS espece (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL
);

-- Table pour la Forêt
CREATE TABLE IF NOT EXISTS foret (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    superficie FLOAT NOT NULL
);

-- Table pour le Canton
CREATE TABLE IF NOT EXISTS canton (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    id_foret INT,
    FOREIGN KEY (id_foret) REFERENCES foret(id) ON DELETE CASCADE
);

-- Table pour la Circonscription
CREATE TABLE IF NOT EXISTS circonscription (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    adresse VARCHAR(255) NOT NULL
);

-- Table pour le District
CREATE TABLE IF NOT EXISTS district (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    adresse VARCHAR(255) NOT NULL
);

-- Table pour l'Agent de récolte
CREATE TABLE IF NOT EXISTS agent (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL
);

-- Table pour l'Analyste
CREATE TABLE IF NOT EXISTS analyste (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL
);

-- Table pour l'Analyse
CREATE TABLE IF NOT EXISTS analyse (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date DATE NOT NULL
);

-- Table pour l'Opération de récolte
CREATE TABLE IF NOT EXISTS operation (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description TEXT
);

-- Table pour la Donnée dendrométrique
CREATE TABLE IF NOT EXISTS donnee (
    id INT AUTO_INCREMENT PRIMARY KEY,
    species VARCHAR(255) NOT NULL,
    diameter FLOAT NOT NULL,
    height FLOAT NOT NULL,
    location VARCHAR(255) NOT NULL
);

-- Table pour les utilisateurs
CREATE TABLE IF NOT EXISTS utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL,
    accepte BOOLEAN DEFAULT FALSE
);

-- Insert sample data into the 'donnee' table
INSERT INTO donnee (species, diameter, height, location) VALUES
('Chêne', 30.5, 15.2, 'France'),
('Pin', 25.0, 20.0, 'Canada'),
('Érable', 20.0, 10.5, 'États-Unis');
