<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>CRIEE: Envoie Lot(s)</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <style>
        body {
            padding: 20px;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 24px;
        }

        .navbar-right {
            margin-right: 20px;
        }

        table {
            width: 100%;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        th,
        td {
            text-align: center;
        }

        th {
            font-weight: bold;
            background-color: #f2f2f2;
        }

        td input[type="checkbox"] {
            margin-left: auto;
            margin-right: auto;
            display: block;
        }

        .btn-valider {
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Directeur de vente</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url() . 'listeLots'; ?>">Liste Lot(s)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Envoie Lot(s)</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="profilDirecteurVente">
                        <img src="https://cdn4.iconfinder.com/data/icons/basic-ui-icon-rounded-colored/512/icon-02-512.png" alt="Croix" width="30" height="30">
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom Espèce</th>
                    <th>Nom Bateau</th>
                    <th>Qualité</th>
                    <th>Poids Brut</th>
                    <th>Heure Début Enchère</th>
                    <th>Validation</th>
                </tr>
            </thead>
            <tbody>
                <?php

                foreach ($affLot as $r) {
                    $nomEspece = $r['nomEspece'];
                    $nomBateau = $r['nomBateau'];
                    $nomQualite = $r['nomQualite'];
                    $poidsBrutLot = $r['poidsBrutLot'];
                    $idLot = $r['idLot'];
                    $datePeche = $r['datePeche'];
                    $idBateau = $r['idBateau'];
                    $heureDebutEnchere = $r['heureDebutEnchere'];

                    echo "<tr><td>" . $nomEspece . "</td>";
                    echo "<td>" . $nomBateau . "</td>";
                    echo "<td>" . $nomQualite . "</td>";
                    echo "<td>" . $poidsBrutLot . "</td>";
                ?>
                    <td>
                        <form action="<?php echo site_url('welcome/traitementEnvoieLots'); ?>" method="POST" class="connex">
                            <?php
                            // Définir l'heure minimale comme 9h00
                            $heure_min = date('H:i', strtotime('09:00'));

                            // Définir l'heure maximale comme 14h00
                            $heure_max = date('H:i', strtotime('14:00'));
                            ?>
                            <input type="time" id="timePicker" name="time" min="<?php echo $heure_min; ?>" max="<?php echo $heure_max; ?>">
                    </td>
                    <td>

                        <input name="idLot" type="hidden" value="<?php echo $idLot; ?> ">
                        <input name="idBateau" type="hidden" value="<?php echo $idBateau; ?> ">
                        <input name="datePeche" type="hidden" value="<?php echo $datePeche; ?> ">
                        <center>
                            <button class="btn btn-primary btn-valider" type="submit">Valider</button>
                        </center>
                        </form>
                    </td>
                <?php
                    echo '</tr>';
                }


                echo "</table></br></br>";
                ?>

            </tbody>
        </table>

        <?php foreach ($affLot as $key) {
            $heureDebutEnchere = $r['heureDebutEnchere'];
        }
        ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.min.js"></script>

        <script>
            // Définition du tableau JavaScript
            var heuresDejaUtilisees = [];

            // Données PHP
            <?php foreach ($affLot as $heure) : ?>
                // Ajouter chaque élément au tableau JavaScript
                heuresDejaUtilisees.push('<?php echo $heure['heureDebutEnchere']; ?>');
            <?php endforeach; ?>
            // Afficher le tableau dans la console
            console.log(heuresDejaUtilisees);

            const timePicker = document.getElementById("timePicker");
            var time = timePicker + ':00';
            console.log(timePicker);
            timePicker.addEventListener("input", function() {
                const heureSelectionnee = this.value;

                console.log(time);
                // Bloquer l'heure si elle est dans le tableau des heures bloquées
                if (heuresDejaUtilisees.includes(heureSelectionnee)) {
                    this.value = "";
                    this.disabled = true;
                    alert("Cette heure est bloquée.");
                } else {

                    const minutes = heureSelectionnee.split(":")[1];
                    // Bloquer les minutes si elles ne sont pas pleines
                    if (minutes % 10 !== 0) {
                        this.value = "";
                        alert("Veuillez sélectionner une heure pleine. Exemple : 10:20 ");
                    }
                }
            });
        </script>
</body>

</html>