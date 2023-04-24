<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <head>
    <meta charset="utf-8" content="width=device-width, initial-scale=1.0" >
    <link rel="stylesheet" href="<?php echo base_url().'css\style.css';?>">
    <link rel="stylesheet" href="<?php echo base_url().'style/bootsrapMin.css';?>">
    <link rel="stylesheet" href="<?php echo base_url().'style/bootsrap.css';?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.2.2/cerulean/bootstrap.min.css" integrity="sha512-9u5YwIpV3mbAd1ocXZRz1Ezzq8DGicGD+PuUkUiTtTU3Yc95IMc66/Txe/iNxGTxckPu60RQw8zphvVqYiRfTg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  </head>
  <body>


  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="<?php echo base_url().'image/baleine.png';?>" style="width:50px; height:50px;"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor03">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" href="<?php echo site_url('enc');?>">Enchere
            <span class="visually-hidden">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url('helpAcheteur');?>">Aide</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url('panier');?>">Panier</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
      <?php
      if(isset($_SESSION['login'])) {
        // utilisateur connecté
      ?>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url('deconnexion');?>"><span class="material-symbols-outlined">logout</span></a>
        </li>
      <?php } ?>

      </ul>
    </div>
  </div>
</nav>

<style>
.material-symbols-outlined {
  font-variation-settings:
  'FILL' 0,
  'wght' 400,
  'GRAD' 0,
  'opsz' 48
}
</style>
