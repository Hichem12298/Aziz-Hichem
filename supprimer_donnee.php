<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "arbres";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM donnees_dendrometriques WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Donnée supprimée avec succès.";
    } else {
        echo "Erreur lors de la suppression.";
    }
} else {
    echo "ID manquant.";
}

$conn->close();
?>
