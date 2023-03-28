<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(empty($_SESSION['login'])){
    header('Location: connexion');
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enchere</title>
    <style>
        table {
            border-collapse: collapse; /* fusionne les bordures des cellules adjacentes */
        }

        table td, th {
            border: 1px solid black; /* ajoute une bordure noire d'une épaisseur de 1 pixel */
            padding: 8px; /* ajoute un peu d'espace entre le contenu de la cellule et la bordure */
        }
    </style>
</head>
<body>
    <h1>Bienvenue à la page enchère</h1>
    <a href="<?php echo site_url('panier');?>">
        <img src="<?php echo base_url() . 'image/panier.png'; ?>" width="50px">
    </a>

    <h2>Lots précédents</h2>

    <table>
	<th>N° Lot</th>
	<th>Espèce</th>
	<th>Taille</th>
	<th>Poids</th>
	<th>Prix enchéri</th>
	<th>Nom de l'acheteur</th>
		<?php
			foreach($affDeuxLotsPrecedents as $r) {
				echo "<tr><td>".$r['idLot']."</td><td>".$r["nomEspece"]."</td><td>".$r["specification"]."</td><td>".$r["poidsBrutLot"]."</td><td>".$r["prixEnchere"]."</td><td>".$r["login"]."</td></tr>";
			}
		?>
	</table>

    <h2>Lot en vente</h2>

    <table>
    <th>N° Lot</th>
	<th>Espèce</th>
	<th>Taille</th>
	<th>Poids</th>
	<th>Présentation</th>
	<th>Qualité</th>
    <th>Bateau</th>
    <?php
		foreach($affLotEnVente as $r) {
			echo "<tr><td>".$r['idLot']."</td><td>".$r["nomEspece"]."</td><td>".$r["specification"]."</td><td>".$r["poidsBrutLot"]."</td><td>".$r["libellePr"]."</td><td>".$r["nomQualite"]."</td><td>".$r["nomBateau"]."</td></tr>";
		}
	?>
    </table>

    <h2>Lots suivants</h2>

    <table>
    <th>N° Lot</th>
	<th>Espèce</th>
	<th>Taille</th>
	<th>Présentation</th>
	<th>Qualité</th>
    <th>Poids net</th>
    <th>Bateau</th>
    <?php
		foreach($affLotsSuivants as $r) {
			echo "<tr><td>".$r['idLot']."</td><td>".$r["nomEspece"]."</td><td>".$r["specification"]."</td><td>".$r["libellePr"]."</td><td>".$r["nomQualite"]."</td><td>".$r["(L.poidsBrutLot - BAC.tare)"]."</td><td>".$r["nomBateau"]."</td></tr>";
		}
	?>
    </table>




</body>
</html>