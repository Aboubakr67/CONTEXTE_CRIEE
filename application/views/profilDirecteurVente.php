<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(empty($_SESSION['login'])){
    header('Location: connexion');
  }

  echo "Bonjour M. Directeur de vente !"; 
  echo "<br>";
  echo $_SESSION['login'];
?>
