<?php

  include ('includes/bdd.php');

  if (!empty($_POST['pseudo']) && isset($_POST['pseudo']) && !empty($_POST['mdp'])) {

    setcookie("cookies", $_POST['pseudo'], time()+7*24*3600);

  } else {
    $message="Vous devez remplir les 2 champs.";
    header('location:connexion.php?message='.$message.'');
    exit;
  }

  $verif=$bdd->prepare('SELECT * FROM UTILISATEURS WHERE pseudo= :pseudo AND mdp = :mdp');
  $verif->execute([
    'pseudo' => $_POST['pseudo'],
    'mdp' => hash('sha512', $_POST['mdp'])
  ]);
  $result = $verif->fetchAll();
  if(count($result)==0) {
    $message="identifiants incorrect";
    header('location:connexion.php?message='.$message.'');
  } else {
    $query = $bdd->query('SELECT email FROM UTILISATEURS WHERE pseudo="'.$_POST['pseudo'].'"');
    $email = $query -> fetchAll(PDO::FETCH_COLUMN);

    session_start();

    if(!file_exists("logs/connexion")){
      mkdir("logs/connexion", 0777);
    }

    $logs = fopen("logs/connexion/$email[0].txt", "a+");
    date_default_timezone_set('Europe/Paris');
    $date = date('d/m/Y à H:i:s');
    $txt = "$email[0] s'est connecté le $date\n";
    fwrite($logs, $txt);
    fclose($logs);

    $_SESSION['compte']=$email[0];
    header('location:index.php');
  }

?>
