<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*if(empty($_SESSION['securitePersonnel'])){
  header('Location: pageMotDePasseFaux');
}*/

?>


<center>

<?php
    echo "<br>";
    echo form_open('welcome/inscriptionAcheteur',array('method'=>'post'));
?>

	<h1>Formulaire d'inscription</h1>

	<?php
    echo "<br>";
	$nomAcheteur= array('name'=>'nomAcheteur','id'=>'nom Acheteur','placeholder'=>'Votre nom de famille ','value'=>set_value('nomAcheteur'));
    echo form_input($nomAcheteur);
    echo "<br>";
    echo "<br>";
	$prenomAcheteur= array('name'=>'prenomAcheteur','id'=>'prenomAcheteur','placeholder'=>'Votre prenom','value'=>set_value('prenomAcheteur'));
    echo form_input($prenomAcheteur);
    echo "<br>";
    echo "<br>";
    $mailAcheteur= array('name'=>'mailAcheteur','id'=>'mailAcheteur','placeholder'=>'Entrer votre adresse mail','value'=>set_value('mailAcheteur'));
    echo form_input($mailAcheteur);
    echo "<br>";
    echo "<br>";
    $loginAcheteur= array('name'=>'loginAcheteur','id'=>'loginAcheteur','placeholder'=>'Votre nom d\'utilisateur','value'=>set_value('loginAcheteur'));
    echo form_input($loginAcheteur);
    echo "<br>";
    echo "<br>";
    $mdpPremierAcheteur= array('name'=>'mdpPremierAcheteur','id'=>'mdpPremierAcheteur','placeholder'=>'Entrer votre mot de passe','value'=>set_value('mdpPremierAcheteur'));
    echo form_input($mdpPremierAcheteur);
    echo "<br>";
    echo "<br>";
    $mdpConfirmeAcheteur= array('name'=>'mdpConfirmeAcheteur','id'=>'mdpConfirmeAcheteur','placeholder'=>'retaper votre mot de passe','value'=>set_value('mdpConfirmeAcheteur'));
    echo form_input($mdpConfirmeAcheteur);
    echo "<br>";
    echo "<br>";
    $raisonSocialEntrepriseAcheteur= array('name'=>'raisonSocialEntreprise','id'=>'raisonSocialEntreprise','placeholder'=>'Raison social de l\'entreprise ','value'=>set_value('raisonSocialEntreprise'));
    echo form_input($raisonSocialEntrepriseAcheteur);
    echo "<br>";
    echo "<br>";
    $villeAcheteur= array('name'=>'villeAcheteur','id'=>'villeAcheteur','placeholder'=>'Votre ville','value'=>set_value('villeAcheteur'));
    echo form_input($villeAcheteur);
    echo "<br>";
    echo "<br>";
    $adresseAcheteur= array('name'=>'adresseAcheteur','id'=>'adresseAcheteur','placeholder'=>'Votre adresse ','value'=>set_value('adresseAcheteur'));
    echo form_input($adresseAcheteur);
    echo "<br>";
    echo "<br>";
    $codePostalAcheteur= array('name'=>'codePostalAcheteur','id'=>'codePostalAcheteur','placeholder'=>'Votre code postal ','value'=>set_value('codePostalAcheteur'));
    echo form_input($codePostalAcheteur);
    echo "<br>";
    echo "<br>";
    $numHabilitation= array('name'=>'numHabilitation','id'=>'numHabilitation','placeholder'=>'Le numéro d\'habilitation ','value'=>set_value('numHabilitation'));
    echo form_input($numHabilitation);

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