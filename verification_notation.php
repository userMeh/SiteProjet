<?php

include "includes/bdd.php";
session_start();

$array = explode('/', $_GET['note']);

$note = $array[0];
$jeu = $array[1];

if ($note < 1 || $note > 5) {
  header('location:index.php');
  exit;

} else {
  $query = $bdd -> query('SELECT COUNT(nom) AS count FROM JEUX WHERE nom="'.$jeu.'"');
  $count = $query-> fetch();

  if ($count['count'] != 1) {
    header('location:index.php');
    exit;

  } else if(!isset($_SESSION['compte'])) {
    header('location:page_jeu.php?jeu='.$jeu.'/Veuillez vous connecter pour pouvoir noter');
    exit;

  } else {
    $query = $bdd -> query('SELECT COUNT(voteur) AS voteur FROM NOTE WHERE voteur="'.$_SESSION['compte'].'" AND nom="'.$jeu.'"');
    $count = $query-> fetch();

    if ($count['voteur'] == 1) {
      $query = $bdd -> query('SELECT id FROM NOTE WHERE voteur="'.$_SESSION['compte'].'" AND nom="'.$jeu.'"');
      $id = $query -> fetch();

      $query = $bdd->query('UPDATE NOTE SET valeur="'.$note.'" WHERE id="'.$id['id'].'"');
      if ($query) {
        header('location:page_jeu.php?jeu='.$jeu.'/succès_notation2');
        exit;
      } else {
        header('location:page_jeu.php?jeu='.$jeu.'/Une erreur est survenu lors de la notation');
        exit;
      }

    } else {
      $query = $bdd -> query('SELECT id FROM NOTE ORDER BY id DESC');
      $incr = $query -> fetchAll(PDO::FETCH_COLUMN);
      if (!$incr) {
        $incr[0] = -1;
      }

      $query = $bdd -> prepare('INSERT INTO NOTE(id,voteur,valeur,nom) VALUES(:id, :voteur, :valeur, :nom)');
      $result = $query -> execute([
        'id' => $incr[0] + 1,
        'voteur' => $_SESSION['compte'],
        'valeur' => $note,
        'nom' => $jeu
      ]);

      if ($result) {
        header('location:page_jeu.php?jeu='.$jeu.'/succès_notation1');
        exit;
      } else {
        header('location:page_jeu.php?jeu='.$jeu.'/Une erreur est survenu lors de la notation');
        exit;
      }
    }
  }
}

?>
