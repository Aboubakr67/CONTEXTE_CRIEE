<?php
defined('BASEPATH') or exit('No direct script access allowed');


if (empty($_SESSION['login'])) {
	header('Location: connexion.php');
  
  } elseif ($_SESSION['login'] != 'laurent') {
	header('Location: erreur.php');
  }

  $idLot = $_POST['idLot'];
  $nomBateau = $_POST['nomBateau'];
  $datePeche = $_POST['datePeche'];
  $nomEspece = $_POST['nomEspece'];
  $specificationTaille = $_POST['specificationTaille'];
  $libellePresentation = $_POST['libellePresentation'];
  $tareBac = $_POST['tareBac'];
  $acheteur = $_POST['acheteur'];
  $nomQualite = $_POST['nomQualite'];
  $admin = $_POST['admin'];
  $directeurVente = $_POST['directeurVente'];
  $idFacture = $_POST['idFacture'];
  $poidsBrutLot = $_POST['poidsBrutLot'];
  $prixPlancher = $_POST['prixPlancher'];
  $prixDepart = $_POST['prixDepart'];
  $prixEnchereMax = $_POST['prixEnchereMax'];
  $dateEnchere = $_POST['dateEnchere'];
  $heureDebutEnchere = $_POST['heureDebutEnchere'];
  $codeEtat = $_POST['codeEtat'];

?>

<body>


<body>
  

<h3>Modification d'un lot</h3>



<?php
echo "<br>";
echo form_open('adminController/modifiesLotAdmin', array('method' => 'post'));
?>
<input type="hidden" id="idLot" name="idLot" value="<?php echo $idLot ?>">
        <h1>Lot numéro : <?php echo $idLot; ?></h1>
<label for='text'>Nom de l'espèce : </label>
<select name="nomEspece" id="nomEspece">
  <?php
  foreach ($ToutEspece as $espece) {
    $selected = ($nomEspece == $espece["nomEspece"]) ? "selected" : "";
    echo '<option name="nomEspece" value="' . $espece['idEspece'] . '" ' . $selected . '>' . $espece['nomEspece'] . '</option>';
}

  ?>
</select>
<br><br><br>


<label for='text'>Taille : </label>
<select name="taille" id="taille">
  <?php
  foreach ($taille as $key) {
    $selected = ($specificationTaille == $key["specification"]) ? "selected" : "";
    echo '<option name="taille"    value="' . $key['idTaille'] . '" ' . $selected . '>' . $key['specification'] . " (" . $key['codeTaille'] . ")" . '</option>';
  }
  ?>
</select>
<br><br><br>


<label for='text'>Bac : </label>
<select name="bac" id="bac">
  <?php
  foreach ($affToutLesBac as $key) {
    $selected = ($tareBac == $key["tare"]) ? "selected" : "";
    echo '<option name="bac"    value="' . $key['idBac'] . '" ' . $selected . '>' . $key['tare'] . '</option>'; 
  }
  ?>
</select>
<br><br><br>


<label for="poidsBrut">Poids brut (kg) : </label>
<input type="number" id="poidsBrut" name="poidsBrut" value="<?php echo $poidsBrutLot ?>">
<br><br><br>


<label for="prixPlancher">Prix plancher (€) : </label>
<input type="number" id="prixPlancher" name="prixPlancher" value="<?php echo $prixPlancher ?>">
<br><br><br>


<label for="prixDepart">Prix de départ (€) : </label>
<input type="number" id="prixDepart" name="prixDepart" value="<?php echo $prixDepart ?>">
<br><br><br>


<label for="prixEnchereMax">Prix enchère maximum (€) : </label>
<input type="number" id="prixEnchereMax" name="prixEnchereMax" value="<?php echo $prixEnchereMax ?>">
<br><br><br>

<label for="dateEnchere">Date enchère : </label>


<input type="date" id="dateEnchere" name="dateEnchere" 
  value="<?php echo $dateEnchere; ?>" 
  max="<?php echo date('Y-m-d', strtotime('+1 week')); ?>">

  <br><br><br>

<label for='text'>Qualité : </label>
<select name="qualite" id="qualite">
  <?php
  foreach ($qualite as $key) {
    $selected = ($nomQualite == $key["nomQualite"]) ? "selected" : "";
    echo '<option name="qualite"    value="' . $key['idQualite'] . '" ' . $selected . '>' . $key['codeQualite'] . '</option>';
  }
  ?>
</select>
<label for="text">E: Extra | A: Glacé | B: Déclassé</label>
<br><br><br>


<label for='text'>Libellé de la présentation : </label>
<select name="presentation" id="presentation">
  <?php
  foreach ($presentation as $key) {
    $selected = ($libellePresentation == $key["libellePr"]) ? "selected" : "";
    echo '<option name="presentation"    value="' . $key['idPresentation'] . '" ' . $selected . '>' . $key['libellePr'] . '</option>';
  }
  ?>
</select>
<br><br><br>


<label for='text'>Acheteur : </label>
<select name="acheteur" id="acheteur">
  <?php
  foreach ($ToutLesAcheteurs as $key) {
    $selected = ($acheteur == $key["login"]) ? "selected" : "";
    echo '<option name="acheteur"    value="' . $key['idAcheteur'] . '" ' . $selected . '>' . $key['login'] . '</option>';
  }
  ?>
</select>
<br><br><br>

<label for='text'>Code état : </label>
<select name="codeEtat" id="codeEtat">
  <?php
    $codeEtat = $_POST['codeEtat'];
    $options = ['A', 'B', 'C', 'D', 'E'];
    foreach ($options as $option) {
      if ($option == $codeEtat) {
        echo '<option name="codeEtat" value="'.$option.'" selected>'.$option.'</option>';
      } else {
        echo '<option name="codeEtat" value="'.$option.'">'.$option.'</option>';
      }
    }
  ?>
</select>


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

<script>
 // sélectionne tous les éléments <input> et <select> dans le document, à l'exception des boutons de soumission (<input type="submit">),
const inputs = document.querySelectorAll('input:not([type="submit"]), select');

// Initialiser le drapeau de modification à false
let hasChanged = false;

// Écouter les événements de changement sur les éléments de formulaire
inputs.forEach(input => {
  input.addEventListener('change', () => {
    hasChanged = true;
  });
});

// Écouter l'événement de soumission du formulaire
const form = document.querySelector('form');
form.addEventListener('submit', event => {
  // Si aucun changement n'a été effectué, afficher une alerte et empêcher le formulaire de se soumettre
  if (!hasChanged) {
    event.preventDefault();
    alert('Aucune modification n\'a été effectuée.');
  } else {
    // Demander une confirmation avant la soumission
    var confirmChange = confirm("Etes vous sur de vouloir faire ces changements ?");
    if (!confirmChange) {
      event.preventDefault(); // Annuler la soumission si l'utilisateur annule la confirmation
    }
  }
});

</script>




<script>
document.getElementById("acheteur").addEventListener("change", function() {
  var currentAcheteur = "<?php echo $acheteur; ?>";
  var newAcheteur = this.value;
  if (currentAcheteur !== newAcheteur) {
    var confirmChange = confirm("Attention vous allez changer le nom de l'acheteur. Voulez vous continuer ?");
    if (!confirmChange) {
      // Annuler la sélection de l'utilisateur
      this.value = currentAcheteur;
    }
  }
});
</script>

