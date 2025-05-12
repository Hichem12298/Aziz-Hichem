<?php
$pdo = new PDO("mysql:host=localhost;dbname=arbres;charset=utf8", "root", "");
$donnees = $pdo->query("SELECT * FROM donnees_dendrometriques")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Données Enregistrées</title>
    <style>
        body { font-family: Arial; background-color: #f9f9f9; padding: 20px; }
        table { width: 90%; margin: auto; border-collapse: collapse; background: #fff; }
        th, td { padding: 12px; border: 1px solid #ccc; text-align: center; }
        th { background-color: #2c3e50; color: white; }
        .btn-delete { background: red; color: white; border: none; padding: 5px 10px; cursor: pointer; }
    </style>
</head>
<body>

<h2>Données Dendrométriques Enregistrées</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Espèce</th>
        <th>Diamètre (cm)</th>
        <th>Hauteur (m)</th>
        <th>Localisation</th>
        <th>Action</th>
    </tr>

    <?php foreach ($donnees as $d): ?>
        <tr>
            <td><?= htmlspecialchars($d['id']) ?></td>
            <td><?= htmlspecialchars($d['espece']) ?></td>
            <td><?= htmlspecialchars($d['diametre']) ?></td>
            <td><?= htmlspecialchars($d['hauteur']) ?></td>
            <td><?= htmlspecialchars($d['localisation']) ?></td>
            <td>
                <form action="supprimer.php" method="POST" onsubmit="return confirm('Supprimer ?');">
                    <input type="hidden" name="id" value="<?= $d['id'] ?>">
                    <button type="submit" class="btn-delete">Supprimer</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
