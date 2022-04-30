<?php

include "includes/bdd.php";

if (isset($_GET['modify1'])) {
  $query = $bdd -> prepare('UPDATE JEUX SET synopsis=:synopsis WHERE nom=:nom');
  $query -> execute([
    'synopsis' => $_POST['synopsis'],
    'nom' => $_GET['modify1']
  ]);
  $message="succès modification";
  header('location:page_jeu.php?jeu='.$_GET['modify1'].'&message='.$message);
  exit;
}

if (isset($_GET['modify2'])) {
  $array = explode('/', $_POST['date_sortie']);
  if (count($array) != 3) {
    $message="La date de sortie n'est pas écrit dans le bon format";
    header('location:page_jeu.php?jeu='.$_GET['modify2'].'&message='.$message);
    exit;
  } else {
    $jour = current($array);
    $mois = next($array);
    $annee = next($array);

    if ($jour <=31 && $mois <= 12 && $annee <= date('Y')) {
      $date_sortie = $annee .'-'. $mois .'-'. $jour;
      $date_bdd = date('Y-m-d', strtotime($date_sortie));
      echo $date_bdd;
    } else {
      $message="Les informations de la date de sortie sont invalides";
      header('location:page_jeu.php?jeu='.$_GET['modify2'].'&message='.$message);
      exit;
    }
  }
  $query = $bdd -> prepare('UPDATE JEUX SET date_sortie=:date_sortie WHERE nom=:nom');
  $query -> execute([
    'date_sortie' => $date_bdd,
    'nom' => $_GET['modify2']
  ]);
  $query = $bdd -> prepare('UPDATE JEUX SET developpeur=:developpeur WHERE nom=:nom');
  $query -> execute([
    'developpeur' => $_POST['developpeur'],
    'nom' => $_GET['modify2']
  ]);
  $message="succès modification";
  header('location:page_jeu.php?jeu='.$_GET['modify2'].'&message='.$message);
  exit;
}

if (isset($_GET['modify3'])) {
  $query = $bdd -> prepare('UPDATE JEUX SET systeme=:systeme WHERE nom=:nom');
  $query -> execute([
    'systeme' => $_POST['systeme'],
    'nom' => $_GET['modify3']
  ]);
  $query = $bdd -> prepare('UPDATE JEUX SET processeur=:processeur WHERE nom=:nom');
  $query -> execute([
    'processeur' => $_POST['processeur'],
    'nom' => $_GET['modify3']
  ]);
  $query = $bdd -> prepare('UPDATE JEUX SET memoire=:memoire WHERE nom=:nom');
  $query -> execute([
    'memoire' => $_POST['memoire'],
    'nom' => $_GET['modify3']
  ]);
  $query = $bdd -> prepare('UPDATE JEUX SET graphique=:graphique WHERE nom=:nom');
  $query -> execute([
    'graphique' => $_POST['graphique'],
    'nom' => $_GET['modify3']
  ]);
  $query = $bdd -> prepare('UPDATE JEUX SET directX=:directX WHERE nom=:nom');
  $query -> execute([
    'directX' => $_POST['directX'],
    'nom' => $_GET['modify3']
  ]);
  $query = $bdd -> prepare('UPDATE JEUX SET redirection=:redirection WHERE nom=:nom');
  $query -> execute([
    'redirection' => $_POST['redirection'],
    'nom' => $_GET['modify3']
  ]);
  $message="succès modification";
  header('location:page_jeu.php?jeu='.$_GET['modify3'].'&message='.$message);
  exit;
}

?>
