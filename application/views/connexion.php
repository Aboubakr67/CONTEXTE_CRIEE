<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
    echo "<br>";
    echo form_open('welcome/connexion',array('method'=>'post'));

    
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
    $mail= array('name'=>'mail','id'=>'mail','placeholder'=>'Entrer votre adresse mail','value'=>set_value('mail'));
    echo form_input($mail);
    echo "<br>";
    echo "<br>";

    echo "<label for='text'>Mot de passe</label>";
    echo "<br>";
    $mdp= array('name'=>'mdp','id'=>'mdp','placeholder'=>'Entrer votre mot de passe','value'=>set_value('mdp'));
    echo form_input($mdp);
    
    echo "<br>";
    echo "<br>";
    echo form_submit('envoi', 'Connection');
    
    
    if($this->session->flashdata('error')) { ?> 
    <p class="text-danger text-center" style="margin-top: 10px;color: red;">
    <?=$this->session->flashdata('error')?></p>
    <?php }
    
    echo form_close();
    echo "</center>";
?>
<script src="<?php echo base_url().'script/script.js';?>"> 
</script>
</html>
