<?php
defined('BASEPATH') or exit('No direct script access allowed');
$date_actuelle = time(); // Récupère la date actuelle au format Unix timestamp
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>CRIEE: Envoie Lot(s)</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <link rel="<?php echo base_url() . 'css/affLots.css'; ?>" />
    <script src="<?php echo base_url() . 'script/jquery-3.5.1.js'; ?>"></script>

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
                if (isset($_SESSION['login'])) {
                    // utilisateur connecté
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('deconnexion'); ?>"><span class="material-symbols-outlined">logout</span></a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </nav>

    <div class="container">
        <table class="table table-striped" >
            <thead>
                <tr>
                    <th>Nom l'espèce</th>
                    <th>Nom bateau</th>
                    <th>Qualité</th>
                    <th>Poids Brut</th>
                    <th>Statut</th>
                    <th>Temps restant</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($affLot as $r) {
                    $nomEspece = $r['nomEspece'];
                    $nomBateau = $r['nomBateau'];
                    $nomQualite = $r['nomQualite'];
                    $poidsBrutLot = $r['poidsBrutLot'];
                    $codeEtat = $r['codeEtat'];
                    $dateEnchere = strtotime($r['dateEnchere']); // Convertit la date du lot en format Unix timestamp
                    $temps_restant = $dateEnchere - $date_actuelle; // Calcule le temps restant en secondes
                    $jours_restants = floor($temps_restant / 86400); // Convertit les secondes en jours arrondis à l'entier inférieur
                    $heures_restantes = floor(($temps_restant % 86400) / 3600); // Convertit les secondes restantes en heures arrondies à l'entier inférieur
                    $minutes_restantes = floor(($temps_restant % 3600) / 60); // Convertit les secondes restantes en minutes arrondies à l'entier inférieur
                    $secondes_restantes = floor($temps_restant % 60); // Calcule le nombre de secondes restantes
                    $temps_restant_formatte = sprintf("%d jours, %d heures, %d minutes et %d secondes", $jours_restants, $heures_restantes, $minutes_restantes, $secondes_restantes); // Formatte le temps restant pour affichage
                    echo "<tr><td>" . $nomEspece . "</td>";
                    echo "<td>" . $nomBateau . "</td>";
                    echo "<td>" . $nomQualite . "</td>";
                    echo "<td>" . $poidsBrutLot . "</td>";
                    if ($codeEtat == 'A') {
                        echo "<td>" . 'Enchère à venir' . "</td>";
                    } elseif ($codeEtat == 'B') {
                        echo "<td>" . 'Enchère en cours' . "</td>";
                    } elseif ($codeEtat == 'C') {
                        echo "<td>" . 'Enchère en C' . "</td>";
                    }
                    if ($temps_restant_formatte < 0 && $codeEtat == 'A') {
                        echo "<td style='font-weight: bold; color: green;'>Disponible à la vente</td>";
                    } elseif ($temps_restant_formatte < 0 && $codeEtat == 'B') {
                        echo "<td style='font-weight: bold; color: orange;'>Lot traité</td>";
                    }elseif ($temps_restant_formatte < 0 && $codeEtat == 'C') {
                        echo "<td style='font-weight: bold; color: red;'>Lot non disponible</td>";
                    }
                    elseif ($temps_restant_formatte < 0) {
                        echo "<td>Lot non disponible</td>";
                    } 
                    else {
                        echo '<td class="timer" data-timeleft="' . $temps_restant . '">' . $temps_restant_formatte . '</td>';
                    }
                }

                echo "</tr></table></br></br>";

                ?>

            </tbody>
        </table>
</body>

<script>
  function updateTimer() {
    var elements = document.getElementsByClassName("timer");
    for (var i = 0; i < elements.length; i++) {
      var timeLeft = parseInt(elements[i].getAttribute("data-timeleft"));
      if (timeLeft > 0) {
        var days = Math.floor(timeLeft / 86400);
        var hours = Math.floor((timeLeft % 86400) / 3600);
        var minutes = Math.floor((timeLeft % 3600) / 60);
        var seconds = timeLeft % 60;
        var formattedTime = days + " jours, " + hours + " heures, " + minutes + " minutes et " + seconds + " secondes";
        elements[i].innerHTML = formattedTime;
        elements[i].setAttribute("data-timeleft", timeLeft - 1);
      } else {
        elements[i].innerHTML = "Terminé";
      }
    }
  }

  setInterval(updateTimer, 1000);







</script>


</html>