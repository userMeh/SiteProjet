<?php
include "includes/bdd.php";

session_start();
$compte = $_SESSION['compte'];

var_dump($_GET);



if (isset($_GET['participe'])) {
  $get = explode("/", $_GET['participe']);
  $email = current($get);
  $id = next($get);

  var_dump($email);
  var_dump($id);


  $query = $bdd -> query('SELECT nom_du_jeu FROM TOURNOI WHERE id="'.$id.'"');
  $tournoi = $query -> fetch();

    $query = $bdd -> query('SELECT nombre_participant FROM TOURNOI WHERE id="'.$id.'"');
    $participant_max = $query -> fetch();
    $query = $bdd -> query('SELECT participant_actuel FROM TOURNOI WHERE id="'.$id.'"');
    $participant = $query -> fetch();




    if ($participant[0] < $participant_max[0]) {
      $prepare = $bdd -> prepare('INSERT INTO PARTICIPATION(id, email) VALUES(:id, :email)');
      $prepare -> execute([
        'id' => $id,
        'email' => $email
        ]);


        $query = $bdd -> query('UPDATE TOURNOI SET participant_actuel= participant_actuel+1 WHERE id="'.$id.'"');

    }   else {
      header('location:page_tournoi.php?jeu='.$tournoi['nom_du_jeu']);
      exit;
    }


    if(!file_exists("logs/visite_tournoi/")){
      mkdir("logs/visite_tournoi/$compte", 0777,True);
    }

    $logs = fopen("logs/visite_tournoi/$compte.txt", "a+");
    date_default_timezone_set('Europe/Paris');
    $date = date('d/m/Y à H:i:s');
    $tournoi_log = $tournoi['nom_du_jeu'];
    $txt = "$email a été ajouté à la participation du tournoi $tournoi_log le $date\n";

    fwrite($logs, $txt);
    fclose($logs);

  header('location:page_tournoi.php?jeu='.$tournoi['nom_du_jeu'].'');
  exit;

} else if (isset($_GET['leave'])) {


  $get = explode("/", $_GET['leave']);
  $email = current($get);
  $id = next($get);

  $query = $bdd -> query('SELECT nom_du_jeu FROM TOURNOI WHERE id="'.$id.'"');
  $tournoi = $query -> fetch();

  $query = $bdd -> query('UPDATE TOURNOI SET participant_actuel= participant_actuel-1 WHERE id="'.$id.'"');


  $query = $bdd -> query('DELETE FROM PARTICIPATION WHERE id='.$id.' AND email="'.$email.'"');


  if(!file_exists("logs/visite_tournoi")){
    mkdir("logs/visite_tournoi", 0777);
  }

  $logs = fopen("logs/visite_tournoi/$email.txt", "a+");
  date_default_timezone_set('Europe/Paris');
  $date = date('d/m/Y à H:i:s');
  $tournoi_log = $tournoi['nom_du_jeu'];
  $txt = "$email a retiré sa participation au $tournoi_log le $date\n";
  fwrite($logs, $txt);
  fclose($logs);

  header('location:page_tournoi.php?jeu='.$tournoi['nom_du_jeu']);
  exit;

} else {
  header('location:index.php');
  exit;
}
?>
