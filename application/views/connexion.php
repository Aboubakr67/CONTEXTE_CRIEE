<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
    echo "<br>";
    echo form_open('welcome/connectionAcheteur',array('method'=>'post'));
?>
    <center>
	    <h1>Se connecter</h1>
    

    <label for='text'>Role</label>
    <br>

        <select name="role">
        <option value="Acheteur" selected>Acheteur</option>
        <option value="Admin">Admin</option>
        <option value="Directeur">Directeur de vente</option>   
        </select>
    
</center>

	<?php

    echo "<center>";
    echo "<label for='text'>Mail</label>";
    echo "<br>";
    $mailAcheteur= array('name'=>'mailAcheteur','id'=>'mailAcheteur','placeholder'=>'Entrer votre adresse mail','value'=>set_value('mailAcheteur'));
    echo form_input($mailAcheteur);
    echo "<br>";
    echo "<br>";

    echo "<label for='text'>Mot de passe</label>";
    echo "<br>";
    $mdpAcheteur= array('name'=>'mdpAcheteur','id'=>'mdpAcheteur','placeholder'=>'Entrer votre mot de passe','value'=>set_value('mdpAcheteur'));
    echo form_input($mdpAcheteur);
    
    echo "<br>";
    echo "<br>";
    echo form_submit('envoi', 'Connection');
    
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

	<?php
    echo form_close();
    echo "</center>";
?>
<script src="<?php echo base_url().'script/script.js';?>"> 
</script>
</html>
