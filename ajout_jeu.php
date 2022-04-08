<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <?php include "includes/head.php" ?>
    <title>Ajout jeux</title>
  </head>
  <body>
    <?php include "includes/header.php" ?>

    <main>
      <div class="container p-5">
        <br>
        <div>
          <form action="verification_jeu.php" method="post" enctype="multipart/form-data">

            <?php
            $query = $bdd -> query('SELECT nom FROM GENRE');
            $fetch = $query -> fetchAll(PDO::FETCH_COLUMN);
            $count = count($fetch);

            echo '<label for="genre" class="form-label"><h4>Genre du jeu</h4></label>
            <div class="row mb-3">';

            for ($i=0; $i < $count; $i++) {
              if ($i%6 == 0 AND $i != 0) {
                echo
                '
                </div>
                <div class="row mb-3">
                <input type="checkbox" class="btn btn-check" id="'.$fetch[$i].'" name="genre[]" value="'.$fetch[$i].'" autocomplete="off">
                <label class="btn btn-outline-primary col me-2 mb-3" for="'.$fetch[$i].'">'.$fetch[$i].'</label>
                ';
              } else {
                echo '<input type="checkbox" class="btn btn-check" id="'.$fetch[$i].'" name="genre[]" value="'.$fetch[$i].'" autocomplete="off">
                <label class="btn btn-outline-primary col me-2 mb-3" for="'.$fetch[$i].'">'.$fetch[$i].'</label>';
              }
            }
            if (($count+1)%6 != 0) {
              echo '</div>';
            }
            ?>

            <div class="my-3">
              <label for="nom" class="form-label"><h4>Nom du jeu</h4></label>
              <input type="text" name="nom" class="form-control" required>
            </div>

            <div class="form-group mb-3">
              <label for="synopsis"><h4>Synopsis</h4></label>
              <textarea name="synopsis" class="form-control" rows="10"></textarea>
            </div>

            <div class="mb-3">
              <label for="date_sortie" class="form-label"><h4>Date de sortie</h4></label>
              <input type="text" name="date_sortie" class="form-control" placeholder="11/04/2021" value="" required>
              <div class="form-text">Format: Jour/Mois/Année , JJ/MM/AA.</div>
            </div>

            <div class="mb-3">
              <label for="developpeur" class="form-label"><h4>Développeur</h4></label>
              <input type="text" name="developpeur" class="form-control" required>
            </div>

            <div class="mb-3">
              <label for="imagePrincipale" class="form-label"><h4>Image principale</h4></label>
              <input class="form-control" name="image" type="file" accept="image/jpeg">
            </div>

            <div class="row">
              <label for="carousel" class="form-label"><h4>image carousel</h4></label>
              <div class="col-4">
                <input class="form-control" name="carousel1" type="file" accept="image/jpeg">
              </div>
              <div class="col-4">
                <input class="form-control" name="carousel2" type="file" accept="image/jpeg">
              </div>
              <div class="col-4 mb-4">
                <input class="form-control" name="carousel3" type="file" accept="image/jpeg">
              </div>
            </div>

            <hr>
            <h2 class="mb-4">Système recommandée</h2>

            <div class="mb-3">
              <label for="systeme" class="form-label"><h4>Système d'exploitation</h4></label>
              <input type="text" name="systeme" class="form-control" required>
            </div>

            <div class="mb-3">
              <label for="processeur" class="form-label"><h4>Processeur</h4></label>
              <input type="text" name="processeur" class="form-control" required>
            </div>

            <div class="mb-3">
              <label for="memoire" class="form-label"><h4>Mémoire</h4></label>
              <input type="text" name="memoire" class="form-control" required>
            </div>

            <div class="mb-3">
              <label for="graphique" class="form-label"><h4>Carte graphique</h4></label>
              <input type="text" name="graphique" class="form-control" required>
            </div>

            <div class="mb-3">
              <label for="directX" class="form-label"><h4>DirectX</h4></label>
              <input type="text" name="directX" class="form-control" required>
            </div>

            <div class="mb-3">
              <label for="redirection" class="form-label"><h4>Redirection</h4></label>
              <input type="text" name="redirection" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary btn-lg">Valider</button>
          </form>
          <?php include "includes/messageErreur.php" ?>
          </div>
      </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
