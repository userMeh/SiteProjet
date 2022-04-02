<html>
  <head>
    <meta charset="utf-8">
    <?php include "includes/bootstrap.php" ?>
    <title>Ajout genre</title>
  </head>
  <body>
    <?php include "includes/header.php" ?>

    <main>
      <div class="container p-5">
        <br>
        <div>
          <form action="verification_genre.php" method="post" enctype="multipart/form-data">

            <div class="mb-3">
              <label for="nom" class="form-label">Nom du genre</label>
              <input type="text" name="nom" class="form-control" required>
            </div>

            <div class="form-group mb-3">
              <label for="synopsis">Description du genre</label>
              <textarea name="description" class="form-control" rows="10"></textarea>
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
