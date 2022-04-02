<?php
if (isset($_GET['message'])) {
  if ($_GET['message']=='succès compte 1') {
    echo '<div class="alert alert-success mt-4" role="alert">';
    echo "Un mail de vérification a été envoyé";
    echo '</div>';
  } else if ($_GET['message']=='succès compte 2') {
    echo '<div class="alert alert-success mt-4" role="alert">';
    echo "Votre compte a bien été vérifié";
    echo '</div>';
  } else if ($_GET['message']=='succès jeu') {
    echo '<div class="alert alert-success mt-4" role="alert">';
    echo "Le jeu a été ajouté";
    echo '</div>';
  } else if ($_GET['message']=='succès genre') {
    echo '<div class="alert alert-success mt-4" role="alert">';
    echo "Le genre a été ajouté";
    echo '</div>';
  } else if ($_GET['message']=='succès modification') {
    echo '<div class="alert alert-success mt-4" role="alert">';
    echo "Les modifications ont bien été effectuées";
    echo '</div>';
  } else if ($_GET['message']=='succès suppression') {
    echo '<div class="alert alert-success mt-4" role="alert">';
    echo "L'utilisateur a bien été supprimer";
    echo '</div>';
  } else {
    if (isset($_GET['message'])) {
      echo '<div class="alert alert-danger mt-4" role="alert">';
      echo $_GET['message'];
      echo '</div>';
    }
  }
}
?>
