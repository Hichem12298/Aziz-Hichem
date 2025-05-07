<?php
// Paramètres de connexion à la base
$host = "localhost";
$dbname = "conservation_foret";
$user = "root"; // ou autre selon ta config
$pass = "";     // ou mot de passe si défini

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // 🔒 Hachage sécurisé
    $role = $_POST["role"];

    // Vérifie que les champs ne sont pas vides
    if (empty($email) || empty($password) || empty($role)) {
        die("Tous les champs sont obligatoires.");
    }

    // Prépare et exécute la requête d'insertion
    $sql = "INSERT INTO utilisateurs (email, password, role, accepte) VALUES (?, ?, ?, 0)";
    $stmt = $pdo->prepare($sql);
    try {
        $stmt->execute([$email, $password, $role]);
        echo "<h2>Inscription réussie ! En attente de validation par l'administrateur.</h2>";
        echo "<a href='index.html'>Retour à la connexion</a>";
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            echo "Cet email est déjà utilisé.";
        } else {
            echo "Erreur lors de l'inscription : " . $e->getMessage();
        }
    }
} else {
    echo "Méthode non autorisée.";
}
?>
