<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<h3>Ajouter un lot à la vente</h3>



<?php
    echo "<br>";
    echo form_open('welcome/ajouterLot',array('method'=>'post'));
?>

<select name="NomEspece" id="NomEspece"> 
        <option value="default" <?php echo set_select('NomEspece','default',TRUE);?> >Choisissez un nom d'espece</option >
        <?php
        foreach($nomEspece as $espece) 
                      {
                      echo '<option name="NomEspece"    value="'.$espece['nomEspece'].'">'.$espece['nomEspece'].'</option>';
                      }
        ?>

</select>

<?php
    $nomCommunEspece= array('name'=>'nomCommunEspece','id'=>'nomCommunEspece','placeholder'=>'','value'=>set_value('nomCommunEspece'));
        echo form_input($nomCommunEspece);
        echo "<br>";
        echo "<br>";
?>

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

<script src="<?php echo base_url().'script/addLot.js';?>"> 
</script>
