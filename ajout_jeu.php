<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <?php include "includes/bootstrap.php" ?>
    <title>Ajout jeux</title>
  </head>
  <body>
    <?php include "includes/header.php" ?>

    <main class="container p-5">
      <br>
      <div>
        <form action="verification_jeu.php" method="post" enctype="multipart/form-data">

          <div class="mb-3">
            <label for="nom" class="form-label">Nom du jeu</label>
            <input type="text" name="nom" class="form-control" required>
          </div>

          <div class="form-group mb-3">
            <label for="synopsis">Synopsis</label>
            <textarea name="synopsis" class="form-control" rows="10"></textarea>
          </div>

          <div class="mb-3">
            <label for="date_sortie" class="form-label">Date de sortie</label>
            <input type="text" name="date_sortie" class="form-control" placeholder="11/04/2021" value="" required>
            <div class="form-text">Format: Jour/Mois/Année , JJ/MM/AA.</div>
          </div>

          <div class="mb-3">
            <label for="developpeur" class="form-label">Développeur</label>
            <input type="text" name="developpeur" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="imagePrincipale" class="form-label">Image principale</label>
            <input class="form-control" name="image" type="file" accept="image/jpeg">
          </div>

          <div class="row">
            <label for="carousel" class="form-label">image carousel</label>
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
            <label for="systeme" class="form-label">Système d'exploitation</label>
            <input type="text" name="systeme" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="processeur" class="form-label">Processeur</label>
            <input type="text" name="processeur" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="memoire" class="form-label">Mémoire</label>
            <input type="text" name="memoire" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="graphique" class="form-label">Carte graphique</label>
            <input type="text" name="graphique" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="directX" class="form-label">DirectX</label>
            <input type="text" name="directX" class="form-control" required>
          </div>

          <button type="submit" class="btn btn-primary btn-lg">Valider</button>
        </form>

        <?php include "includes/messageErreur.php" ?>

      </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
