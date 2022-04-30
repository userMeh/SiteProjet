<?php

$countLike = 0;
$countDislike = 0;

if (file_exists("logs/like/$id.txt")) {
  $file = file("logs/like/$id.txt");
  $file = array_reverse($file);

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
          $countLike += 1;
        }
        break;
      }
    }
  }
}

?>
