<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<head>
	<link rel="stylesheet" href="<?php echo base_url().'style\profilAdmin.css';?>">
</head>

<?php
foreach ($idAdmin as $key) {
  $_SESSION['numeroUsers'] = $key['idAdmin'];
}

if (empty($_SESSION['login'])) {
  header('Location: connexion.php');

} elseif ($_SESSION['login'] != 'laurent') {
  header('Location: erreur.php');
}

  if ($this->session->flashdata('succes')) { ?>
  <div style="margin: auto; width: fit-content; background: rgba(0, 0, 0, 0.6); border-radius: 10px;">
    <p class="text-center" style="padding: 10px; margin: 10px; color: lime;">
      <?= $this->session->flashdata('succes') ?></p> <?php } ?>
  </div>

  

<div class="container">

		<div class="item">
		<h1> Bienvenue <?php echo $_SESSION['login']?></h1>
		<a class="btn btn-primary" href="<?php echo site_url('ajoutLot');?>" role="button">Ajouter un lot</a>
		<a class="btn btn-primary" href="<?php echo site_url('liste_lots_admin');?>" role="button">Liste des lots</a>
    <a class="btn btn-primary" href="<?php echo site_url('gestionAcheteur');?>" role="button">Gestion des acheteurs</a>
		</div>
</div>