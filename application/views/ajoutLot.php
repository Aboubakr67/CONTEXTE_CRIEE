<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<h3>Ajouter un lot à la vente</h3>



<?php
    echo "<br>";
    echo form_open('welcome/ajouterLot',array('method'=>'post'));
?>

<label for='text'>Nom de l'espèce : </label>
<select name="nomEspece" id="nomEspece"> 
        <option value="default" <?php echo set_select('nomEspece','default',TRUE);?> >Choisissez un nom d'espece</option >
        <?php
        foreach($nomEspece as $espece) 
                      {
                      echo '<option name="nomEspece"    value="'.$espece['idEspece'].'">'.$espece['nomEspece'].'</option>';
                      }
        ?>
</select>
<br><br>

<label for='text'>Taille : </label>
<select name="taille" id="taille"> 
        <option value="default" <?php echo set_select('taille','default',TRUE);?> ></option >
        <?php
        foreach($tailleBac as $taille) 
                      {
                      echo '<option name="taille"    value="'.$taille['idBac'].'">'.$taille['tare'].'</option>';
                      }
        ?>
</select>
<br><br>





<br><br>
  

    <center>
	<?php    
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

<script src="<?php echo base_url().'script/addLot.js';?>"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->