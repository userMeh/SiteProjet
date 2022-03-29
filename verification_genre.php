<?php

  include ('includes/bdd.php');

  $doublon=$bdd->prepare('SELECT nom FROM GENRE WHERE nom=?');
  $doublon->execute([
    $_POST['nom']
  ]);

  $result=$doublon->fetchAll();
  if( count($result)!=0 ){
    $message="Ce genre est déjà ajouté";
    header('location:ajout_genre.php?message='.$message);
    exit;
  }

  $request=$bdd->prepare('INSERT INTO GENRE(nom, description) VALUES (:nom, :description)');
  $result=$request->execute([
    'nom' => $_POST['nom'],
    'description' => $_POST['description']
  ]);
  if($result){
    $message="succès genre";
    header('location:ajout_genre.php?message='.$message);
    exit;
  } else {
    $message="Erreur lors de l'ajout";
    header('location:ajout_genre.php?message='.$message);
    exit;
  }

?>
