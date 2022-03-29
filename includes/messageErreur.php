<?php
if (isset($_GET['message'])) {
  if ($_GET['message']=='succès') {
    echo '<div class="alert alert-success mt-4" role="alert">';
    echo "Compte créé avec succès";
    echo '</div>';
  } else if ($_GET['message']=='succès jeu') {
    echo '<div class="alert alert-success mt-4" role="alert">';
    echo "Le jeu a été ajouté";
    echo '</div>';
  } else if ($_GET['message']=='succès genre') {
    echo '<div class="alert alert-success mt-4" role="alert">';
    echo "Le genre a été ajouté";
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
