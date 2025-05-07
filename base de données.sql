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
    hauteur FLOAT NOT NULL,
    diametre FLOAT NOT NULL,
    volume FLOAT NOT NULL
);
