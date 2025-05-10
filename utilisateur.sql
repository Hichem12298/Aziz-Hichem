CREATE TABLE utilisateurs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin', 'analyste', 'agent', 'conservation', 'surveillance', 'public') NOT NULL,
  accepte BOOLEAN DEFAULT FALSE
);
