<?php

include "includes/bdd.php";

if (isset($_POST['mdp']) && isset($_POST['conf_mdp'])){
  if ($_POST['mdp'] == $_POST['conf_mdp']) {
    $query = $bdd -> prepare('UPDATE UTILISATEURS SET mdp=? WHERE email=?');
    $result = $query -> execute([
      hash('sha512', $_POST['mdp']),
      $_POST['email']
    ]);

    header('location:recuperation.php?message=succès recuperation 2');
    exit;
  }
} else if (isset($_POST['email'])) {
  $query = $bdd -> prepare('SELECT email FROM UTILISATEURS WHERE email=?');
  $query -> execute([
    $_POST['email']
  ]);
  $result = $query -> fetchAll(PDO::FETCH_ASSOC);

  if(count($result) != 0) {

    include "includes/mail_recuperation.php";

    header('location:recuperation.php?message=succès recuperation');
    exit;
  } else {
    $message = "Cet email n'est pas renseigné dans la base de donnée";
    header('location:recuperation.php?message='.$message.'');
    exit;
  }
} else {
  header('location:recuperation.php');
  exit;
}

?>
