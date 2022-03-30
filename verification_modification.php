<?php

include ('includes/bdd.php');

if(isset($_GET['modify'])){

  $pseudo = $_GET['modify'];

  {
    if (strlen($_POST['pseudo']) >= 3 && strlen($_POST['pseudo']) <= 14) {
      if ($pseudo!=$_POST['pseudo']) {

        $doublon=$bdd->prepare('SELECT pseudo FROM UTILISATEURS WHERE pseudo=:pseudo');
        $doublon->execute([
          'pseudo'=>$_POST['pseudo']
        ]);

        $result=$doublon->fetchAll(); //Recupere les utilisateurs sous forme de tableau
        if( count($result)!=0 ){      //Pour voir si le tableau est pas vide
          $message="le pseudo est déjà utilisé";
          header('location:liste_utilisateurs.php?message='.$message);
          exit;
        }

      $changePseudo = $bdd->prepare('UPDATE UTILISATEURS SET pseudo=:pseudo WHERE pseudo=:ancienPseudo');
      $changePseudo -> execute([
        'ancienPseudo'=>$pseudo,
        'pseudo'=>$_POST['pseudo']
      ]);
    }
      $changeType = $bdd->prepare('UPDATE UTILISATEURS SET type=:type WHERE pseudo=:pseudo');
      $changeType -> execute([
        'type'=>$_POST['type'],
        'pseudo'=>$pseudo
      ]);
      $message="succès modification";
      header('location:liste_utilisateurs.php?message='.$message);
      exit;
    } else {
      $message="Le pseudo saisit ne contient pas entre 3 et 14 caractère";
      header('location:liste_utilisateurs.php?message='.$message);
      exit;
    }
  }
} else if(isset($_GET['delete'])) {
  $delete = $bdd->prepare('DELETE FROM UTILISATEURS WHERE pseudo=:pseudo');
  $delete -> execute([
    'pseudo'=>$_GET['delete']
  ]);
  $message="succès suppression";
  header('location:liste_utilisateurs.php?message='.$message);
  exit;
} else {
  header('location:liste_utilisateurs.php');
  exit;
}

?>
