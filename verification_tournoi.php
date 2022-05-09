<?php

setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);


ini_set('display_errors', 1);


include ('includes/bdd.php');

$doublon=$bdd->prepare('SELECT nom_du_jeu FROM TOURNOI WHERE nom_du_jeu=?');
$doublon->execute([
  $_POST['nom_du_jeux'],
]);

$result=$doublon->fetchAll(); //Recupere les utilisateurs sous forme de tableau
if(count($result) != 0){      //Pour voir si le tableau est pas vide
  $message="Le tournoi est déjà ajouté ou le nom est déjà utilisé";
  header('location:ajout_tournoi.php?message='.$message);
  exit;
}

  $date = time();
  $date_de_depart = strtotime($_POST['date_de_depart']);
  $date_de_fin = strtotime($_POST['duree']);


  $date_now= strftime('%d %B %Y', $date);
  $date_de_debut = strftime('%d %B %Y', $date_de_depart);
  $duree = strftime('%d %B %Y', $date_de_fin);



  if ($date_de_depart > $date_de_fin || $date > $date_de_depart ) {
    $message="Les informations de la date de depart ou la date de fin sont invalides";
    header('location:ajout_tournoi.php?message='.$message);
    exit;
  }

    $uploads = 'imagetournoi';

    if(!file_exists($uploads)){
      mkdir($uploads,0777);
    }

    // Charge le cachet et la photo afin d'y appliquer le tatouage numérique
    $logo = imagecreatefrompng('images/Logic.logo.png');
    $imagePrincipale = imagecreatefrompng($_FILES['imagePrincipale']['name']);

    var_dump($logo);
    var_dump($imagePrincipale);
    exit;

// Définit les marges pour le cachet et récupère la hauteur et la largeur de celui-ci
  $marge_right = 10;
  $marge_bottom = 10;
  $sx = imagesx($logo);
  $sy = imagesy($logo);

// Copie le cachet sur la photo en utilisant les marges et la largeur de la
// photo originale  afin de calculer la position du cachet
  imagecopy($imagePrincipale, $logo, imagesx($imagePrincipale) - $sx - $marge_right, imagesy($imagePrincipale) - $sy - $marge_bottom, 0, 0, imagesx($logo), imagesy($logo));



    $imagePrincipale = $_FILES['imagePrincipale']['name'];
    $array = explode('.', $imagePrincipale);
    $ext = end($array);
    $imagePrincipale = $_POST['nom_du_jeux'] . '0' . '.' . $ext;
    $destination = $uploads . '/' . $imagePrincipale;
    move_uploaded_file($_FILES['imagePrincipale']['tmp_name'], $destination);

    var_dump($_FILES);



    $request=$bdd->prepare('INSERT INTO TOURNOI(nom_du_jeu,description, date_de_depart, duree, image, participant_actuel, nombre_participant, recompense)
    VALUES (:nom_du_jeu,:description,:date_de_depart, :duree, :image, :participant_actuel, :nombre_participant, :recompense)');
    $result=$request->execute([
      'nom_du_jeu' => $_POST['nom_du_jeux'],
      'description' => $_POST['description'],
      'date_de_depart' => $_POST['date_de_depart'],
      'participant_actuel' => 0,
      'nombre_participant' => $_POST['nombre_participant'],
      'image' => $imagePrincipale,
      'duree' => $_POST['duree'],
      'recompense' => $_POST['recompense']
    ]);



  if($result){
    $message="succès tournoi";
    header('location:ajout_tournoi.php?message='.$message);
    exit;
  } else {
    $message="Erreur lors de l'ajout";
    header('location:ajout_tournoi.php?message='.$message);
    exit;
  }

?>
