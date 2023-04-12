<?php
defined('BASEPATH') or exit('No direct script access allowed');


if (empty($_SESSION['login'])) {
	header('Location: connexion.php');
  
  } elseif ($_SESSION['login'] != 'laurent') {
	header('Location: erreur.php');
  }
?>
<?php
if ($this->session->flashdata('succes')) { ?>
  <p class="text-danger text-center" style="margin-top: 10px;color: green;">
    <?= $this->session->flashdata('succes') ?></p>
<?php } 

?>


<!-- <body>
<h1>Tous les lots</h1>
  
  
  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID Lot</th>
        <th>ID Bateau</th>
        <th>Date Pêche</th>
        <th>ID Espèce</th>
        <th>ID Taille</th>
        <th>ID Présentation</th>
        <th>ID Bac</th>
        <th>ID Acheteur</th>
      <th>ID Qualité</th>
      <th>ID Admin</th>
      <th>ID Directeur</th>
      <th>ID Facture</th>
      <th>Poids Brut Lot</th>
      <th>Prix Plancher</th>
      <th>Prix Départ</th>
      <th>Prix Enchère Max</th>
      <th>Date Enchère</th>
      <th>Heure Début Enchère</th>
      <th>Code Etat</th>
    </tr>
  </thead>
    <?php
    foreach($affToutLots as $r) {
      $idLot = $r['idLot'];
      $nomBateau = $r['nomBateau'];
      $datePeche = $r['datePeche'];
      $nomEspece = $r['nomEspece'];
      $specificationTaille = $r['specification'];
      $libellePresentation = $r['libellePr'];
      $tareBac = $r['tare'];
      $acheteur = $r['acheteur'];
      $nomQualite = $r['nomQualite'];
      $admin = $r['admin'];
      $directeurVente = $r['directeurVente'];
      $idFacture = $r['idFacture'];
      $poidsBrutLot = $r['poidsBrutLot'];
      $prixPlancher = $r['prixPlancher'];
      $prixDepart = $r['prixDepart'];
      $prixEnchereMax = $r['prixEnchereMax'];
      $dateEnchere = $r['dateEnchere'];
      $heureDebutEnchere = $r['heureDebutEnchere'];
      $codeEtat = $r['codeEtat'];
      
      if($idFacture == NULL){
        $idFacture = "Aucun";
      }
      
      if($acheteur == NULL){
        $acheteur = "Aucun";
      }
      
      if($heureDebutEnchere == NULL){
        $heureDebutEnchere = "A programmer";
      }
      ?>
      <form action="<?php echo site_url('modifieLot');?>" method="POST">
      <?php
      echo "<tr>";
      echo "<td>".$idLot."</td>";
      echo "<td>".$nomBateau."</td>";
      echo "<td>".$datePeche."</td>";
      echo "<td>".$nomEspece."</td>";
      echo "<td>".$specificationTaille."</td>";
      echo "<td>".$libellePresentation."</td>";
      echo "<td>".$tareBac."</td>";
      echo "<td>".$acheteur."</td>";
      echo "<td>".$nomQualite."</td>";
      echo "<td>".$admin."</td>";
      echo "<td>".$directeurVente."</td>";
      echo "<td>".$idFacture."</td>";
      echo "<td>".$poidsBrutLot."</td>";
      echo "<td>".$prixPlancher."</td>";
      echo "<td>".$prixDepart."</td>";
      echo "<td>".$prixEnchereMax."</td>";
      echo "<td>".$dateEnchere."</td>";
      echo "<td>".$heureDebutEnchere."</td>";
      echo "<td>".$codeEtat."</td>";
      echo '<td><button type="submit">Modifier</button></td>';
      echo "</tr>";
      ?> 
<input type="hidden" name="idLot" value="<?php echo $idLot ?>">
<input type="hidden" name="nomBateau" value="<?php echo $nomBateau ?>">
<input type="hidden" name="datePeche" value="<?php echo $datePeche ?>">
<input type="hidden" name="nomEspece" value="<?php echo $nomEspece ?>">
<input type="hidden" name="specificationTaille" value="<?php echo $specificationTaille ?>">
<input type="hidden" name="libellePresentation" value="<?php echo $libellePresentation ?>">
<input type="hidden" name="tareBac" value="<?php echo $tareBac ?>">
<input type="hidden" name="acheteur" value="<?php echo $acheteur ?>">
<input type="hidden" name="nomQualite" value="<?php echo $nomQualite ?>">
<input type="hidden" name="admin" value="<?php echo $admin ?>">
<input type="hidden" name="directeurVente" value="<?php echo $directeurVente ?>">
<input type="hidden" name="idFacture" value="<?php echo $idFacture ?>">
<input type="hidden" name="poidsBrutLot" value="<?php echo $poidsBrutLot ?>">
<input type="hidden" name="prixPlancher" value="<?php echo $prixPlancher ?>">
<input type="hidden" name="prixDepart" value="<?php echo $prixDepart ?>">
<input type="hidden" name="prixEnchereMax" value="<?php echo $prixEnchereMax ?>">
<input type="hidden" name="dateEnchere" value="<?php echo $dateEnchere ?>">
<input type="hidden" name="heureDebutEnchere" value="<?php echo $heureDebutEnchere ?>">
<input type="hidden" name="codeEtat" value="<?php echo $codeEtat ?>">
      
</form> 
  
      <?php
    }
    ?>


     
    </table>
  </thead>
    </body> -->

