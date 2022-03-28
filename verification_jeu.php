<?php

include ('includes/bdd.php');

$doublon=$bdd->prepare('SELECT nom FROM JEUX WHERE nom=?');
$doublon->execute([
  $_POST['nom']
]);

$result=$doublon->fetchAll(); //Recupere les utilisateurs sous forme de tableau
if(count($result) != 0){      //Pour voir si le tableau est pas vide
  $message="Le jeu est déjà ajouté ou le nom est déjà utilisé";
  header('location:ajout_jeu.php?message='.$message);
  exit;

  $array = explode('/', $_POST['date_sortie']);
  if (count($array) != 3) {
    $message="La date de sortie n'est pas écrit dans le bon format";
    header('location:ajout_jeu.php?message='.$message);
    exit;
  } else {
    $jour = current($array);
    $mois = next($array);
    $annee = next($array);

    if ($jour <=31 && $mois <= 12 && $annee <= date('Y')) {
      $date_sortie = $jour .'/'. $mois .'/'. $annee;
    } else {
      $message="Les informations de la date de sortie sont invalides";
      header('location:ajout_jeu.php?message='.$message);
      exit;
    }
  }

} else {

  $uploadsPath = 'imageJeux';
  if(!file_exists($uploadsPath)){
    mkdir($uploadsPath, 0777);
  }

  $imagePrincipale = $_FILES['image']['name'];
  $array = explode('.', $imagePrincipale);
  $ext = end($array);
  $imagePrincipale = $_POST['nom'] . '0' . '.' . $ext;
  $destination = $uploadsPath . '/' . $imagePrincipale;
  move_uploaded_file($_FILES['image']['tmp_name'], $destination);

  $carousel1 = $_FILES['carousel1']['name'];
  $array = explode('.', $carousel1);
  $ext = end($array);
  $carousel1 = $_POST['nom'] . '1' . '.' . $ext;
  $destination = $uploadsPath . '/' . $carousel1;
  move_uploaded_file($_FILES['carousel1']['tmp_name'], $destination);

  $carousel2 = $_FILES['carousel2']['name'];
  $array = explode('.', $carousel2);
  $ext = end($array);
  $carousel2 = $_POST['nom'] . '2' . '.' . $ext;
  $destination = $uploadsPath . '/' . $carousel2;
  move_uploaded_file($_FILES['carousel2']['tmp_name'], $destination);

  $carousel3 = $_FILES['carousel3']['name'];
  $array = explode('.', $carousel3);
  $ext = end($array);
  $carousel3 = $_POST['nom'] . '3' . '.' . $ext;
  $destination = $uploadsPath . '/' . $carousel3;
  move_uploaded_file($_FILES['carousel3']['tmp_name'], $destination);


  $request=$bdd->prepare('INSERT INTO JEUX(nom, synopsis, date_sortie, developpeur, note, nb_note, image, systeme, processeur, memoire, graphique, directX, carousel1, carousel2, carousel3) VALUES (:nom, :synopsis, :date_sortie, :developpeur, :note, :nb_note, :image, :systeme, :processeur, :memoire, :graphique, :directX, :carousel1, :carousel2, :carousel3)');
  $result=$request->execute([
    'nom' => $_POST['nom'],
    'synopsis' => $_POST['synopsis'],
    'date_sortie' => $_POST['date_sortie'],
    'developpeur' => $_POST['developpeur'],
    'note' => 0,
    'nb_note' => 0,
    'image' => $imagePrincipale,
    'systeme' => $_POST['systeme'],
    'processeur' => $_POST['processeur'],
    'memoire' => $_POST['memoire'],
    'graphique' => $_POST['graphique'],
    'directX' => $_POST['directX'],
    'carousel1' => $carousel1,
    'carousel2' => $carousel2,
    'carousel3' => $carousel3
  ]);

  if($result){
    $message="succès jeu";
    header('location:ajout_jeu.php?message='.$message);
    exit;
  } else {
    $message="Erreur lors de l'ajout";
    header('location:ajout_jeu.php?message='.$message);
    exit;
  }
}

?>
