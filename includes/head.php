<?php

try {
  $bdd = new PDO('mysql:host=164.132.229.139:3306;dbname=site','meh','meh123');
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Erreur : " . $e->getMessage();
}

session_start();

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="css et js/style.css?<?php echo time(); ?>">
<link rel="shortcut icon" type="image/png" href="../images/Logic.logo.png" />
