<?php

include ('includes/bdd.php');

if(isset($_GET['delete'])){

  $jeu = str_replace("-"," ",$_GET['delete']);               //Pour remettre les espaces a la place des - pour les retrouver dans la bdd

  $bdd->query('DELETE FROM GENRE_JEUX WHERE nom_jeux="'.$jeu.'"');   //Pour supprimer les donnees de la table GENRE_JEUX
  $bdd->query('DELETE FROM JEUX WHERE nom="'.$jeu.'"');              //sinon on peut pas a cause de la cle etrangere
  $message="succès suppression jeu";
  header('location:liste_jeux.php?message='.$message);
  exit;

} else {

  $doublon=$bdd->prepare('SELECT nom FROM JEUX WHERE nom=?');
  $doublon->execute([
    $_POST['nom']
  ]);

  $result=$doublon->fetchAll(); //Recupere les utilisateurs sous forme de tableau
  if(count($result) != 0){      //Pour voir si le tableau est pas vide
    $message="Le jeu est déjà ajouté ou le nom est déjà utilisé";
    header('location:ajout_jeu.php?message='.$message);
    exit;

  } else {

    if(isset($_POST['genre'])){

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

      include "resolution.php";

      $request=$bdd->prepare('INSERT INTO JEUX(nom, synopsis, date_sortie, developpeur, note, nb_note, image, systeme, processeur, memoire, graphique, directX, carousel1, carousel2, carousel3, redirection, nb_vues)
      VALUES (:nom, :synopsis, :date_sortie, :developpeur, :note, :nb_note, :image, :systeme, :processeur, :memoire, :graphique, :directX, :carousel1, :carousel2, :carousel3, :redirection, :nb_vues)');
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
        'carousel3' => $carousel3,
        'redirection' => $_POST['redirection'],
        'nb_vues' => 0
      ]);

      $genre = $_POST['genre'];

      $i=0;
      do {
        $insert = $bdd->prepare('INSERT INTO GENRE_JEUX(nom_genre, nom_jeux) VALUES((SELECT nom FROM GENRE WHERE nom=:nom_genre), (SELECT nom FROM JEUX WHERE nom=:nom_jeux))');
        $insert->execute([
          'nom_genre'=> $genre[$i],
          'nom_jeux'=> $_POST['nom']
        ]);
        $i++;
      } while ($i < count($genre));

    } else {
      $message="Aucun genre n'a été selectionné";
      header('location:ajout_jeu.php?message='.$message);
      exit;
    }

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
}

?>
