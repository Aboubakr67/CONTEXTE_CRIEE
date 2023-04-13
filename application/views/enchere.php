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
        <div class="enchere">
            <div class="titre-enchere">
                <?php
                foreach ($affLotEnVente as $r) {
                    $idLotVente = $r['idLot'];
                }
                ?>
                <div id="titre">
                    <h3>Enchère N°<?php echo $idLotVente; ?> - Enchère du <?php echo date('d/m/Y'); ?> </h3>
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
                        foreach ($affLotEnVente as $r) {
                            $prixDepart = $r['prixDepart'];
                            $prixEnchereMax = $r['prixEnchereMax'];
                            $idBateau = $r['idBateau'];
                            $datePeche = $r['datePeche'];
                        }
                        $acheteur;
                        ?>
                        <label>Prix départ : </label><label id="labelPrixKg"><?php echo $prixDepart; ?></label>
                        <br>

                        <label>Prix enchère max : </label><label id="labelPrixRetrait"><?php echo $prixEnchereMax; ?> </label>
                        <br>
                        <label>Acheteur en tête: </label><label id="labelAcheteurEnTete">
                            <?php if (empty($acheteurEnchere)) {
                                echo "Aucun acheteur";
                            } else {
                                echo $acheteurEnchere;
                            } ?></label>

                    </div>

                    <p> prix du lot : 5</p>
                    <input type="hidden" id="idLot" name="idLot" value="<?php echo $idLotVente; ?>" />
                    <input type="hidden" id="idBateau" name="idBateau" value="<?php echo $idBateau; ?>" />
                    <input type="hidden" id="datePeche" name="datePeche" value="<?php echo $datePeche; ?>" />
                    </center>

                    <div id="proposer-prix">

                        Montant à enchérir :
                        <br>

                        <input type="number" id="montant" name="montant" min="1" max="100" step="1" value="500">
                        <br>
                        <input type="submit" value="Enchérir">
                        <br>
                        <br>
                        <label>Votre montant doit être supérieur à celui enchéri actuellement</label>

                    </div>

                </div>

            </div>

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
                        ?>
                    </tbody>
                </table>
            </div>

        </div>


    </body>

</html>


<script type="text/javascript">
    $(document).ready(function() {
        // exécuter une requête AJAX au chargement de la page
        var idLot = $('#idLot').val();
        var idBateau = $('#idBateau').val();
        var datePeche = $('#datePeche').val();
        console.log(idLot);
        console.log(idBateau);
        console.log(datePeche);
        $.ajax({

            url: '<?= base_url() ?>index.php/Welcome/recupePrixDernierLot',
            method: "POST",
            data: {
                idLot: idLot,
                idBateau: idBateau,
                datePeche: datePeche

            },
            dataType: "json",
            success: function(response) {
                // faire quelque chose avec les données récupérées
                console.log(response.length);
                console.log('<?= base_url() ?>Welcome/recupePrixDernierLot');
                var len = response.length;
                if(len >0){
                    $.('#montant').val()=response[0].prixEnchere;
                }

            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Une erreur s'est produite lors de la récupération des données : " + textStatus, errorThrown);
            }
        });
    });
</script>


<!-- Script javascript -->
<script src="<?php echo base_url() . 'script/timer.js'; ?>"></script>
<!-- Bibliothèque Jquery -->
<script src="<?php echo base_url() . 'script/jquery-3.5.1.js'; ?>"></script>

<script>
    // Démarrer le compte à rebours
    updateCountdown();
</script>