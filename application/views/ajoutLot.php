<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php

  $DateAndTime = date('Y-m-d', time());  
  // echo "The current date and time are $DateAndTime.";
  $maDateMax = strtotime($DateAndTime."+ 2 days");
  $maxDate = date('Y-m-d',$maDateMax);

  $maDateMin = strtotime($DateAndTime."- 3 days");
  $minDate = date('Y-m-d',$maDateMin);
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
<br><br><br>

<!-- Espece details -->
<div >
            Nom commun de l'espèce : <span id='nomCE'>[selon l'index choisi du combobox]</span><br/>
            Nom scientifique de l'espèce : <span id='nomSE'>[selon l'index choisi du combobox]</span><br/>
</div>



<br><br><br><br>

<label for='text'>Taille : </label>
<select name="taille" id="taille"> 
  <option value="default" <?php echo set_select('taille','default',TRUE);?> >Choisir la taille</option >
          <?php
            foreach($taille as $key) 
                          {
                            echo '<option name="taille"    value="'.$key['idTaille'].'">'.$key['specification']." (".$key['codeTaille'].")".'</option>';
                          }
          ?>
</select>
<br><br><br>
  


<div>
     <label for="tare">Tare (kg) : <span id='tare'>[selon la taille]</span></label><br>
     <input type="text" id="idBac" name="idBac" hidden>
</div>




<br><br><br>




<label for="poidsBrut">Poids brut (kg) : </label>
<input type="number" id="poidsBrut" name="poidsBrut">
<br><br><br>


<label for="prixPlancher">Prix plancer (€) : </label>
<input type="number" id="prixPlancher" name="prixPlancher">
<br><br><br>


<label for="prixDepart">Prix de départ (€) : </label>
<input type="number" id="prixDepart" name="prixDepart">
<br><br><br>


<label for="prixEnchereMax">Prix enchère maximum (€) : </label>
<input type="number" id="prixEnchereMax" name="prixEnchereMax">
<br><br><br>

<label for="datePeche">Date enchère : </label>
<input type="date" id="dateEnchere" name="dateEnchere"
       value="<?php echo $DateAndTime; ?>"
       min="<?php echo $DateAndTime; ?>" max="">

<br><br><br>


<label for='text'>Qualité : </label>
<select name="qualite" id="qualite"> 
  <option value="default" <?php echo set_select('qualite','default',TRUE);?> >Choisir la qualité</option >
          <?php
            foreach($qualite as $key) 
                          {
                            echo '<option name="qualite"    value="'.$key['idQualite'].'">'.$key['codeQualite'].'</option>';
                          }
          ?>
</select>
<label for="text">E: Extra | A: Glacé | B: Déclassé</label>
<br><br><br>



<label for='text'>Libellé de la présentation : </label>
<select name="presentation" id="presentation"> 
  <option value="default" <?php echo set_select('presentation','default',TRUE);?> >Choisir la presentation</option >
          <?php
            foreach($presentation as $key) 
                          {
                            echo '<option name="presentation"    value="'.$key['idPresentation'].'">'.$key['libellePr'].'</option>';
                          }
          ?>
</select>
<br><br><br>



<label for='text'>Nom du bateau : </label>
<select name="bateau" id="bateau"> 
  <option value="default" <?php echo set_select('bateau','default',TRUE);?> >Choisir un bateau</option >
          <?php
            foreach($bateau as $key) 
                          {
                            echo '<option name="bateau"    value="'.$key['idBateau'].'">'.$key['nomBateau'].'</option>';
                          }
          ?>
</select>
<br><br><br>

<label for="datePeche">Date de pêche : </label>


<input type="date" id="datePeche" name="datePeche"
       value="<?php echo $DateAndTime; ?>"
       min="<?php echo $minDate; ?>" max="<?php echo $maxDate; ?>">

<br><br><br>

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

<!-- Bibliothèque Jquery -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> -->
<script src="<?php echo base_url().'script/jquery-3.5.1.js';?>"></script>

<!-- Script javascript -->
<script src="<?php echo base_url().'script/addLot.js';?>"></script>


<!-- Permet d'afficher les details de l'espece en fonction du select -->
<script type="text/javascript">
            
            $(document).ready(function(){
                
              // Pour afficher les details des informations de l'espece choisit
                $('#nomEspece').change(function(){
                    var idEspece = $(this).val();
                    console.log("ID de l'epece " + idEspece);
                    $.ajax({
                        url: '<?= base_url() ?>index.php/Welcome/especeDetails',
                        type: 'post',
                        data: {idEspece: idEspece},
                        dataType: 'json',
                        success: function(response){
                            var len = response.length;
                            console.log(len);
                            console.log("marche");
                            $('#nomCE').text('');
                            $('#nomSE').text('');
                            
                            
            
                            if(len > 0){
                                // Read values
                                var uname = response[0].nomCommunEspece;
                                var name = response[0].nomScientifiqueEspece;
            
                                console.log(uname);
            
                                $('#nomCE').text(uname);
                                $('#nomSE').text(name);
                               
                            }

                            if (idEspece == "default") {
                                $('#nomCE').text("[selon l'index choisi du combobox]");
                                $('#nomSE').text("[selon l'index choisi du combobox]");
                            }
                           
                        },
                        error: function(response){
                            console.log("ERREUR ahaha");            
                        }
                    });
                });



                // Pour afficher le tare 
                $('#taille').change(function(){
                    var idTaille = $(this).val();
                    console.log("ID de taille " + idTaille);
                    $.ajax({
                        url: '<?= base_url() ?>index.php/Welcome/affTare',
                        type: 'post',
                        data: {idTaille: idTaille},
                        dataType: 'json',
                        success: function(response){
                            var len = response.length;
                            // console.log(len);
                            console.log("marche");
                            $('#tare').text('');
                            $('#idBac').text('');
                            
                            
                            if(len > 0){
                                // Read values
                                var taree = response[0].tare;
                                var idBac = response[0].idBac;
                                idBac = String(idBac);
                                
                                console.log(idBac);
                                $('#tare').text(taree);
                                document.getElementById('idBac').value = idBac;
                               
                            }

                            if (idTaille == "default") {
                                $('#tare').text("[selon la taille]");
                            }
                           
                        },
                        error: function(response){
                            console.log("ERREUR ahaha");
            
            
                        }
                    });
                });









            });
</script>