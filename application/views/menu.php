<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <head>
    <meta charset="utf-8" content="width=device-width, initial-scale=1.0" >
    <link rel="stylesheet" href="<?php echo base_url().'style/bootsrapMin.css';?>">
    <link rel="stylesheet" href="<?php echo base_url().'style/bootsrap.css';?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.2.2/cerulean/bootstrap.min.css" integrity="sha512-9u5YwIpV3mbAd1ocXZRz1Ezzq8DGicGD+PuUkUiTtTU3Yc95IMc66/Txe/iNxGTxckPu60RQw8zphvVqYiRfTg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
  </head>
  <body>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> -->

    
<!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#disabled">Navigateur</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a style="color: brown;" class="nav-link" href="<?php //echo base_url().'Welcome/inscription';?>">Inscription</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php //echo site_url('Welcome/connexion');?>">Connexion</a>
      </li>
    </ul>
  </div>
</nav> -->




<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor03">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" href="#">Home
            <span class="visually-hidden">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url('Welcome/connexion');?>">Connexion</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url('inscription');?>">inscription</a>
        </li>
      </ul>
    </div>
  </div>
</nav>