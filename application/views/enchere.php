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
</head>
<body>
    <h1>Bienvenue à la page enchère</h1>
    <a href="<?php echo site_url('panier');?>">
        <img src="<?php echo base_url() . 'image/panier.png'; ?>" width="50px">
    </a>
</body>
</html>