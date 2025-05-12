<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=arbres;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (
        isset($_POST['espece']) && isset($_POST['diametre']) &&
        isset($_POST['hauteur']) && isset($_POST['localisation'])
    ) {
        $stmt = $pdo->prepare("INSERT INTO donnees_dendrometriques (espece, diametre, hauteur, localisation) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $_POST['espece'],
            floatval($_POST['diametre']),
            floatval($_POST['hauteur']),
            $_POST['localisation']
        ]);
        header("Location: voir_donnees.php");
        exit;
    } else {
        echo "Erreur : tous les champs sont requis.";
    }
} catch (Exception $e) {
    echo "Erreur de base de données : " . $e->getMessage();
}
?>
