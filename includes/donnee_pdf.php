<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Profil</title>
    <?php include "bootstrap.php" ?>
    <?php include "bdd.php" ?>
  </head>
  <body style="padding:50px">
    <?php

    $query = $bdd -> query('SELECT pseudo, email, date_creation FROM UTILISATEURS WHERE email="'.$_GET['compte'].'"');
    $utilisateur = $query -> fetch();

    // echo $utilisateur['pseudo'];
    // echo $utilisateur['email'];
    // echo $utilisateur['date_creation'];
    ?>
    <div style="background-color:midnightblue; color:white; padding:50px;">
      <div style="border:solid lightgrey; padding:50px;">
        <h1 style="display:flex; justify-content:center; text-decoration:underline;"><b>Informations personnelles</b></h1>
        <div>
          <p style="display:flex; justify-content:center;"><b>Votre pseudo :</b></p>
          <p style="display:flex; justify-content:center;"><?php echo $utilisateur['pseudo']; ?></p>
        </div>
        <div>
          <p style="display:flex; justify-content:center;"><b>Votre email :</b></p>
          <p style="display:flex; justify-content:center;"><?php echo $utilisateur['email']; ?></p>
        </div>
        <div>
          <p style="display:flex; justify-content:center;"><b>Date de création de votre compte :</b></p>
          <p style="display:flex; justify-content:center;"><?php echo $utilisateur['date_creation']; ?></p>
        </div>
      </div>
    </div>
  </body>
</html>
