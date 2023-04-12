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
echo form_open('welcome/modifiesLotAdmin', array('method' => 'post'));
?>
<input type="text" id="idLot" name="idLot" value="<?php echo $idLot ?>">
        

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

<!-- <script>
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
    if (!confirmChange) {}
      event.preventDefault(); // Annuler la soumission si l'utilisateur annule la confirmation
    
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
</script> -->

