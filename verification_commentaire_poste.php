<?php

include "includes/bdd.php";
session_start();

$query = $bdd -> query('SELECT id FROM COMMENTAIRE ORDER BY id DESC');
$id = $query -> fetchAll(PDO::FETCH_COLUMN);
if (!$id) {
  $id = 1;
} else {
  $id = $id[0]+1;
}

date_default_timezone_set('Europe/Paris');
$date_commentaire = date('d/m/Y');

$array = explode('/', $date_commentaire);
$jour = current($array);
$mois = next($array);
$annee = next($array);

$date_commentaire = $annee .'-'. $mois .'-'. $jour;
$date_bdd = date('Y-m-d', strtotime($date_commentaire));
$heure_commentaire = date('H:i');

$request=$bdd->prepare('INSERT INTO COMMENTAIRE(id, contenu, date_commentaire, id_poste, email, heure_commentaire) VALUES (:id, :contenu, :date_commentaire, :id_poste, :email, :heure_commentaire)');
$result=$request->execute([
  'id' => $id,
  'contenu' => $_POST['commentaire'],
  'date_commentaire' => $date_bdd,
  'id_poste' => $_POST['idPoste'],
  'email' => $_SESSION['compte'],
  'heure_commentaire' => $heure_commentaire
]);

header('location:page_poste.php?id='.$_POST['idPoste'])

?>