<!-- 
<style>
  body {
    padding: 20px;
        }
        
        .navbar-brand {
            font-weight: bold;
            font-size: 24px;
          }

        .navbar-right {
            margin-right: 20px;
        }

        table {
            width: 100%;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        th,
        td {
            text-align: center;
        }

        th {
            font-weight: bold;
            background-color: #f2f2f2;
        }

        td input[type="checkbox"] {
            margin-left: auto;
            margin-right: auto;
            display: block;
        }

        .btn-valider {
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style> -->


    <!DOCTYPE html>
<html>
  <head>
    <title>Tableau de lots</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
      }
      h1 {
        text-align: center;
        color: #333;
        margin-top: 50px;
      }
      table {
        margin: 50px auto;
        border-collapse: collapse;
        width: 90%;
        max-width: 800px;
        background-color: white;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
      }
      th, td {
        padding: 15px;
        text-align: left;
      }
      th {
        background-color: #f2f2f2;
        color: #333;
        font-weight: bold;
        border-bottom: 2px solid #ddd;
      }
      td {
        border-bottom: 1px solid #ddd;
      }
      tr:nth-child(even) {
        background-color: #f9f9f9;
      }
      tr:hover {
        background-color: #f5f5f5;
      }
      /* button {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 5px 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 12px;
        margin: 0px;
        cursor: pointer;
      }
      button:hover {
        background-color: #3e8e41;
      } */

      .action-icons {
			display: grid;
      gap: 14px;
      
		
		}
		.edit-icon {
			color: green;
		}
		.delete-icon {
			color: red;
		}   

    /* -------------------------- */
    #modal-container {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0,0,0,0.4);
}

#modal-content {
  background-color: white;
  margin: 15% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

#modal-content h2 {
  margin-top: 0;
}

#modal-content input[type="text"] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  border: none;
  border-bottom: 2px solid #ccc;
}

#modal-content button[type="submit"],
#modal-content button[type="button"] {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

#modal-content button[type="submit"]:hover,
#modal-content button[type="button"]:hover {
  opacity: 0.8;
}

