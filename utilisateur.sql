CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    role ENUM('admin', 'agent', 'analyste', 'employe', 'public') DEFAULT 'public',
    accepte BOOLEAN DEFAULT FALSE
);

-- Administrateur par défaut
INSERT INTO utilisateurs (nom, prenom, email, password, role, accepte)
VALUES ('Admin', 'Principal', 'administrateur@gmail.com', '123', 'admin', TRUE);
