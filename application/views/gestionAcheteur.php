<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<?php

if (empty($_SESSION['login'])) {
  header('Location: connexion.php');

} elseif ($_SESSION['login'] != 'laurent') {
  header('Location: erreur.php');

}
?>
<html>
    <body>
    <div class="container">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID Acheteur</th>
        <th>Login</th>
        <th>Raison sociale de l'entreprise</th>
        <th>Numéro de rue de l'acheteur</th>
        <th>Nom de rue de l'acheteur</th>
        <th>Code postal</th>
        <th>Ville</th>
        <th>Numéro d'habilitation</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($ToutLesAcheteurs as $acheteur) { ?>
        <tr>
          <td><?php echo $acheteur['idAcheteur']; ?></td>
          <td><?php echo $acheteur['login']; ?></td>
          <td><?php echo $acheteur['raisonSocialeEntreprise']; ?></td>
          <td><?php echo $acheteur['numRueAcheteur']; ?></td>
          <td><?php echo $acheteur['nomRueAcheteur']; ?></td>
          <td><?php echo $acheteur['codePostal']; ?></td>
          <td><?php echo $acheteur['ville']; ?></td>
          <td><?php echo $acheteur['numHabilitation']; ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>


    </body>
</html>