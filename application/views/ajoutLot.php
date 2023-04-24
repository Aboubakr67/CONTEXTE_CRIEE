<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<?php

foreach ($idAdmin as $key) {
  $_SESSION['id'] = $key['idAdmin'];
}


if (empty($_SESSION['login'])) {
  header('Location: connexion.php');

} elseif ($_SESSION['role'] != "Admin" && $_SESSION['login'] != 'laurent') {
  header('Location: erreur.php');
}

$DateAndTime = date('Y-m-d', time());
// echo "The current date and time are $DateAndTime.";
$maDateMax = strtotime($DateAndTime . "+ 2 days");
$maxDate = date('Y-m-d', $maDateMax);

$maDateMin = strtotime($DateAndTime . "- 3 days");
$minDate = date('Y-m-d', $maDateMin);
?>


<html>

<body>
  

<h3>Ajouter un lot à la vente</h3>



<?php
echo "<br>";
echo form_open('welcome/ajouterLot', array('method' => 'post'));
?>

<label for='text'>Nom de l'espèce : </label>
<select name="nomEspece" id="nomEspece">
  <option value="default" <?php echo set_select('nomEspece', 'default', TRUE); ?>>Choisissez un nom d'espece</option>
  <?php
  foreach ($nomEspece as $espece) {
    echo '<option name="nomEspece"   value="' . $espece['idEspece'] . '">' . $espece['nomEspece'] . '</option>';
  }
  ?>
</select>

<!-- Espece details -->
<div>
  Nom commun de l'espèce : <span id='nomCE'>[selon l'index choisi du combobox]</span><br />
  Nom scientifique de l'espèce : <span id='nomSE'>[selon l'index choisi du combobox]</span><br />
</div>

<br>

<label for='text'>Taille : </label>
<select name="taille" id="taille">
  <option value="default" <?php echo set_select('taille', 'default', TRUE); ?>>Choisir la taille</option>
  <?php
  foreach ($taille as $key) {
    echo '<option name="taille"    value="' . $key['idTaille'] . '">' . $key['specification'] . " (" . $key['codeTaille'] . ")" . '</option>';
  }
  ?>
</select>



<div>
  <label for="tare">Tare (kg) : <span id='tare'>[selon la taille]</span></label><br>
  <input type="text" id="idBac" name="idBac" hidden>
</div>



<label for="poidsBrut">Poids brut (kg) : </label>
<input type="number" id="poidsBrut" name="poidsBrut">
<br>


<label for="prixPlancher">Prix plancer (€) : </label>
<input type="number" id="prixPlancher" name="prixPlancher">
<br>


<label for="prixDepart">Prix de départ (€) : </label>
<input type="number" id="prixDepart" name="prixDepart">
<br>


<label for="prixEnchereMax">Prix enchère maximum (€) : </label>
<input type="number" id="prixEnchereMax" name="prixEnchereMax">
<br>

<label for="datePeche">Date enchère : </label>


<input type="date" id="dateEnchere" name="dateEnchere" 
  value="<?php echo date('Y-m-d'); ?>" 
  max="<?php echo date('Y-m-d', strtotime('+1 week')); ?>">

  <br>

<label for='text'>Qualité : </label>
<select name="qualite" id="qualite">
  <option value="default" <?php echo set_select('qualite', 'default', TRUE); ?>>Choisir la qualité</option>
  <?php
  foreach ($qualite as $key) {
    echo '<option name="qualite"    value="' . $key['idQualite'] . '">' . $key['codeQualite'] . '</option>';
  }
  ?>
</select>
<label for="text">E: Extra | A: Glacé | B: Déclassé</label>
<br>



<label for='text'>Libellé de la présentation : </label>
<select name="presentation" id="presentation">
  <option value="default" <?php echo set_select('presentation', 'default', TRUE); ?>>Choisir la presentation</option>
  <?php
  foreach ($presentation as $key) {
    echo '<option name="presentation"    value="' . $key['idPresentation'] . '">' . $key['libellePr'] . '</option>';
  }
  ?>
</select>
<br>



<label for='text'>Nom du bateau : </label>
<select name="bateau" id="bateau">
  <option value="default" <?php echo set_select('bateau', 'default', TRUE); ?>>Choisir un bateau</option>
  <?php
  foreach ($bateau as $key) {
    echo '<option name="bateau"    value="' . $key['idBateau'] . '">' . $key['nomBateau'] . '</option>';
  }
  ?>
</select>
<br>

<label for="datePeche">Date de pêche : </label>


<!-- <input type="datetime-local" id="datePeche" name="datePeche" value="<?php echo date('Y-m-d\TH:i:s'); ?>" 
  min="<?php echo date('Y-m-d\TH:i:s', strtotime('-1 week')); ?>" 
  max="<?php echo date('Y-m-d\TH:i:s', strtotime('+1 week')); ?>">> -->
<input type="datetime-local" id="datePeche" name="datePeche" value="<?php echo date('Y-m-d\TH:i:s'); ?>">



<br>

<center>
  <?php
  echo form_submit('envoi', 'Valider');
  ?>



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

</center>
</body>
</html>

<?php
echo form_close();
?>

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
          console.log("ERREUR");
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

<style>
  /* Couleur de fond et de texte */
body {
  background-color: #f5f5f5;
  color: #333;
  font-family: Arial, sans-serif;
  font-size: 16px;
}

/* Conteneur du formulaire */
form {
  margin: 0 auto;
  max-width: 600px;
  padding: 20px;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

/* Titre du formulaire */
h3 {
  margin-top: 0;
  font-size: 24px;
  text-align: center;
}

/* Style pour les étiquettes de formulaire */
label {
  display: block;
  margin-bottom: 5px;
  font-size: 18px;
}

/* Style pour les listes déroulantes */
select {
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

/* Style pour les champs de texte */
input[type="text"],
input[type="number"],
input[type="date"],
input[type="datetime-local"] {
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

/* Style pour le bouton de soumission */
input[type="submit"] {
  background-color: #4CAF50;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 18px;
}

input[type="submit"]:hover {
  background-color: #45a049;
}

/* Style pour les messages d'erreur */
.error {
  color: red;
  font-size: 14px;
  margin-top: 5px;
}

/* Style pour le conteneur des détails de l'espèce */
#espece-details {
  margin-bottom: 20px;
  font-size: 18px;
}

#espece-details span {
  font-weight: bold;
}

</style>
