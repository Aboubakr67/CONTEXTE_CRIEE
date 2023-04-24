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
                foreach ($affLotEnVente as $r) {
                    $idLotVente = $r['idLot'];
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
            <?php echo form_open('welcome/insertEnchere', array('method' => 'post')); ?>
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

                        ?>
                        <label>Prix départ : </label><label id="labelprixDepart"> <?php echo $prixDepart; ?></label>
                        <br>

                        <label>Prix enchère max : </label><label id="labelPrixEnchereMax"><?php echo $prixEnchereMax; ?> </label>
                        <br>
                        <label>Acheteur en tête : </label><label id="labelAcheteurEnTete"></label>

                    </div>

                    <h4 id="prixLot"></h4>
                    <h4 id="prixEnchere"></h4>
                    <input type="hidden" id="idLot" name="idLot" value="<?php echo $idLotVente; ?>" />
                    <input type="hidden" id="idBateau" name="idBateau" value="<?php echo $idBateau; ?>" />
                    <input type="hidden" id="datePeche" name="datePeche" value="<?php echo $datePeche; ?>" />
                    <input type="hidden" id="idAcheteur" name="idAcheteur" value="<?php echo $_SESSION['id']; ?>" />
                    <input type="hidden" id="prixDepart" name="prixDepart" value="<?php echo $prixDepart; ?>" />
                    <input type="hidden" id="prixEnchereMax" name="prixEnchereMax" value="<?php echo $prixEnchereMax; ?>" />
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


    $(document).ready(function() {
        getPrixEnchere();
        console.log("------------------------------");
        console.log("idLot" + idLot);
        console.log("idBateau" + idBateau);
        console.log("datePeche" + datePeche);
        console.log("idAcheteur" + idAcheteur);
        console.log("montant" + montant);
        console.log("prixDepart" + prixDepart);
        console.log("prixDepart" + typeof prixDepart);
        console.log("prixEnchereMax" + prixEnchereMax);
        console.log("acheteurLot : " + acheteurLot);
        console.log("prixEnchere : " + prixEnchere);
        console.log("------------------------------");

        //     $('#encherir').click(function(e) {
        //         montantEnchere = $('#montant').val();
        //     // e.preventDefault(); // Empêche le formulaire de se soumettre normalement
        //     insererEnchere(); // Exécute la fonction insererEnchere()
        // });
        //         setInterval(function(){
        //     location.reload();
        // }, 10000);

    });
</script>



<script>
    // Démarrer le compte à rebours
    updateCountdown();
</script>