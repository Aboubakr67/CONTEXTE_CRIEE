<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(empty($_SESSION['login'])){
  header('Location: connexion');
}

// echo $_SESSION['login'];
?>

<style>
#table-panier {
  border-collapse: collapse; /* fusionne les bordures des cellules adjacentes */
}

#table-panier td, th {
  border: 1px solid black; /* ajoute une bordure noire d'une épaisseur de 1 pixel */
  padding: 8px; /* ajoute un peu d'espace entre le contenu de la cellule et la bordure */
}
</style>

<h1>Votre panier</h1>

<a href="<?php echo site_url('enchere');?>"><- Revenir à l'enchère</a>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<table id="table-panier">
  <thead>
    <tr>
      <th>N° Lot</th>
      <th>Date</th>
      <th>Espèce</th>
      <th>Taille</th>
      <th>Poids</th>
      <th>Présentation</th>
      <th>Qualité</th>
      <th>Bateau</th>
      <th>Prix enrichi</th>
      <th>Reçu</th>
    </tr>
  </thead>
  <tbody>
 
    <?php
      foreach($affPanier as $r) {
        echo "<tr>
          <td>".$r['idLot']."</td>
          <td>".$r['dateEnchere'].$r['heureDebutEnchere']."</td>
          <td>".$r["nomEspece"]."</td>
          <td>".$r["specification"]."</td>
          <td>".$r["poidsBrutLot"]."</td>
          <td>".$r["libellePr"]."</td>
          <td>".$r["nomQualite"]."</td>
          <td>".$r["nomBateau"]."</td>
          <td>".$r["prixEnchere"]."</td>
          <td>"?> <form action="<?php echo site_url('facturePdfController/print'); ?>" method="POST">
           <input type="hidden" id="idFacture" name="idFacture" value="<?php echo $r['idFacture']; ?>" />
            <button type="submit" class="btn btn-outline-primary"> <i class='fa-solid fa-print'></i>
          </button>
        </td>
      </tr>
    </form>
      <?php } 
    ?>
  </tbody>
</table>


