<?php

include "includes/bdd.php";

if(isset($_GET['modify'])){

  $pseudo = $_GET['modify'];

  //Pour les logs
  $query = $bdd->query('SELECT type FROM UTILISATEURS WHERE pseudo="'.$_POST['pseudo'].'"');
  $type = $query -> fetchAll(PDO::FETCH_COLUMN);
  //

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

      if ($_POST['type'] == "admin") {
        $bddType = 1;
      }

      $changeType = $bdd->prepare('UPDATE UTILISATEURS SET type=:type WHERE pseudo=:pseudo');
      $changeType -> execute([
        'type'=>$bddType,
        'pseudo'=>$pseudo
      ]);

      if(!file_exists("logs/modification")){
        mkdir("logs/modification", 0777);
      }

      $query = $bdd->query('SELECT email FROM UTILISATEURS WHERE pseudo="'.$_POST['pseudo'].'"');
      $email = $query -> fetchAll(PDO::FETCH_COLUMN);

      $nouvPseudo = $_POST['pseudo'];
      $nouvType = $_POST['type'];

      $logs = fopen("logs/modification/$email[0].txt", "a+");
      date_default_timezone_set('Europe/Paris');
      $date = date('d/m/Y à H:i:s');

      if ($type[0] == 1) {
        $logType = "admin";
      } else {
        $logType = "utilisateur";
      }

      $txt = "$email[0] a été modifié le $date, son pseudo a été changé de $pseudo à $nouvPseudo et ses droits sont passées de $logType à $nouvType\n";
      fwrite($logs, $txt);
      fclose($logs);

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

  if(!file_exists("logs/modification")){
    mkdir("logs/modification", 0777);
  }

  $query = $bdd->query('SELECT email FROM UTILISATEURS WHERE pseudo="'.$_GET['delete'].'"');
  $email = $query -> fetchAll(PDO::FETCH_COLUMN);

  $logs = fopen("logs/modification/+.suppression.txt", "a+");
  date_default_timezone_set('Europe/Paris');
  $date = date('d/m/Y à H:i:s');
  $txt = "$email[0] a été supprimé le $date\n";
  fwrite($logs, $txt);
  fclose($logs);

  $delete = $bdd->prepare('DELETE FROM UTILISATEURS WHERE pseudo=:pseudo');
  $delete -> execute([
    'pseudo'=>$_GET['delete']
  ]);

  $message="succès suppression utilisateur";
  header('location:liste_utilisateurs.php?message='.$message);
  exit;

} else if(isset($_GET['ban'])) {

  $query = $bdd->query('SELECT email FROM UTILISATEURS WHERE pseudo="'.$_GET['ban'].'"');
  $email = $query -> fetchAll(PDO::FETCH_COLUMN);

  $query = $bdd -> query('SELECT type FROM UTILISATEURS WHERE pseudo="'.$_GET['ban'].'"');
  $isBan = $query -> fetchAll(PDO::FETCH_COLUMN);

  if ($isBan[0] == 2) {
    $logs = fopen("logs/modification/$email[0].txt", "a+");
    date_default_timezone_set('Europe/Paris');
    $date = date('d/m/Y à H:i:s');

    $txt = "$email[0] a été débanni le $date\n";
    fwrite($logs, $txt);
    fclose($logs);

    $ban = $bdd->prepare('UPDATE UTILISATEURS SET type=:type WHERE pseudo=:pseudo');
    $ban -> execute([
      'type' => 0,
      'pseudo'=>$_GET['ban']
    ]);

    $message="succès modification";
    header('location:liste_utilisateurs.php?message='.$message);
    exit;

  } else {
    if(!file_exists("logs/modification")){
      mkdir("logs/modification", 0777);
    }

    $logs = fopen("logs/modification/$email[0].txt", "a+");
    date_default_timezone_set('Europe/Paris');
    $date = date('d/m/Y à H:i:s');

    $txt = "$email[0] a été banni le $date\n";
    fwrite($logs, $txt);
    fclose($logs);

    $ban = $bdd->prepare('UPDATE UTILISATEURS SET type=:type WHERE pseudo=:pseudo');
    $ban -> execute([
      'type' => 2,
      'pseudo'=>$_GET['ban']
    ]);

    $message="succès modification";
    header('location:liste_utilisateurs.php?message='.$message);
    exit;
  }

} else {
  header('location:liste_utilisateurs.php');
  exit;
}

?>
