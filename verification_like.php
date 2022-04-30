<?php

include "includes/bdd.php";

session_start();

$_GET['id'];
$_GET['nature'];
$_GET['compte'];

$compte = $_GET['compte'];
$id = $_GET['id'];
$nature = $_GET['nature'];

if(!file_exists("logs/like")){
  mkdir("logs/like", 0777);
}

if ($_GET['nature'] == 'recherche') {
  $file = file("logs/like/$id.txt");
  $file = array_reverse($file);
  if (preg_match("#retiré#", $file[0])){
    echo 0;
  } else if (preg_match("#dislike#", $file[0])) {
    echo 2;
  } else if (preg_match("#like#", $file[0])){
    echo 1;
  }
} else {
  $logs = fopen("logs/like/$id.txt", "a+");
  date_default_timezone_set('Europe/Paris');
  $date = date('d/m/Y à H:i:s');
  $txt = "$compte a $nature ce poste à $date\n";
  fwrite($logs, $txt);
  fclose($logs);
}

?>
