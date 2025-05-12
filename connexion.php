<?php
session_start();
header('Content-Type: application/json');

// Connexion à la base de données
$dsn = "mysql:host=localhost;dbname=gestion_entites;charset=utf8";
$user = "root";  // Change selon ton serveur
$pass = "";  // Mot de passe MySQL (souvent vide sur XAMPP)

try {
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    // Vérifier si l'admin existe, sinon l'ajouter
    $adminEmail = "administrateur@gmail.com";
    $adminPassword = "123";

    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $stmt->execute([$adminEmail]);
    $existingAdmin = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$existingAdmin) {
        $hashedPassword = password_hash($adminPassword, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO utilisateurs (email, password, role, accepte) VALUES (?, ?, ?, ?)");
        $stmt->execute([$adminEmail, $hashedPassword, 'admin', true]);
        echo json_encode(["status" => "success", "message" => "Administrateur ajouté avec succès !"]);
    }

} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Vérification des identifiants de connexion
$data = json_decode(file_get_contents('php://input'), true);

if (!empty($data['email']) && !empty($data['password'])) {
    $email = $data['email'];
    $password = $data['password'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            if ($user['accepte']) {
                $_SESSION["user"] = [
                    "id" => $user["id"],
                    "email" => $user["email"],
                    "role" => $user["role"]
                ];
                echo json_encode(['success' => true, 'user' => ['email' => $user['email'], 'role' => $user['role']]]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Votre compte n\'a pas encore été validé par un administrateur.']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Email ou mot de passe incorrect.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => 'Erreur : ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Tous les champs sont obligatoires.']);
}
?>
