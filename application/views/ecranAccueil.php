<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<head>
	<link rel="stylesheet" href="css\style.css">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?php echo base_url().'style/styleForm.css';?>">
</head>
<?php if ($this->session->flashdata('logout_message')) { ?>
    <div class="alert alert-success"><?php echo $this->session->flashdata('logout_message'); ?></div>
<?php } ?>

<center>
<h1> Bienvenue sur la plateforme de la Criée ! </h1>
</center>

<center>
	<img src="<?php echo base_url().'image/imagebateau.jpg';?>">
	</center>
	<br>
</center>
		




