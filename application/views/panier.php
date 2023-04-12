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

<table id="table-panier">
  <thead>
    <tr>
      <th>N° Lot</th>
      <th>Espèce</th>
      <th>Taille</th>
      <th>Poids</th>
      <th>Présentation</th>
      <th>Qualité</th>
      <th>Bateau</th>
      <th>Prix enrichi</th>
      <th>Supprimer le lot ?</th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach($affPanier as $r) {
        echo "<tr><td>".$r['idLot']."</td><td>".$r["nomEspece"]."</td><td>".$r["specification"]."</td><td>".$r["poidsBrutLot"]."</td><td>".$r["libellePr"]."</td><td>".$r["nomQualite"]."</td><td>".$r["nomBateau"]."</td><td>".$r["prixEnchere"]."</td><td><a href='' class='delete-lot' style='color: red;' data-lot-id='".$r['idLot']."'>Supprimer</a></td></tr>";
      }
    ?>
  </tbody>
</table>

<!-- <p id="test">test</p> -->

<!-- Ajouter la librairie jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Script pour la suppression d'un lot -->
<script>
$(document).ready(function() {
  $('.delete-lot').click(function(e) {
    e.preventDefault();
    var deleteLink = $(this);
    var login = '<?php echo $_SESSION["login"]?>';
    console.log(login);
    // Afficher la boîte de dialogue
    if (confirm("Êtes-vous sûr de vouloir supprimer ce lot ?")) {
      // Envoyer la requête AJAX pour supprimer le lot
      $.ajax({
        url: '<?php echo site_url('/Welcome/deleteLotPanier');?>',
        type: 'post',
        data: {
          loginAch: login,
          idLot: deleteLink.data('lot-id')
        },
        success: function(response) {
          // Vérifier si le lot a été supprimé de la base de données
          
            // Supprimer la ligne du tableau

            location.reload();


            // $.ajax({
            //   url: '<?php echo site_url('/Welcome/verifDeleteLot');?>',
            //   type: 'post',
            //   data: {idLot: deleteLink.data('lot-id')},
            //   success: function(response2) {
            //     $("#test").html(JSON.parse(response2));
            //     if (response2 == 1) {
            //       $.ajax({
            //       url: '<?php echo site_url('/Welcome/affPanier');?>',
            //       type: 'post',
            //       data: {loginAch: login},
            //       success: function(response3) {
            //         alert("OUI");
            //       },
            //       error: function() {
            //         alert("1 - Une erreur s'est produite lors de la suppression du lot.");
            //       }
            //     });
            //     }
                
            //   },
            //   error: function() {
            //     alert("2 - Une erreur s'est produite lors de la suppression du lot.");
            //   }
            // });
        },
        error: function() {
          alert("3 - Une erreur s'est produite lors de la suppression du lot.");
        }
      });
    }
  });
});
</script>