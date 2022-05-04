<?php

include "includes/bdd.php";


if (isset($_GET['modify'])) {
  $query = $bdd -> prepare('UPDATE TOURNOI SET description=:description WHERE nom_du_jeu=:nom_du_jeu');
  $query -> execute([
    'description' => $_POST['synopsis'],
    'nom_du_jeu' => $_GET['modify']
  ]);

  $message="succès modification";
  header('location:page_tournoi.php?jeu='.$_GET['modify'].'/'.$message);
  exit;
}




?>
