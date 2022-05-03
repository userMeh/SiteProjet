<?php

include "includes/bdd.php";
session_start();

$nom = $_POST["tag"];

$tag = str_replace("-"," ","$nom");

$query = $bdd -> query('SELECT id FROM POSTE ORDER BY id DESC');
$id = $query -> fetchAll(PDO::FETCH_COLUMN);
if (!$id) {
  $id = 1;
} else {
  $id = $id[0]+1;
}

if (isset($_GET['delete'])) {
  $bdd -> query('DELETE FROM COMMENTAIRE WHERE id_poste="'.$_GET['delete'].'"');
  $bdd -> query('DELETE FROM POSTE WHERE id="'.$_GET['delete'].'"');
  header('location:forum.php');
  exit;
}

date_default_timezone_set('Europe/Paris');
$date_poste = date('d/m/Y');

$array = explode('/', $date_poste);
$jour = current($array);
$mois = next($array);
$annee = next($array);

$date_poste = $annee .'-'. $mois .'-'. $jour;
$date_bdd = date('Y-m-d', strtotime($date_poste));
$heure_poste = date('H:i');

$request=$bdd->prepare('INSERT INTO POSTE(id, contenu, date_poste, email, titre, tag, heure_poste) VALUES (:id, :contenu, :date_poste, :email, :titre, :tag, :heure_poste)');
$result=$request->execute([
  'id' => $id,
  'contenu' => $_POST['contenu'],
  'date_poste' => $date_bdd,
  'email' => $_SESSION['compte'],
  'titre' => $_POST['titre'],
  'tag' => $tag,
  'heure_poste' => $heure_poste
]);

header('location:page_poste.php?id='.$id);
exit;

?>
