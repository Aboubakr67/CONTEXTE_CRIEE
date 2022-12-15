<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<head>
	<link rel="stylesheet" href="css\style.css">
</head>


<!-- <table>
  <tr>
    <td>Nom</td>
    <td>Prénom</td>
    <td>Age</td>
    <td>Mail</td>
  </tr>
  <tr>
    <td>Giraud</td>
    <td>Pierre</td>
    <td>28</td>
    <td>pierre.giraud@edhec.com</td>
  </tr>
  <tr>
    <td>Joly</td>
    <td>Pauline</td>
    <td>27</td>
    <td>pjl@gmail.com</td>
  </tr>
</table> -->

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
			foreach($resultat as $r) {
				echo "<tr><td>".$r['idLot']."</td><td>".$r["idBateau"]."</td><td>".$r["datePeche"]."</td><td>".$r["idEspece"]."</td><td>".$r["idTaille"]."</td><td>".$r["idPresentation"]."</td><td>".$r["idBac"]."</td><td>".$r["idAcheteur"]."</td><td>".$r["idQualite"]."</td><td>".$r["idAdmin"]."</td><td>".$r["idDirecteur"]."</td><td>".$r["idFacture"]."</td><td>".$r["poidsBrutLot"]."</td><td>".$r["prixPlancher"]."</td><td>".$r["prixDepart"]."</td><td>".$r["prixEnchereMax"]."</td><td>".$r["dateEnchere"]."</td><td>".$r["heureDebutEnchere"]."</td><td>".$r["codeEtat"]."</td></tr>";
				//(`idLot` `idBateau`, `datePeche`, `idEspece`, `idTaille`, `idPresentation`, `idBac`, `idAcheteur`, `idQualite`, `idAdmin`, `idDirecteur`, `idFacture`, `poidsBrutLot`, `prixPlancher`, `prixDepart`, `prixEnchereMax`, `dateEnchere`, `heureDebutEnchere`, `codeEtat`)

			}
		?>
		</table>
	

