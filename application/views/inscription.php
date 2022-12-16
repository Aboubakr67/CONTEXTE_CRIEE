<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*if(empty($_SESSION['securitePersonnel'])){
  header('Location: pageMotDePasseFaux');
}*/

?>


<center>

<?php
    echo "<br>";
    echo form_open('',array('method'=>'post'));
?>

	<h1>Formulaire d'inscription</h1>

	<?php
    echo "<br>";
	$nomU= array('name'=>'Nom utilisateur','id'=>'nom Acheteur','placeholder'=>'Votre nom d\'utilisateur ','value'=>set_value('nomU'));
    echo form_input($nomU);
    echo "<br>";
    echo "<br>";
	$prenomU= array('name'=>'prenomU','id'=>'prenomU','placeholder'=>'Votre prenom','value'=>set_value('prenomU'));
    echo form_input($prenomU);
    echo "<br>";
    echo "<br>";
    $mailU= array('name'=>'mailU','id'=>'mailU','placeholder'=>'Entrer votre adresse mail','value'=>set_value('mailU'));
    echo form_input($mailU);
    echo "<br>";
    echo "<br>";

	$mdpPremier= array('name'=>'mdpPremier','id'=>'mdpPremier','placeholder'=>'Entrer votre mot de passe','value'=>set_value('mdpPremier'));
    echo form_input($mdpPremier);

    echo "<br>";
    echo "<br>";
    $mdpConfirme= array('name'=>'mdpConfirme','id'=>'mdpConfirme','placeholder'=>'retaper votre mot de passe','value'=>set_value('mdpConfirme'));
    echo form_input($mdpConfirme);

    echo "<br>";
    echo "<br>";
	echo form_submit('envoi', 'Valider');
	?>
    

</center>

	<?php
    echo form_close();
?>
<script src="<?php echo base_url().'script/script.js';?>"> 
</script>
</html>