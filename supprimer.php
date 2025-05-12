<?php
if (isset($_POST['id'])) {
    $pdo = new PDO("mysql:host=localhost;dbname=arbres;charset=utf8", "root", "");
    $stmt = $pdo->prepare("DELETE FROM donnees_dendrometriques WHERE id = ?");
    $stmt->execute([$_POST['id']]);
}
header("Location: voir_donnees.php");
exit;
