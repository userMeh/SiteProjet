<?php

include "includes/bdd.php";
session_start();

$query = $bdd -> query('SELECT id FROM COMMENTAIRE_JEUX ORDER BY id DESC');
$id = $query -> fetchAll(PDO::FETCH_COLUMN);
if (!$id) {
  $id = 1;
} else {
  $id = $id[0]+1;
}

if (isset($_GET['delete'])) {
  $query = $bdd -> query('SELECT nom FROM COMMENTAIRE_JEUX WHERE id="'.$_GET['delete'].'"');
  $jeu = $query -> fetch();
  $query = $bdd -> query('DELETE FROM COMMENTAIRE_JEUX WHERE id="'.$_GET['delete'].'"');
  header('location:page_jeu.php?jeu='.$jeu['nom']);
  exit;
}

date_default_timezone_set('Europe/Paris');
$date_commentaire = date('d/m/Y');

$array = explode('/', $date_commentaire);
$jour = current($array);
$mois = next($array);
$annee = next($array);

$date_commentaire = $annee .'-'. $mois .'-'. $jour;
$date_bdd = date('Y-m-d', strtotime($date_commentaire));
$heure = date('H:i');

$request=$bdd->prepare('INSERT INTO COMMENTAIRE_JEUX(id, date, heure, nom, email, contenu) VALUES (:id, :date, :heure, :nom, :email, :contenu)');
$result=$request->execute([
  'id' => $id,
  'date' => $date_bdd,
  'heure' => $heure,
  'nom' => $_POST['nomJeu'],
  'email' => $_SESSION['compte'],
  'contenu' => $_POST['commentaire']
]);

header('location:page_jeu.php?jeu='.$_POST['nomJeu']);
exit;

?>
