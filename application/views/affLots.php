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
                    <a class="nav-link" href="envoieLot">Envoie Lot(s)</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="profilDirecteurVente">
                        <img src="https://cdn4.iconfinder.com/data/icons/basic-ui-icon-rounded-colored/512/icon-02-512.png" alt="Croix" width="30" height="30">
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
            <?php
      if(isset($_SESSION['login'])) {
        // utilisateur connecté
      ?>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url('deconnexion');?>"><span class="material-symbols-outlined">logout</span></a>
        </li>
      <?php } ?>
            </ul>
        </div>
    </nav>

    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom l'espèce</th>
                    <th>Nom bateau</th>
                    <th>Qualité</th>
                    <th>Poids Brut</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $limiteLigne = count($affLot);
                // Parcours des données pour afficher chaque ligne du tableau
                $i = 0; // pour que le if puisse commencer à 0 ... et s'arrêter une fois la limite arrivée (comme le $j)
                $j = 0; // pour que le while puisse commencer à 0 et avoir +1 ligne à chaque fois jusqu'à atteindre la limiteLigne, limiteLigne est le nombre total de ligne qu'il y a dans la table materiel.

                while ($j != $limiteLigne) {
                    foreach ($affLot as $r) {
                        if ($i == $limiteLigne) {
                            break;
                        }
                        $nomEspece = $r['nomEspece'];
                        $nomBateau = $r['nomBateau'];
                        $nomQualite = $r['nomQualite'];
                        $poidsBrutLot = $r['poidsBrutLot'];
                        $i++;
                        echo "<tr><td>" . $nomEspece . "</td>";
                        echo "<td>" . $nomBateau . "</td>";
                        echo "<td>" . $nomQualite . "</td>";
                        echo "<td>" . $poidsBrutLot . "</td></tr>";
                    }
                    $j++;
                }
                echo "</table></br></br>";
                ?>

            </tbody>
        </table>
</body>

</html>