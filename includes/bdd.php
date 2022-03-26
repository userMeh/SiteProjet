<?php

try {
  $bdd = new PDO('mysql:host=164.132.229.139:3306;dbname=site', 'meh', 'meh123');
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Erreur : " . $e->getMessage();
}

?>
