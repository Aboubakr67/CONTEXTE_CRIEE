<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(empty($_SESSION['login'])){
    header('Location: connexion');
  }
?>

<h4>Votre panier</h4>



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