<?php
include "includes/bdd.php";

if (isset($_GET['fav'])) {
  $get = explode("/", $_GET['fav']);
  $jeu = current($get);
  $id = next($get);

  $prepare = $bdd -> prepare('INSERT INTO FAVORI(id, nom) VALUES(:id, :nom)');
  $prepare -> execute([
    'id' => $id,
    'nom' => $jeu
    ]);

  $query = $bdd -> query('SELECT email FROM BIBLIOTHEQUE WHERE id="'.$id.'"');
  $email = $query -> fetchAll(PDO::FETCH_COLUMN);

  if(!file_exists("logs/favoris")){
    mkdir("logs/favoris", 0777);
  }

  $logs = fopen("logs/favoris/$email[0].txt", "a+");
  date_default_timezone_set('Europe/Paris');
  $date = date('d/m/Y à H:i:s');
  $txt = "$email[0] a ajouté le jeu $jeu le $date dans sa bibliothèque\n";
  fwrite($logs, $txt);
  fclose($logs);

  header('location:page_jeu.php?jeu='.$jeu.'');



} else if(isset($_GET['defav'])) {



  $get = explode("/", $_GET['defav']);
  $jeu = current($get);
  $id = next($get);

  $query = $bdd -> query('DELETE FROM FAVORI WHERE id="'.$id.' AND nom='.$jeu.'"');

  $query = $bdd -> query('SELECT email FROM BIBLIOTHEQUE WHERE id="'.$id.'"');
  $email = $query -> fetchAll(PDO::FETCH_COLUMN);

  if(!file_exists("logs/favoris")){
    mkdir("logs/favoris", 0777);
  }

  $logs = fopen("logs/favoris/$email[0].txt", "a+");
  date_default_timezone_set('Europe/Paris');
  $date = date('d/m/Y à H:i:s');
  $txt = "$email[0] a retiré le jeu $jeu le $date de sa bibliothèque\n";
  fwrite($logs, $txt);
  fclose($logs);

  header('location:page_jeu.php?jeu='.$jeu.'');



} else {
  header('location:index.php');
}
?>
