<?php

include ('includes/bdd.php');


$doublon=$bdd->prepare('SELECT id FROM TOURNOI WHERE id=?');
$doublon->execute([
  $_POST['id']
]);

$result=$doublon->fetchAll(); //Recupere les utilisateurs sous forme de tableau
if(count($result) != 0){      //Pour voir si le tableau est pas vide
  $message="Le tournoi est déjà ajouté ou le nom est déjà utilisé";
  header('location:ajout_tournoi.php?message='.$message);
  exit;
} else {
  $array = explode('/', $_POST['date_de_depart']);
  if (count($array) != 3) {
    $message="La date de sortie n'est pas écrit dans le bon format";
    header('location:ajout_tournoi.php?message='.$message);
    exit;
  } else {
    $jour = current($array);
    $mois = next($array);
    $annee = next($array);

    if ($jour <=31 && $mois <= 12 && $annee >= date('Y')) {
      $date_de_depart = $jour .'/'. $mois .'/'. $annee;
    } else {
      $message="Les informations de la date de depart sont invalides";
      header('location:ajout_tournoi.php?message='.$message);
      exit;
    }

    if ($jour <=31 && $mois <= 12 && $annee >= date('Y')) {
      $duree = $jour .'/'. $mois .'/'. $annee;
    } else {
      $message="Les informations de la date de depart sont invalides";
      header('location:ajout_tournoi.php?message='.$message);
      exit;
    }
    
    if(!file_exists($uploadsPath)){
      mkdir($uploadsPath,0777);
    }

    $imagePrincipale = $_FILES['image']['nom_du_jeux'];
    $array = explode('.', $imagePrincipale);
    $ext = end($array);
    $imagePrincipale = $_POST['nom_du_jeux'] . '0' . '.' . $ext;
    $destination = $uploadsPath . '/' . $imagePrincipale;
    move_uploaded_file($_FILES['image']['nom_du_jeux'], $destination);

    include "resolution.php";

    $request=$bdd->prepare('INSERT INTO TOURNOI(nom_du_jeux,description, date_de_depart, duree, image, id, participant_actuel, nombre_participant)
    VALUES (:nom_du_jeux,:description,:date_de_depart, :duree, :image, :id, :participant_actuel, :nombre_participant)');
    $result=$request->execute([
      'id' => $_POST['id'],
      'nom_du_jeux' => $_POST['nom_du_jeux'],
      'description' => $_POST['description'],
      'date_de_depart' => $_POST['date_de_depart'],
      'participant_actuel' => 0,
      'nombre_participant' => $_POST['nombre_participant'],
      'image' => $imagePrincipale,
      'duree' => $_POST['duree']
    ]);
  }

  if($result){
    $message="succès tournoi creer";
    header('location:ajout_tournoi.php?message='.$message);
    exit;
  } else {
    $message="Erreur lors de l'ajout";
    header('location:ajout_tournoi.php?message='.$message);
    exit;
  }
}
?>
