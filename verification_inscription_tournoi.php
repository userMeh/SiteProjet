<?php
include "includes/bdd.php";

var_dump($_GET);
exit;

$query = $bdd -> query('SELECT count(id) FROM PARTICIPATION WHERE id='.$id.' AND email="'.$compte.'"');
$participation = $query -> fetchAll(PDO::FETCH_COLUMN);

var_dump($participation);
exit;

if($participants)
if (isset($_GET['tournoi'])) {
  $get = explode("/", $_GET['tournoi']);
  $compte = current($get);
  $id = next($get);
$doublon=$bdd->prepare('SELECT pseudo FROM UTILISATEURS WHERE email=?');
$doublon->execute([
  $_POST['email']
]);
$result=$doublon->fetchAll();
if( count($result)!=0){
  $prepare = $bdd -> prepare('INSERT INTO PARTICIPATION(id, email) VALUES(:id, :email)');
  $prepare -> execute([
    'id' => $id,
    'email' => $email
    ]);
    $query = $bdd -> query('SELECT nom_du_jeu FROM TOURNOI WHERE id="'.$id.'"');
    $tournoi = $query -> fetchAll(PDO::FETCH_COLUMN);

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
  exit;
}else{
    header('location:page_tournoi.php?jeu='.$tournoi.'');
    exit;
  }

?>
