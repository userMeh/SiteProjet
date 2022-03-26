<?php
if (isset($_GET['message'])) {
  if ($_GET['message']=='succès') {
    echo '<div class="alert alert-success mt-4" role="alert">';
    echo "Compte créé avec succès";
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
