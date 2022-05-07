<?php
include "includes/bdd.php";


if (isset($_GET['participe'])) {
  $get = explode("/", $_GET['participe']);
  $email = current($get);
  $id = next($get);

  $query = $bdd -> query('SELECT nom_du_jeu FROM TOURNOI WHERE id="'.$id.'"');
  $tournoi = $query -> fetchAll(PDO::FETCH_COLUMN);


  $prepare = $bdd -> prepare('INSERT INTO PARTICIPATION(id, email) VALUES(:id, :email)');
  $prepare -> execute([
    'id' => $id,
    'email' => $email
    ]);
    if(!file_exists("logs/visite_tournoi/")){
      mkdir("logs/visite_tournoi/$compte", 0777,True);
    }

    $logs = fopen("logs/visite_tournoi/$compte.txt", "a+");
    date_default_timezone_set('Europe/Paris');
    $date = date('d/m/Y à H:i:s');
  $txt = "$email a été ajouté à la participation du tournoi $tournoi le $date \n";

    fwrite($logs, $txt);
    fclose($logs);

  header('location:page_tournoi.php?jeu='.$tournoi.'');



} else(isset($_GET['leave'])) {


  $get = explode("/", $_GET['leave']);
  $email = current($get);
  $id = next($get);

  $query = $bdd -> query('SELECT nom_du_jeu FROM TOURNOI WHERE id="'.$id.'"');
  $tournoi = $query -> fetchAll(PDO::FETCH_COLUMN);


  $query = $bdd -> query('DELETE FROM PARTICIPATION WHERE id='.$id.' AND email="'.$email.'"');


  if(!file_exists("logs/visite_tournoi")){
    mkdir("logs/visite_tournoi", 0777);
  }

  $logs = fopen("logs/visite_tournoi/$email.txt", "a+");
  date_default_timezone_set('Europe/Paris');
  $date = date('d/m/Y à H:i:s');
  $txt = "$email a retiré sa participation au $tournoi le $date\n";
  fwrite($logs, $txt);
  fclose($logs);

  header('location:page_tournoi.php?jeu='.$tournoi.'');



} else {
  header('location:index.php');
}
?>
