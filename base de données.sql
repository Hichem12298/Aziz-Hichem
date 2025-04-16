CREATE DATABASE IF NOT EXISTS cfa_dendrometrie;

USE cfa_dendrometrie;

CREATE TABLE IF NOT EXISTS foret (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(255) NOT NULL,
  localisation VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS canton (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(255) NOT NULL,
  id_foret INT,
  FOREIGN KEY (id_foret) REFERENCES foret(id)
);

CREATE TABLE IF NOT EXISTS espece (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom_commun VARCHAR(255) NOT NULL,
  nom_scientifique VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS conservation (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(255) NOT NULL,
  id_district INT
);

CREATE TABLE IF NOT EXISTS circonscription (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS district (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(255) NOT NULL,
  id_circonscription INT,
  FOREIGN KEY (id_circonscription) REFERENCES circonscription(id)
);

CREATE TABLE IF NOT EXISTS agent (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(255) NOT NULL,
  prenom VARCHAR(255) NOT NULL,
  matricule VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS operation (
  id INT AUTO_INCREMENT PRIMARY KEY,
  date DATE NOT NULL,
  id_agent INT,
  description TEXT,
  FOREIGN KEY (id_agent) REFERENCES agent(id)
);

CREATE TABLE IF NOT EXISTS donnee_dendrometrique (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_operation INT,
  id_canton INT,
  id_espece INT,
  hauteur DECIMAL(5,2),
  diametre DECIMAL(5,2),
  age_estime INT,
  FOREIGN KEY (id_operation) REFERENCES operation(id),
  FOREIGN KEY (id_canton) REFERENCES canton(id),
  FOREIGN KEY (id_espece) REFERENCES espece(id)
);

CREATE TABLE IF NOT EXISTS analyste (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(255) NOT NULL,
  specialite VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS analyse (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_donnee INT,
  id_analyste INT,
  date_analyse DATE NOT NULL,
  resultats TEXT,
  FOREIGN KEY (id_donnee) REFERENCES donnee_dendrometrique(id),
  FOREIGN KEY (id_analyste) REFERENCES analyste(id)
);
