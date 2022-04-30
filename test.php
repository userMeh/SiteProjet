<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "includes/head.php" ?>
    <title>Test</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<header>
  <?php include "includes/header.php" ?>
</header>
<body>
  <div class="container">
    <?php

    $file = file("logs/like/3.txt");
    $file = array_reverse($file);
    $countLike = 0;
    $countDislike = 0;

    $query = $bdd->query('SELECT email FROM UTILISATEURS');
    $compte = $query->fetchAll(PDO::FETCH_COLUMN);
    $count = count($compte);

    for ($i=0; $i < $count; $i++) {
      foreach($file as $f){
        if (preg_match("#$compte[$i]#", $f)==1){

          if (preg_match("#retiré#", $f)){

          } else if (preg_match("#dislike#", $f)) {
            $countDislike += 1;
          } else if (preg_match("#like#", $f)){
            echo $f.'<br>';
            $countLike += 1;
          }
          break;
        }
      }
    }

    //preg_match("#tonmot#", $fichier);
    ?>

  </div>
  <script src="css-js/captcha.js?<?php echo time(); ?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
-->

</html>
