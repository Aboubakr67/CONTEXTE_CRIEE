<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(empty($_SESSION['login'])){
    header('Location: connexion');
  }
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
	<th>N° Lot</th>
	<th>Espèce</th>
	<th>Taille</th>
	<th>Poids</th>
	<th>Présentation</th>
	<th>Qualité</th>
	<th>Bateau</th>
	<th>Prix enrichi</th>
	<th>Supprimer le lot ?</th>
		<?php
			foreach($result as $r) {
				echo "<tr><td>".$r['idLot']."</td><td>".$r["idBateau"]."</td><td>".$r["datePeche"]."</td><td>".$r["idEspece"]."</td><td>".$r["idTaille"]."</td><td>".$r["idPresentation"]."</td><td>".$r["idBac"]."</td><td>".$r["idAcheteur"]."</td><td>".$r["idQualite"]."</td><td>".$r["idAdmin"]."</td><td>".$r["idDirecteur"]."</td><td>".$r["idFacture"]."</td><td>".$r["poidsBrutLot"]."</td><td>".$r["prixPlancher"]."</td><td>".$r["prixDepart"]."</td><td>".$r["prixEnchereMax"]."</td><td>".$r["dateEnchere"]."</td><td>".$r["heureDebutEnchere"]."</td><td>".$r["codeEtat"]."</td></tr>";
				//(`idLot` `idBateau`, `datePeche`, `idEspece`, `idTaille`, `idPresentation`, `idBac`, `idAcheteur`, `idQualite`, `idAdmin`, `idDirecteur`, `idFacture`, `poidsBrutLot`, `prixPlancher`, `prixDepart`, `prixEnchereMax`, `dateEnchere`, `heureDebutEnchere`, `codeEtat`)

			}
		?>
		</table>





















<!-- Bibliothèque Jquery -->
<script src="<?php echo base_url() . 'script/jquery-3.5.1.js'; ?>"></script>

<!-- Script javascript -->
<script src="<?php echo base_url() . 'script/addLot.js'; ?>"></script>


<!-- Permet d'afficher les details de l'espece en fonction du select -->
<script type="text/javascript">
  $(document).ready(function() {

    // Pour afficher les details des informations de l'espece choisit
    $('#nomEspece').change(function() {
      var idEspece = $(this).val();
      console.log("ID de l'epece " + idEspece);
      $.ajax({
        url: '<?= base_url() ?>index.php/Welcome/especeDetails',
        type: 'post',
        data: {
          idEspece: idEspece
        },
        dataType: 'json',
        success: function(response) {
          console.log("response" + response);
          var len = response.length;
          console.log(len);
          console.log("marche");
          console.log('<?= base_url() ?>index.php/Welcome/especeDetails');
          $('#nomCE').text('');
          $('#nomSE').text('');
          
          

          if (len > 0) {
            // Read values
            var uname = response[0].nomCommunEspece;
            var name = response[0].nomScientifiqueEspece;



            console.log(uname);

            $('#nomCE').text(uname);
            $('#nomSE').text(name);

          }

          if (idEspece == "default") {
            $('#nomCE').text("[selon l'index choisi du combobox]");
            $('#nomSE').text("[selon l'index choisi du combobox]");
          }

        },
        error: function(response) {
          console.log("ERREUR ahaha");
        }
      });
    });



    // Pour afficher le tare 
    $('#taille').change(function() {
      var idTaille = $(this).val();
      console.log("ID de taille " + idTaille);
      $.ajax({
        url: '<?= base_url() ?>index.php/Welcome/affTare',
        type: 'post',
        data: {
          idTaille: idTaille
        },
        dataType: 'json',
        success: function(response) {
          var len = response.length;
          // console.log(len);
          console.log("<?= base_url() ?>index.php/Welcome/affTare");
          console.log("marche");
          $('#tare').text('');
          $('#idBac').text('');


          if (len > 0) {
            // Read values
            var taree = response[0].tare;
            var idBac = response[0].idBac;
            idBac = String(idBac);

            console.log(idBac);
            $('#tare').text(taree);
            document.getElementById('idBac').value = idBac;

          }

          if (idTaille == "default") {
            $('#tare').text("[selon la taille]");
          }

        },
        error: function(response) {
          console.log("ERREUR ahaha");


        }
      });
    });


  });
</script>