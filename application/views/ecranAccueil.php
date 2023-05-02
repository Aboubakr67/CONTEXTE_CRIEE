<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<head>
	<link rel="stylesheet" href="<?php echo base_url().'style\ecranAccueil.css';?>">
    <meta charset="utf-8" content="width=device-width, initial-scale=1.0" >
    <link rel="stylesheet" href="<?php echo base_url().'css\style.css';?>">
    <link rel="stylesheet" href="<?php echo base_url().'style/bootsrapMin.css';?>">
    <link rel="stylesheet" href="<?php echo base_url().'style/bootsrap.css';?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.2.2/cerulean/bootstrap.min.css" integrity="sha512-9u5YwIpV3mbAd1ocXZRz1Ezzq8DGicGD+PuUkUiTtTU3Yc95IMc66/Txe/iNxGTxckPu60RQw8zphvVqYiRfTg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  </head>

<?php if ($this->session->flashdata('logout_message')) { ?>
    <div class="alert alert-success"><?php echo $this->session->flashdata('logout_message'); ?></div>
<?php } ?>

<body>

<div class="container">

		<div class="item">
		<h1> Bienvenue sur la plateforme de la Criée !</h1>
		<a class="btn btn-primary" href="<?php echo site_url('connexion');?>" role="button">Connexion</a>
		<a class="btn btn-primary" href="<?php echo site_url('inscription');?>" role="button">S'inscrire</a>
		</div>
</div>


		
</body>







