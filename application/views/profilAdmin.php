<?php
defined('BASEPATH') OR exit('No direct script access allowed');


if(empty($_SESSION['login'])){
    header('Location: connexion');
  }

  
  echo "Bonjour !"; 
  echo $_SESSION['login'];
?>