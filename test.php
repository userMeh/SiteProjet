<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Test</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css et js/style.css">
</head>

<header>
  <?php include "includes/header.php" ?>
</header>

<body>

  <?php

  $jeu='test-a';

  echo '
  <div class="col-4 d-flex justify-content-end pe-3">
  <button type="button" class="btn-close btn-danger btn-sm" aria-label="Close" data-bs-toggle="modal" data-bs-target="#suppression'.$jeu.'"></button>
  </div>

  <div class="modal fade popup" id="suppression'.$jeu.'" tabindex="-1" aria-labelledby="suppressionLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="suppressionLabel">Suppression</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Etes-vous sûr de supprimer ce jeu de la base de donnée? Cet action est irréversible !
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <a type="button" class="btn btn-danger" href="verification_jeu.php?delete='.$jeu.'">Supprimer</a>
        </div>
      </div>
    </div>
  </div>
  ';

  ?>

  <div>
    <main>
      <div class="container p-5">

      </div>
    </main>
    <footer><?php include "includes/footer.php" ?></footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
