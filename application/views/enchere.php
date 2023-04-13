<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(empty($_SESSION['login'])){
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

        <div id="titre">
            <h3>Enchère N°X - Enchère du 30/03/2023</h3>
            <p>Temps restant : <span id="countdown"></span></p>
        </div>

        <div id="panier">
            <a href="<?php echo site_url('panier');?>">
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
                    foreach($affDeuxLotsPrecedents as $r) {
                        echo "<tr><td>".$r['idLot']."</td><td>".$r["nomEspece"]."</td><td>".$r["specification"]."</td><td>".$r["poidsBrutLot"]."</td><td>".$r["prixEnchere"]."</td><td>".$r["login"]."</td></tr>";
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
                foreach($affLotEnVente as $r) {
                    echo "<tr><td>".$r['idLot']."</td><td>".$r["nomEspece"]."</td><td>".$r["specification"]."</td><td>".$r["poidsBrutLot"]."</td><td>".$r["libellePr"]."</td><td>".$r["nomQualite"]."</td><td>".$r["nomBateau"]."</td></tr>";
                }
            ?>
        </tbody>
    </table>

    <div class="encherir">

        <div id="infos-enchere">
            
            <label>Prix/kg : </label><label id="labelPrixKg">8,50€</label>
            <br>
            <label>Prix/kg (FRF) : </label><label id="labelPrixKgFrf">55,76 FRF</label>
            <br>
            <label>Prix retrait : </label><label id="labelPrixRetrait"></label>
            <br>
            <label>Acheteur en tête: </label><label id="labelAcheteurEnTete">LAMOUE</label>

        </div>

        <div id="proposer-prix">

            Montant à enchérir :
            <br>
            <select name="monnaie" id="select-monnaie">
                <option value="euro">Euro (€)</option>
                <option value="frf">Franc français (FRF)</option>
            </select>

            <input type="number" id="montant" name="montant" min="1" max="100" step="1">
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
                foreach($affLotsSuivants as $r) {
                    echo "<tr><td>".$r['idLot']."</td><td>".$r["nomEspece"]."</td><td>".$r["specification"]."</td><td>".$r["libellePr"]."</td><td>".$r["nomQualite"]."</td><td>".$r["(L.poidsBrutLot - BAC.tare)"]."</td><td>".$r["nomBateau"]."</td></tr>";
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
<script>
    // Démarrer le compte à rebours
    updateCountdown();
</script>