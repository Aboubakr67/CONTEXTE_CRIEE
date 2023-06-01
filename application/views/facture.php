<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// if(empty($_SESSION['login'])){
//   header('Location: connexion');
// }
?>

<?php
foreach ($affFactureAcheteur as $r) {
    $idLot = $r['idLot'];
    $nomEspece = $r['nomEspece'];
    $specification = $r['specification'];
    $poidsBrutLot = $r['poidsBrutLot'];
    $libellePr = $r['libellePr'];
    $nomQualite = $r['nomQualite'];
    $nomBateau = $r['nomBateau'];
    $prixEnchere = $r['prixEnchere'];
    $login = $r['login'];
    $dateEnchere = $r['dateEnchere'];
    $heureDebutEnchere = $r['heureDebutEnchere'];
    $datePeche = $r['datePeche'];
    $idFacture = $r['idFacture'];
    $numRueAcheteur = $r['numRueAcheteur'];
    $nomRueAcheteur = $r['nomRueAcheteur'];
    $codePostal = $r['codePostal'];
    $ville = $r['ville'];
    $idAcheteur = $r['idAcheteur'];
}
?>


<div class="container">
  <div class="invoice">
    <div class="row">
      <div class="col-7">
        <!-- <img src="https://s3.eu-central-1.amazonaws.com/zl-clients-sharings/90Tech.png" class="logo"> -->
      </div>
      <div class="col-5">
        <h1 class="document-type display-4">FACTURE</h1>
        <p class="text-right"><strong>N°<?php echo $idFacture; ?></strong></p>
      </div>
    </div>
    <div class="row"> 
      <div class="col-7">
        <p>
          <strong>CRIEE POULGOAZEC</strong><br>
          29 TRONIN<br>
          29790 BEUZEC-CAP-SIZUN, FRANCE
        </p>
      </div>
      <div class="col-5">
        <br><br><br>
        <p>
          <strong><?php echo $login; ?></strong><br>
          Réf. Client <em><?php echo $idAcheteur; ?></em><br>
          <?php echo $numRueAcheteur . " " . $nomRueAcheteur?> <br>
          <?php echo $codePostal . " " . $ville?> <br>
        </p>
      </div>
    </div>
    <br>
    <!-- <br><br> -->
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Description</th>
          <th>Poids Brut</th>
          <th>Qualité</th>
          <!-- <th>PU HT</th> -->
          <th>TVA</th>
          <th>Total HT</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Lot numéro <?php echo $idLot . " - " . $nomEspece; ?></td>
          <td><?php echo $poidsBrutLot; ?></td>
          <td><?php echo $nomQualite . " - " . $specification; ?></td>
          <!-- <td class="text-right"><?php echo $prixEnchere; ?>€</td> -->
          <td>20%</td>
          <td class="text-right"><?php echo $prixEnchere; ?>€</td>
        </tr>
      </tbody>
    </table>
    <div class="row">
      <div class="col-8">
      </div>
      <div class="col-4">
        <table class="table table-sm text-right">
          <tr>
            <td><strong>Total HT</strong></td>
            <td class="text-right"><?php echo $prixEnchere; ?>€</td>
          </tr>
          <tr>
            <td>TVA 20%</td>
            <?php $prixtva = $prixEnchere * 20 / 100; ?>
            <td class="text-right"><?php echo $prixtva; ?>€</td>
          </tr>
          <tr>
            <td><strong>Total TTC</strong></td>
            <td class="text-right"><?php echo $prixtva + $prixEnchere; ?>€</td>
          </tr>
        </table>
      </div>
    </div>
    
    <p class="conditions">
      En votre aimable règlement
      <br>
      Et avec nos remerciements.
      <br><br>
      Conditions de paiement :  le paiement doit être effectué uniquement sur place, directement au secrétariat.
      <br>
      Possibilité de virement : Règlement par virement bancaire, carte de crédit ou espèces
      <br><br>
      En cas de non-paiement dans les 2 jours suivant l'enchère, le lot ne vous sera plus attribué et sera remis en vente à la grande distribution.
    </p>
    
    <br>
    <br>
    <br>
    <br>
    
    <!-- <p class="bottom-page text-right">
      90TECH SAS - N° SIRET 80897753200015 RCS METZ<br>
      6B, Rue aux Saussaies des Dames - 57950 MONTIGNY-LES-METZ 03 55 80 42 62 - www.90tech.fr<br>
      Code APE 6201Z - N° TVA Intracom. FR 77 808977532<br>
      IBAN FR76 1470 7034 0031 4211 7882 825 - SWIFT CCBPFRPPMTZ
    </p> -->
  </div>
</div>

<style>
    body {
  background: #ccc;
  padding: 30px;
}

.container {
  width: 21cm;
  min-height: 29.7cm;
}

.invoice {
  background: #fff;
  width: 100%;
  padding: 50px;
}

.logo {
  width: 2.5cm;
}

.document-type {
  text-align: right;
  color: #444;
}

.conditions {
  font-size: 0.7em;
  color: #666;
}

.bottom-page {
  font-size: 0.7em;
}   
</style>