<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<head>
	<link rel="stylesheet" href="css\style.css">
</head>

<h1>Les lots</h1>
<br>
<table>
<tr>
	<td>idLot</td>
	<td>idBateau</td>
	<td>datePeche</td>
	<td>idEspece</td>
	<td>idTaille</td>
	<td>idPresentation</td>
	<td>idBac</td>
	<td>idAcheteur</td>
	<td>idQualite</td>
	<td>idAdmin</td>
	<td>idDirecteur</td>
	<td>idFacture</td>
	<td>poidsBrutLot</td>
	<td>prixPlancher</td>
	<td>prixDepart</td>
	<td>prixEnchereMax</td>
	<td>dateEnchere</td>
	<td>heureDebutEnchere</td>
	<td>codeEtat</td>
</tr>
		<?php
			foreach($result as $r) {
				echo "<tr><td>".$r['idLot']."</td><td>".$r["idBateau"]."</td><td>".$r["datePeche"]."</td><td>".$r["idEspece"]."</td><td>".$r["idTaille"]."</td><td>".$r["idPresentation"]."</td><td>".$r["idBac"]."</td><td>".$r["idAcheteur"]."</td><td>".$r["idQualite"]."</td><td>".$r["idAdmin"]."</td><td>".$r["idDirecteur"]."</td><td>".$r["idFacture"]."</td><td>".$r["poidsBrutLot"]."</td><td>".$r["prixPlancher"]."</td><td>".$r["prixDepart"]."</td><td>".$r["prixEnchereMax"]."</td><td>".$r["dateEnchere"]."</td><td>".$r["heureDebutEnchere"]."</td><td>".$r["codeEtat"]."</td></tr>";
				//(`idLot` `idBateau`, `datePeche`, `idEspece`, `idTaille`, `idPresentation`, `idBac`, `idAcheteur`, `idQualite`, `idAdmin`, `idDirecteur`, `idFacture`, `poidsBrutLot`, `prixPlancher`, `prixDepart`, `prixEnchereMax`, `dateEnchere`, `heureDebutEnchere`, `codeEtat`)

			}
		?>
		</table>
	

		<br><br><br><br><br>
		<h3>Num acheteur : </h3>
		<?php
			foreach($num as $r) {
				echo $r['idAcheteur'];

			}
		?>

		<!-- <?php
			foreach($result as $r) {
				echo $r['idLot'];
			}
		?> -->
<center>
<h1> Bienvenue sur la plateforme de la Criée ! </h1>
</center>
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?php echo base_url().'style/styleForm.css';?>">
	<center>
	<img src="<?php echo base_url().'image/imagebateau.jpg';?>">
	</center>
</head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?php echo base_url().'style/styleForm.css';?>">
	<center>
	<img src="<?php echo base_url().'image/imagebateau.jpg';?>">
	</center>
</head>