@media screen and (max-width: 600px) {
  #modal-content {
    width: 100%;
  }
}


    </style>
  </head>
  <body>
    <h1>Tous les lots</h1>
    <table>
      <thead>
        <tr>
          <th>ID Lot</th>
          <th>ID Bateau</th>
          <th>Date Pêche</th>
          <th>ID Espèce</th>
          <th>ID Taille</th>
          <th>ID Présentation</th>
          <th>ID Bac</th>
          <th>ID Acheteur</th>
          <th>ID Qualité</th>
          <th>ID Admin</th>
          <th>ID Directeur</th>
          <th>ID Facture</th>
          <th>Poids Brut Lot</th>
          <th>Prix Plancher</th>
          <th>Prix Départ</th>
          <th>Prix Enchère Max</th>
          <th>Date Enchère</th>
          <th>Heure Début Enchère</th>
          <th>Code Etat</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($affToutLots as $r) { ?>
          <form action="<?php echo site_url('modifieLot');?>" method="POST">
        <tr>
          <td><?php echo $r['idLot']; ?></td>
          <td><?php echo $r['nomBateau']; ?></td>
          <td><?php echo $r['datePeche']; ?></td>
          <td><?php echo $r['nomEspece']; ?></td>
          <td><?php echo $r['specification']; ?></td>
          <td><?php echo $r['libellePr']; ?></td>
          <td><?php echo $r['tare']; ?></td>
          <td><?php echo $r['acheteur'] ? $r['acheteur'] : "Aucun" ?></td>
          <td><?php echo $r['nomQualite'] ?></td>
          <td><?php echo $r['admin'] ?></td>
          <td><?php echo $r['directeurVente'] ?></td>
          <td><?php echo $r['idFacture'] ? $r['idFacture'] : "Aucun" ?></td>
          
          
          <td><?php echo $r['poidsBrutLot']; ?></td>
          <td><?php echo $r['prixPlancher']; ?></td>
          <td><?php echo $r['prixDepart']; ?></td>
          <td><?php echo $r['prixEnchereMax']; ?></td>
          <td><?php echo $r['dateEnchere']; ?></td>
          <td><?php echo $r['heureDebutEnchere'] ? $r['heureDebutEnchere'] : "A programmer" ?></td>
          <td><?php echo $r['codeEtat']; ?></td>
         
            <td class="action-icons"><button type="submit"><i class="fas fa-edit"></i></button>
            
          
          <!-- A changer les variables $idLot etc par $r[''] -->
          <input type="hidden" name="idLot" value="<?php echo $r['idLot'] ?>">
          <input type="hidden" name="nomBateau" value="<?php echo $r['nomBateau'] ?>">
          <input type="hidden" name="datePeche" value="<?php echo $r['datePeche'] ?>">
          <input type="hidden" name="nomEspece" value="<?php echo $r['nomEspece'] ?>">
          <input type="hidden" name="specificationTaille" value="<?php echo $r['specification'] ?>">
          <input type="hidden" name="libellePresentation" value="<?php echo $r['libellePr'] ?>">
          <input type="hidden" name="tareBac" value="<?php echo $r['tare'] ?>">
          <input type="hidden" name="acheteur" value="<?php echo $r['acheteur'] ?>">
          <input type="hidden" name="nomQualite" value="<?php echo $r['nomQualite'] ?>">
          <input type="hidden" name="admin" value="<?php echo $r['admin'] ?>">
          <input type="hidden" name="directeurVente" value="<?php echo $r['directeurVente'] ?>">
          <input type="hidden" name="idFacture" value="<?php echo $r['idFacture'] ?>">
          <input type="hidden" name="poidsBrutLot" value="<?php echo $r['poidsBrutLot'] ?>">
          <input type="hidden" name="prixPlancher" value="<?php echo $r['prixPlancher'] ?>">
          <input type="hidden" name="prixDepart" value="<?php echo $r['prixDepart'] ?>">
          <input type="hidden" name="prixEnchereMax" value="<?php echo $r['prixEnchereMax'] ?>">
          <input type="hidden" name="dateEnchere" value="<?php echo $r['dateEnchere'] ?>">
          <input type="hidden" name="heureDebutEnchere" value="<?php echo $r['heureDebutEnchere'] ?>">
          <input type="hidden" name="codeEtat" value="<?php echo $r['codeEtat'] ?>">


</form> 
<button class="delete"><i class="fa-solid fa-trash"></i></button></td>
          
        
        </tr>
        <?php } ?>
        </table>
        </body>
        </html>




<script>
$(document).ready(function() {
  $('.delete').click(function() {
    // afficher une alerte avec un message
    alert('Voulez-vous vraiment supprimer cet élément ?');
  });
});

</script>

