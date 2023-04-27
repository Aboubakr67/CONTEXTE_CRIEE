<?php
defined('BASEPATH') or exit('No direct script access allowed');
$dateJour = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>CRIEE: Envoie Lot(s)</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <link rel="<?php echo base_url() . 'css/envoieLot.css'; ?>" />

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
                    <a class="nav-link" href="<?php echo base_url() . 'envoieLot'; ?>">Envoie Lot(s)</a>
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
    <?php if ($this->session->flashdata('error')) { ?>
        <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
    <?php } ?>

    <?php if ($this->session->flashdata('reussi')) { ?>
        <div class="alert alert-success"><?php echo $this->session->flashdata('reussi'); ?></div>
    <?php } ?>
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
                        <input name="dateJour" type="hidden" value="<?php echo $dateJour; ?> ">

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

        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.min.js"></script>

        <script>
            // Définition du tableau JavaScript pour stocker les heures déjà utilisées
            var heuresDejaUtilisees = [];

            // Données PHP
            <?php foreach ($heuresUtilisees as $heure) : ?>
                // Ajouter chaque élément au tableau JavaScript en utilisant 
                //substr pour récupérer uniquement l'heure substr est utilisée pour extraire uniquement les 5 
                //premiers caractères de la chaîne représentant l'heure, correspondant à l'heure et aux minutes (par exemple, "10:30" au lieu de "10:30:00").
                heuresDejaUtilisees.push('<?php echo substr($heure['heureUtilisee'], 0, 5); ?>');
            <?php endforeach; ?>

            // Afficher le tableau dans la console pour le débogage
            console.log(heuresDejaUtilisees);

            // Récupération de l'élément HTML input avec l'id "timePicker"
            const timePicker = document.getElementById("timePicker");

            // Initialisation de la variable "time" avec la valeur de l'input et l'ajout de ":00" à la fin pour simplifier la validation
            var time = timePicker.value + ':00';

            // Afficher la valeur de l'input dans la console pour le débogage
            //console.log(timePicker.value);

            // Ajout d'un événement pour écouter les changements de valeur de l'input
            timePicker.addEventListener("input", function() {
                // Récupération de la nouvelle valeur de l'input
                const heureSelectionnee = this.value;

                // Vérification si l'heure sélectionnée est dans le tableau des heures déjà utilisées
                if (heuresDejaUtilisees.includes(heureSelectionnee)) {
                    // Si l'heure est déjà utilisée, effacer la valeur de l'input, désactiver l'input et afficher un message d'erreur
                    this.value = "";
                    //this.disabled = true; //sert à desactiver l'input 
                    alert("Cette heure est bloquée.");
                } else {
                    // Si l'heure est disponible, récupérer les minutes pour la validation
                    const minutes = heureSelectionnee.split(":")[1];

                    // Bloquer les minutes si elles ne sont pas pleines (i.e. divisibles par 10)
                    if (minutes % 10 !== 0) {
                        this.value = "";
                        alert("Veuillez sélectionner une heure pleine. Exemple : 10:20 ");
                    }
                }
            });
        </script>

</body>

</html>