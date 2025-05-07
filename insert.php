<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    // Connexion à la base de données
    $servername = "localhost";
    $username = "root"; // Remplacez par votre utilisateur DB
    $password = ""; // Remplacez par votre mot de passe DB
    $dbname = "gestion_entites"; // Remplacez par votre nom de base de données

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connexion échouée : " . $conn->connect_error);
    }

    $type = $data['type'];
    $fields = $data['data'];

    // Préparer l'insertion en fonction du type d'entité
    if ($type == 'conservation') {
        $nom = $fields['nom'];
        $adresse = $fields['adresse'];
        $conservateur = $fields['conservateur'];
        
        $sql = "INSERT INTO conservation (nom, adresse, conservateur) VALUES ('$nom', '$adresse', '$conservateur')";
    } elseif ($type == 'espece') {
        $nom = $fields['nom'];
        
        // Insertion dans la table espece
        $sql = "INSERT INTO espece (nom) VALUES ('$nom')";
    } elseif ($type == 'foret') {
        $nom = $fields['nom'];
        $superficie = $fields['superficie'];
        $sql = "INSERT INTO foret (nom, superficie) VALUES ('$nom', '$superficie')";
    } elseif ($type == 'canton') {
        $nom = $fields['nom'];
        $id_foret = $fields['id_foret'];
        $sql = "INSERT INTO canton (nom, id_foret) VALUES ('$nom', '$id_foret')";
    } elseif ($type == 'circonscription') {
        $nom = $fields['nom'];
        $adresse = $fields['adresse'];
        $sql = "INSERT INTO circonscription (nom, adresse) VALUES ('$nom', '$adresse')";
    } elseif ($type == 'district') {
        $nom = $fields['nom'];
        $adresse = $fields['adresse'];
        $sql = "INSERT INTO district (nom, adresse) VALUES ('$nom', '$adresse')";
    } elseif ($type == 'agent') {
        $nom = $fields['nom'];
        $prenom = $fields['prenom'];
        $email = $fields['email'];
        $sql = "INSERT INTO agent (nom, prenom, email) VALUES ('$nom', '$prenom', '$email')";
    } elseif ($type == 'analyste') {
        $nom = $fields['nom'];
        $prenom = $fields['prenom'];
        $email = $fields['email'];
        $sql = "INSERT INTO analyste (nom, prenom, email) VALUES ('$nom', '$prenom', '$email')";
    } elseif ($type == 'analyse') {
        $date = $fields['date'];
        $sql = "INSERT INTO analyse (date) VALUES ('$date')";
    } elseif ($type == 'operation') {
        $nom = $fields['nom'];
        $description = $fields['description'];
        $sql = "INSERT INTO operation (nom, description) VALUES ('$nom', '$description')";
    } elseif ($type == 'donnee') {
        $hauteur = $fields['hauteur'];
        $diametre = $fields['diametre'];
        $volume = $fields['volume'];
        $sql = "INSERT INTO donnee (hauteur, diametre, volume) VALUES ('$hauteur', '$diametre', '$volume')";
    } else {
        echo json_encode(['message' => 'Type d\'entité inconnu']);
        exit;
    }

    // Exécution de la requête SQL
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['message' => 'Données insérées avec succès']);
    } else {
        echo json_encode(['message' => 'Erreur : ' . $conn->error]);
    }

    $conn->close();
} else {
    echo json_encode(['message' => 'Aucune donnée reçue']);
}
?>
