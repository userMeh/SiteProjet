<?php

include "includes/bdd.php";

$bdd -> query('UPDATE AVATAR SET id_visage = '.$_POST['visage'].' WHERE email="'.$_POST['email'].'"');
$bdd -> query('UPDATE AVATAR SET id_cheveux = '.$_POST['cheveux'].' WHERE email="'.$_POST['email'].'"');
$bdd -> query('UPDATE AVATAR SET id_yeux = '.$_POST['yeux'].' WHERE email="'.$_POST['email'].'"');
$bdd -> query('UPDATE AVATAR SET id_sourcil = '.$_POST['sourcils'].' WHERE email="'.$_POST['email'].'"');
$bdd -> query('UPDATE AVATAR SET id_bouche = '.$_POST['bouche'].' WHERE email="'.$_POST['email'].'"');
$bdd -> query('UPDATE AVATAR SET id_barbe = '.$_POST['barbe'].' WHERE email="'.$_POST['email'].'"');

header("location:profil.php");
exit;

?>
