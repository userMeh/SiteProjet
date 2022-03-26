<?php

  include ('includes/bdd.php');

  if (!empty($_POST['pseudo']) && isset($_POST['pseudo']) && !empty($_POST['mdp'])) {

    setcookie("cookies", $_POST['pseudo'], time()+7*24*3600);

  } else {
    $message="Vous devez remplir les 2 champs.";
    header('location:connexion.php?message='.$message.'');
    exit;
  }

  $verif=$bdd->prepare('SELECT * FROM UTILISATEURS WHERE pseudo= :pseudo AND mdp = :mdp');
  $verif->execute([
    'pseudo' => $_POST['pseudo'],
    'mdp' => hash('sha512', $_POST['mdp'])
  ]);
  $result = $verif->fetchAll();
  if(count($result)==0) {
    $message="identifiants incorrect";
    header('location:connexion.php?message='.$message.'');
  } else {
    session_start();
    $_SESSION['pseudo']=$_POST['pseudo'];
    header('location:index.php');
  }

?>
