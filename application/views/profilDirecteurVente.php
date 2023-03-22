<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(empty($_SESSION['login'])){
    header('Location: connexion');
  }
  // faire verification de mdp
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Page d'accueil du directeur de vente</title>
    <!-- Lien vers le fichier CSS de Bootstrap -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Directeur de vente</a>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() . 'listeLots'; ?>">Liste Lot(s)</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Envoie Lot(s)</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container">
      <h1>Bienvenue, Directeur de vente : <?php echo $_SESSION['login']; ?></h1>
      <p>
        [...]
      </p>
    </div>

