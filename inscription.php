<?php
// Connexion à la base de données
$host = "localhost";
$user = "root";
$password = "";
$dbname = "nom_de_ta_base"; // Remplace par ton vrai nom de base

$conn = new mysqli($host, $user, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de connexion : " . $conn->connect_error);
}

// Récupérer les données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT); // Hachage du mot de passe

// Préparer la requête d'insertion dans la base de données
$sql = "INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, role, statut)
        VALUES (?, ?, ?, ?, 'utilisateur', 'en_attente')";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $nom, $prenom, $email, $mot_de_passe);

if ($stmt->execute()) {
    // Envoyer un email à l'administrateur (à toi de définir l'adresse email de l'admin)
    $adminEmail = "administrateur@gmail.com";
    $subject = "Nouvelle demande d'inscription";
    $message = "Une nouvelle demande d'inscription a été soumise par : \n\nNom : $nom $prenom\nEmail : $email\n\nLe statut est actuellement en attente.";
    mail($adminEmail, $subject, $message);

    // Afficher un message de succès à l'utilisateur
    echo "<script>alert('Votre demande a été envoyée à l’administrateur. En attente de validation.');
          window.location.href='signup.html';</script>";
} else {
    echo "Erreur lors de l'inscription : " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
