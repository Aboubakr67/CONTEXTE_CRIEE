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
    <title>Enchere</title>
</head>

<body>
    <h1>Bienvenue à la page enchere</h1>
    <link rel="stylesheet" href="<?php echo base_url() . 'style/enchere.css'; ?>">
    </head>

    <body>

        <?php
        if ($this->session->flashdata('error')) { ?>
            <p class="text-danger text-center" style="margin-top: 10px;color: red;">
                <?= $this->session->flashdata('error') ?></p>
        <?php } ?>

        <?php
        if ($this->session->flashdata('succes')) { ?>
            <p class="text-danger text-center" style="margin-top: 10px;color: green;">
                <?= $this->session->flashdata('succes') ?></p>
        <?php } ?>

        <div class="enchere">
            <div class="titre-enchere">
                <?php
                if (empty($affLotEnVente)) {
                    $idLotVente = "vide";
                } else {
                    foreach ($affLotEnVente as $r) {
                        $idLotVente = $r['idLot'];
                    }
                }


                ?>
                <div id="titre">
                    <h3>Enchère N°<?php echo $idLotVente; ?> - Enchère du <?php echo date('d/m/Y'); ?> </h3>
                    <p>Temps restant : <span id="countdown"></span></p>
                </div>

                <div id="panier">
                    <a href="<?php echo site_url('panier'); ?>">
                        <img src="<?php echo base_url() . 'image/panier.png'; ?>" width="50px">
                    </a>
                </div>

            </div>

            <div class="tables-enchere" id="lots-precedents">
                <h5>Lots précédents</h5>

                <div id="table">
                    <table>
                        <th>N° Lot</th>
                        <th>Espèce</th>
                        <th>Taille</th>
                        <th>Poids</th>
                        <th>Prix enchéri</th>
                        <th>Nom de l'acheteur</th>
                        <tbody>
                            <?php
                            foreach ($affDeuxLotsPrecedents as $r) {
                                echo "<tr><td>" . $r['idLot'] . "</td><td>" . $r["nomEspece"] . "</td><td>" . $r["specification"] . "</td><td>" . $r["poidsBrutLot"] . "</td><td>" . $r["prixEnchere"] . "</td><td>" . $r["login"] . "</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php echo form_open('welcome/insertEnchere', array('method' => 'post', 'id' => 'myForm')); ?>
            <div class="tables-enchere" id="lot-en-vente">
                <h5>Lot en vente</h5>

                <table>
                    <th>N° Lot</th>
                    <th>Espèce</th>
                    <th>Taille</th>
                    <th>Poids</th>
                    <th>Présentation</th>
                    <th>Qualité</th>
                    <th>Bateau</th>
                    <tbody>
                        <?php
                        foreach ($affLotEnVente as $r) {
                            echo "<tr><td>" . $r['idLot'] . "</td><td>" . $r["nomEspece"] . "</td><td>" . $r["specification"] . "</td><td>" . $r["poidsBrutLot"] . "</td><td>" . $r["libellePr"] . "</td><td>" . $r["nomQualite"] . "</td><td>" . $r["nomBateau"] . "</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <div class="encherir">

                    <div id="infos-enchere">
                        <?php
                        if (empty($affLotEnVente)) {
                            $prixDepart = "vide";
                            $prixEnchereMax = "vide";
                            $idBateau = "vide";
                            $datePeche = "vide";
                            $heureDebutEnchereLotEnVente = "vide";
                            $acheteurLot = "vide";
                            $prixEnchere = "vide";
                        } else {
                            foreach ($affLotEnVente as $r) {
                                $prixDepart = $r['prixDepart'];
                                $prixEnchereMax = $r['prixEnchereMax'];
                                $idBateau = $r['idBateau'];
                                $datePeche = $r['datePeche'];
                                $heureDebutEnchereLotEnVente = $r['heureDebutEnchere'];
                                $acheteurLot = $r['login'];
                                $prixEnchere = $r['prixEnchere'];
                            }
                        }

                        ?>
                        <label>Prix départ : </label><label id="labelprixDepart"> <?php echo $prixDepart; ?></label>
                        <br>

                        <label>Prix enchère max : </label><label id="labelPrixEnchereMax"><?php echo $prixEnchereMax; ?> </label>
                        <br>
                        <!-- <label>Acheteur en tête : </label><label id="labelAcheteurEnTete"></label> -->
                        <label>Acheteur en tête : <?php echo $acheteurLot == NULL ? " Aucun acheteur" : $acheteurLot; ?></label>

                    </div>

                    <!-- <h4 id="prixLot"></h4> -->
                    <h4 id="prixLot">Montant enchérit : <?php echo $prixEnchere == NULL ? "Aucun" : $prixEnchere; ?></h4>
                    <h4 id="prixEnchere"></h4>
                    <input type="hidden" id="idLot" name="idLot" value="<?php echo $idLotVente; ?>" />
                    <input type="hidden" id="idBateau" name="idBateau" value="<?php echo $idBateau; ?>" />
                    <input type="hidden" id="datePeche" name="datePeche" value="<?php echo $datePeche; ?>" />
                    <input type="hidden" id="idAcheteur" name="idAcheteur" value="<?php echo $_SESSION['numeroUsers']; ?>" />
                    <input type="hidden" id="prixDepart" name="prixDepart" value="<?php echo $prixDepart; ?>" />
                    <input type="hidden" id="prixEnchereMax" name="prixEnchereMax" value="<?php echo $prixEnchereMax; ?>" />
                    <input type="hidden" id="acheteurLotEnTete" name="acheteurLotEnTete" value="<?php echo $acheteurLot; ?>" />
                    </center>


                    <div id="proposer-prix">

                        Montant à enchérir :
                        <br>

                        <input type="number" id="montant" name="montant" min="1" step="1">
                        <br>
                        <input type="submit" id="encherir" value="Enchérir">
                        <br>
                        <br>
                        <!-- <label>Votre montant doit être supérieur à celui enchéri actuellement</label> -->

                    </div>

                </div>

            </div>
            <?php
            echo form_close();
            ?>

            <div class="tables-enchere" id="lots-suivants">
                <h5>Lots suivants</h5>

                <table>
                    <th>N° Lot</th>
                    <th>Espèce</th>
                    <th>Taille</th>
                    <th>Présentation</th>
                    <th>Qualité</th>
                    <th>Poids net</th>
                    <th>Bateau</th>
                    <tbody>
                        <?php
                        foreach ($affLotsSuivants as $r) {
                            echo "<tr><td>" . $r['idLot'] . "</td><td>" . $r["nomEspece"] . "</td><td>" . $r["specification"] . "</td><td>" . $r["libellePr"] . "</td><td>" . $r["nomQualite"] . "</td><td>" . $r["(L.poidsBrutLot - BAC.tare)"] . "</td><td>" . $r["nomBateau"] . "</td></tr>";
                        }
                        if (!empty($affLotsSuivants)) {
                            $premiereHeureSuivante = $affLotsSuivants[0]['heureDebutEnchere'];
                        }
                        
                        ?>
                    </tbody>
                </table>
            </div>

        </div>


    </body>

</html>


<!-- Script javascript -->
<script src="<?php echo base_url() . 'script/timer.js'; ?>"></script>
<!-- Bibliothèque Jquery -->
<script src="<?php echo base_url() . 'script/jquery-3.5.1.js'; ?>"></script>

<script type="text/javascript">
    var acheteurLot = '';
    var prixEnchere = '';
    var montantEnchere = '';

    var idLot = $('#idLot').val();
    var idBateau = $('#idBateau').val();
    var datePeche = $('#datePeche').val();
    var idAcheteur = $('#idAcheteur').val();
    var prixDepart = $('#prixDepart').val();
    var prixEnchereMax = $('#prixEnchereMax').val();
    console.log(idAcheteur);

    function getPrixEnchere() {

        $.ajax({
            url: '<?= base_url() ?>index.php/Welcome/recupePrixLotActuel',
            method: "POST",
            data: {
                idLot: idLot,
                idBateau: idBateau,
                datePeche: datePeche
            },
            dataType: "json",
            success: function(response) {
                console.log(response.length);
                console.log('<?= base_url() ?>Welcome/recupePrixLotActuel');
                var len = response.length;
                if (len > 0) {
                    prixEnchere = response[0].prixEnchere;
                    acheteurLot = response[0].login;
                    console.log("Prix enchere : " + prixEnchere);
                    console.log("Acheteur lot : " + acheteurLot);

                    if (prixEnchere !== '') {
                        $('#prixLot').text('Prix du lot : ');
                        $('#prixEnchere').text(prixEnchere);
                    }
                }

                if (acheteurLot === '' || typeof acheteurLot === 'undefined') {
                    $('#labelAcheteurEnTete').text('Aucun acheteur');
                } else {
                    $('#labelAcheteurEnTete').text(acheteurLot);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Une erreur s'est produite lors de la récupération des données : " + textStatus, errorThrown);
            }
        });
    }


    function finEnchereLot() {

        $.ajax({
            url: '<?= base_url() ?>index.php/Welcome/finEnchereLot',
            method: 'POST',
            data: {
                idLot: idLot,
                idBateau: idBateau,
                datePeche: datePeche
            },
            dataType: "json",
            success: function(response) {
                console.log("finEnchere + changement codeEtat B -> C:");
                location.reload();

            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Une erreur s'est produite lors de l'insertion de l'enchère finEnchere : " + textStatus, errorThrown);
            }
        });
    }


    $(document).ready(function() {
        document.getElementById("myForm").reset();
           getPrixEnchere();
          
    });
</script>


<script>
    // ! ----------------------------------------------------------------------------------------------------
    // Définition de la fonction pour mettre à jour l'affichage du temps restant
    function updateCountdown(countdownElement, startTime, lotDuration) {
        let now = new Date();
        let remainingTime = startTime.getTime() + lotDuration - now.getTime();
        console.log('Remaining time: ' + remainingTime);
        if (remainingTime > 0) {
            let minutes = Math.floor(remainingTime / 60000);
            console.log(minutes);
            let seconds = Math.floor((remainingTime % 60000) / 1000);
            console.log(seconds);
            countdownElement.innerHTML = minutes + ' min ' + seconds + ' s';
            console.log('Countdown updated: ' + minutes + ' min ' + seconds + ' s');
        } else {
            countdownElement.innerHTML = 'Terminé !';
            // Appel de la fonction en ajax pour changer le codeEtat du lot, idfacture et acheteur
            console.log("Fin d'enchère !");
            finEnchereLot();
            clearInterval(timer); // On arrête le chronomètre
        }
    }
    
    // Récupération de l'élément HTML pour afficher le temps restant
    let countdownElement = document.getElementById('countdown');
    
    // Récupération de l'heure de début de l'enchère et conversion en objet Date
    let startTime = new Date();
    let heureDebutEnchere = '<?php echo $heureDebutEnchereLotEnVente; ?>';
    let [hours, minutes, seconds] = heureDebutEnchere.split(':');
    startTime.setHours(hours);
    startTime.setMinutes(minutes);
    startTime.setSeconds(seconds);
    
    // Durée de chaque lot en millisecondes
    let lotDuration = 10 * 60 * 1000; // 10 minutes
    
    // Vérification régulière de l'heure de début de l'enchère
    let checkStartTime = setInterval(function() {
        let now = new Date();
        if (now >= startTime) {
            // L'heure de début de l'enchère est atteinte, on peut lancer le chronomètre
            clearInterval(checkStartTime); // On arrête la vérification de l'heure de début de l'enchère
            startTimer(startTime, lotDuration); // On lance le chronomètre
        }
    }, 1000); // On vérifie toutes les secondes

    // Variable pour stocker le timer
    let timer;
    
    // Fonction pour lancer le chronomètre
    function startTimer(startTime, lotDuration) {
        // Mise à jour de l'affichage toutes les secondes
        console.log(startTime);
        timer = setInterval(function() {
            updateCountdown(countdownElement, startTime, lotDuration);
        }, 1000);
        
    }
    
    // ! -----------------------------------------------------------------------------------------------------
    
    
    // Récupérer la première heure de début d'enchère dans le tableau
    var premiereHeure = <?php $premiereHeureSuivante; ?>
    
    // Obtenir l'heure actuelle au format "HH:MM:SS"
    var maintenant = new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit', second:'2-digit'});
    
    // Si la première heure de début d'enchère est égale à l'heure actuelle, rafraîchir la page
    if (premiereHeure === maintenant) {
        location.reload();
    }
    console.log("hqshdq");
    console.log(premiereHeure);
    
    
    
    // ! -----------------------------------------------------------------------------------------------------
    
    //     // Démarrer le compte à rebours
    //     updateCountdown();
    
    
    // // Récupération de l'heure de début de l'enchère et conversion en objet Date
    // let startTime = new Date();
    // let heureDebutEnchere = '<?php echo $heureDebutEnchereLotEnVente; ?>';
    // let [hours, minutes, seconds] = heureDebutEnchere.split(':');
    // startTime.setHours(hours);
    // startTime.setMinutes(minutes);
    // startTime.setSeconds(seconds);

    // // Durée de chaque lot en millisecondes
    // let lotDuration = 10 * 60 * 1000; // 10 minutes

    // // Vérification régulière de l'heure de début de l'enchère
    // let checkStartTime = setInterval(function() {
    //     let now = new Date();
    //     if (now >= startTime) {
    //         // L'heure de début de l'enchère est atteinte, on peut lancer le chronomètre
    //         clearInterval(checkStartTime); // On arrête la vérification de l'heure de début de l'enchère
    //         startTimer(startTime, lotDuration); // On lance le chronomètre
    //     }
    // }, 1000); // On vérifie toutes les secondes


    // // Fonction pour lancer le chronomètre
    // function startTimer(startTime, lotDuration) {
    //     // Récupération de l'élément HTML pour afficher le temps restant
    //     let countdownElement = document.getElementById('countdown');

    //     // Fonction pour mettre à jour l'affichage du temps restant
    //     function updateCountdown() {
    //         let now = new Date();
    //         let remainingTime = startTime.getTime() + lotDuration - now.getTime();
    //         if (remainingTime > 0) {
    //             let minutes = Math.floor(remainingTime / 60000);
    //             let seconds = Math.floor((remainingTime % 60000) / 1000);
    //             countdownElement.innerHTML = minutes + ' min ' + seconds + ' s';
    //         } else {
    //             countdownElement.innerHTML = 'Terminé !';
    //             // Appel de la fonction en ajax pour changer le codeEtat du lot, idfacture et acheteur
    //             console.log("ici");
    //             finEnchereLot();
    //         }
    //     }

    //     // Mise à jour de l'affichage toutes les secondes
    //     let timer = setInterval(updateCountdown, 1000);
    // }
</script>