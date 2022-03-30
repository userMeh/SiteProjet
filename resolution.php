<?php
for ($i=0; $i < 4; $i++) {
  //source et destination
  $source = 'imageJeux/'.$_POST['nom'].$i.'.jpg';
  $dest = 'imageJeux/'.$_POST['nom'].$i.'.jpg';

  //resolution voulue
  $size = getimagesize($source);
  $width = $size[0];
  $height = $size[1];

  //resize
  $rwidth = 1920;
  $rheight = 1080;

  //ouverture de l'image
  $original = imagecreatefromjpeg($source);

  //resize
  $resized = imagecreatetruecolor($rwidth, $rheight);
  imagecopyresampled(
    $resized, $original,
    0, 0, 0, 0,
    $rwidth, $rheight,
    $width, $height
  );

  //sauvegarder l'image redimensionner
  imagejpeg($resized, $dest);
}

?>
