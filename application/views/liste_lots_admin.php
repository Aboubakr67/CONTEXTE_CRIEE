<?php
defined('BASEPATH') or exit('No direct script access allowed');


if (empty($_SESSION['login'])) {
  if ($_SESSION['login'] != 'laurent')
    header('Location: connexion');
}
?>

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
			foreach($affToutLots as $r) {
				echo "<tr><td>".$r['idLot']."</td><td>".$r["idBateau"]."</td><td>".$r["datePeche"]."</td><td>".$r["idEspece"]."</td><td>".$r["idTaille"]."</td><td>".$r["idPresentation"]."</td><td>".$r["idBac"]."</td><td>".$r["idAcheteur"]."</td><td>".$r["idQualite"]."</td><td>".$r["idAdmin"]."</td><td>".$r["idDirecteur"]."</td><td>".$r["idFacture"]."</td><td>".$r["poidsBrutLot"]."</td><td>".$r["prixPlancher"]."</td><td>".$r["prixDepart"]."</td><td>".$r["prixEnchereMax"]."</td><td>".$r["dateEnchere"]."</td><td>".$r["heureDebutEnchere"]."</td><td>".$r["codeEtat"]."</td></tr>";
				//(`idLot` `idBateau`, `datePeche`, `idEspece`, `idTaille`, `idPresentation`, `idBac`, `idAcheteur`, `idQualite`, `idAdmin`, `idDirecteur`, `idFacture`, `poidsBrutLot`, `prixPlancher`, `prixDepart`, `prixEnchereMax`, `dateEnchere`, `heureDebutEnchere`, `codeEtat`)

			}
		?>
		</table>
	

		<br><br><br><br><br>