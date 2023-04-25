<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (empty($_SESSION['login'])) {
    header('Location: connexion');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les enchères du jour</title>
</head>
<body>
    
    <h1 style="text-align: center;">Les enchères du jour</h1>
    <?php if (isset($affToutLesLotsAjd)) : ?>
        <table>
            <thead>
                <tr>
                    <th>LOT</th>
                    <th>Nom de l'espèce</th>
                    <th>Poids</th>
                    <th>Taille</th>
                    <th>Prix de l'enchère</th>
                    <th>Acheteur</th>
                    <th>Heure de début de l'enchère</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($affToutLesLotsAjd as $lot) : ?>
                    <tr>
                        <td><?= $lot['idLot'] ?></td>
                        <td><?= $lot['nomCommunEspece'] ?></td>
                        <td><?= $lot['poidsBrutLot'] ?></td>
                        <td><?= $lot['specification'] ?></td>
                        <td><?= $lot['prixEnchere'] === null ? "Non enchérit" : $lot['prixEnchere'] ?></td>
                        <td><?= $lot['login'] === null ? "Aucun acheteur" : $lot['login'] ?></td>
                        <td><?= $lot['heureDebutEnchere'] === null ? "A programmer" : $lot['heureDebutEnchere'] ?></td>
                        <td><?= $lot['codeEtat'] === 'A' ? 'Lot disponible à la vente' : ($lot['codeEtat'] === 'B' ? 'Lot en cours de vente' : ($lot['codeEtat'] === 'C' ? 'Lot vendu' : '')) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>Aucun lot à afficher pour le moment.</p>
    <?php endif; ?>
</body>
</html>

<style>
    table {
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 20px;
    }

    th,
    td {
        text-align: center;
        padding: 12px;
        border: 1px solid #ddd;
    }

    th {
        background-color: #4CAF50;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
</style>
