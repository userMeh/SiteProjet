<?php

use Dompdf\Dompdf;
use Dompdf\Options;

$session = $_GET['compte'];

include "includes/bdd.php";

$query = $bdd -> query('SELECT pseudo, email, date_creation FROM UTILISATEURS WHERE email="'.$_GET['compte'].'"');
$utilisateur = $query -> fetch();

$html = '
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Profil</title>
    <?php include "bootstrap.php" ?>
    <?php include "bdd.php" ?>
  </head>
  <body style="padding:50px">
    <div style="background-color:midnightblue; color:white; padding:50px;">
      <div style="border:solid lightgrey; padding:50px;">
        <h1 style="display:flex; justify-content:center; text-decoration:underline;"><b>Informations personnelles</b></h1>
        <div>
          <p style="display:flex; justify-content:center;"><b>Votre pseudo :</b></p>
          <p style="display:flex; justify-content:center;">'.$utilisateur['pseudo'].'</p>
        </div>
        <div>
          <p style="display:flex; justify-content:center;"><b>Votre email :</b></p>
          <p style="display:flex; justify-content:center;">'.$utilisateur['email'].'</p>
        </div>
        <div>
          <p style="display:flex; justify-content:center;"><b>Date de création de votre compte :</b></p>
          <p style="display:flex; justify-content:center;">'.$utilisateur['date_creation'].'</p>
        </div>
      </div>
    </div>
  </body>
</html>';

require_once "includes/dompdf/autoload.inc.php";

$options = new Options();
$options -> set('defaultFont', 'Times-Roman');

$dompdf =  new Dompdf($options);

$dompdf -> loadHtml($html);
$dompdf -> setPaper('A4', 'portrait');
$dompdf -> render();

$nom = $utilisateur['pseudo'];

$dompdf -> stream($nom);

?>
