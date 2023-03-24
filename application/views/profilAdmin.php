<?php
defined('BASEPATH') OR exit('No direct script access allowed');


if(empty($_SESSION['login'])){
    header('Location: connexion');
  }

  if ($this->session->flashdata('succes')) { ?>
    <p class="text-danger text-center" style="margin-top: 10px;color: green;">
      <?= $this->session->flashdata('succes') ?></p>
  <?php } 
  
  echo "Bonjour M.Admin !"; 
  echo "<br>";
  echo $_SESSION['login'];
?>