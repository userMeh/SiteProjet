<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Test</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css et js/test.css">
</head>

<header>
  <?php include "includes/header.php" ?>
</header>

<?php
for ($i=1; $i < 10; $i++) {
  //source et destination
  $source = 'captcha/'.$i.'.jpg';
  $dest = 'captcha/'.$i.'.jpg';

  //resolution voulue
  $size = getimagesize($source);
  $width = $size[0];
  $height = $size[1];

  //resize
  $rwidth = 110;
  $rheight = 110;

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

<body>
    <main>
      <div class="container p-5">

        <div id="puzzle_container">
        <div class="puzzle_block"><img src="captcha/1.jpg"></div>
        <div class="puzzle_block"><img src="captcha/2.jpg"></div>
        <div class="puzzle_block"><img src="captcha/3.jpg"></div>
        <div class="puzzle_block"><img src="captcha/4.jpg"></div>
        <div class="puzzle_block"><img src="captcha/5.jpg"></div>
        <div class="puzzle_block"><img src="captcha/6.jpg"></div>
        <div class="puzzle_block"><img src="captcha/7.jpg"></div>
        <div class="puzzle_block"><img src="captcha/8.jpg"></div>
    </div>
    <div id="difficulty_container">
        <div class="difficulty_button">Recharger</div>
    </div>

    <script src="css et js/script.js"></script>

      </div>
    </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
