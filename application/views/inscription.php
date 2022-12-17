<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*if(empty($_SESSION['securitePersonnel'])){
  header('Location: pageMotDePasseFaux');
}*/

?>



<?php
    echo "<br>";
    echo form_open('welcome/inscriptionAcheteur',array('method'=>'post'));
?>
    <center>
	<h1>Formulaire d'inscription</h1>
    </center>
    <center>
	<?php
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

    $numRueAcheteur= array('name'=>'numRueAcheteur','id'=>'numRueAcheteur','placeholder'=>'Votre numéro de rue ','value'=>set_value('numRueAcheteur'));
    echo form_input($numRueAcheteur);
    echo "<br>";
    echo "<br>";

    $nomRueAcheteur= array('name'=>'nomRueAcheteur','id'=>'nomRueAcheteur','placeholder'=>'Votre nom de rue ','value'=>set_value('nomRueAcheteur'));
    echo form_input($nomRueAcheteur);
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
    


    <?php
    if($this->session->flashdata('error')) { ?>
      <p class="text-danger text-center" style="margin-top: 10px;color: red;">
      <?=$this->session->flashdata('error')?></p>
    <?php }?>

     <?php
    if($this->session->flashdata('succes')) { ?>
      <p class="text-danger text-center" style="margin-top: 10px;color: green;">
      <?=$this->session->flashdata('succes')?></p>
    <?php }?>
    
</center>


	<?php
    echo form_close();
?>
<script src="<?php echo base_url().'script/script.js';?>"> 
</script>
</html>