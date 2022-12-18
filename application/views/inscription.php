<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<center>
 <!-- commentaire par wassim -->
<?php // si le flashdata à le même paramètre ici c'est error que dans la ou il va être appelé il va tout de suite l'éxecuter par exemple
// dans le welcome dans la fonction inscriptionAcheteur on peut voir que il y a un set_flashdata avec un paramètre error il va donc l'executer
// on est pas obliger de creer plusieurs $this->session->flashdata('error')) comme dans cette page mais juste besoin dans la page welcome de creer
// un set flash data et si par exemple c'est une erreur on a juste à lui donner comme paramètre error, et le message souhaité et il va l'affiché dans
// cette magnifique page d'inscription.
    if($this->session->flashdata('error')) { ?> 
      <p class="text-danger text-center" style="margin-top: 10px;color: red;">
      <?=$this->session->flashdata('error')?></p>
    <?php }?>


     <?php // pareil que pour en haut.
    if($this->session->flashdata('reussi')) { ?>
      <p class="text-danger text-center" style="margin-top: 10px;color: green !important;">
      <?=$this->session->flashdata('reussi')?></p>
    <?php }?>

<?php
    echo "<br>";
    echo form_open('welcome/inscriptionAcheteur',array('method'=>'post')); // ici on dit à la page d'inscription que à la fin du formulaire elle va tout envoyer 
                                                                      // via la méthode post à l'url welcome/inscriptionAcheteur.
?>
    <center>
	<h1>Formulaire d'inscription</h1>
    </center>
    <center>
	<?php
    echo "<br>";
    $mailAcheteur= array('name'=>'mailAcheteur','id'=>'mailAcheteur','placeholder'=>'Entrer votre adresse mail','value'=>set_value('mailAcheteur'));
    echo form_input($mailAcheteur); // on peut aussi le faire en html .
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
    echo form_submit('envoi', 'Valider'); // ici c'est le bouton valider.
	?>
    

    
</center>


	<?php
    echo form_close(); // on oublie pas de fermer le formulaire .
?>
<script src="<?php echo base_url().'script/script.js';?>">  // on met un script pour les mots de passe c'est mieux quand c'est dynamique .
</script>
</html>