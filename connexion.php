<!DOCTYPE html>
<html style="overflow-y:hidden">
  <head>
    <meta charset="utf-8">
    <?php include "includes/head.php" ?>
    <title>Inscription</title>
  </head>
  <body>
    <?php include "includes/header.php" ?>

    <main>
      <div class="container p-5">
        <div>
          <form action="verification_connexion.php" method="post" enctype="multipart/form-data">

            <div class="mb-3">
              <label for="pseudo" class="form-label">Pseudo</label>
              <input type="text" name="pseudo" class="form-control" id="pseudo" placeholder="Votre pseudo" value="<?= isset($_COOKIE['pseudo']) ? $_COOKIE['pseudo'] : '' ?>" required>
            </div>

            <div class="mb-3">
              <label for="mdp" class="form-label">Mot de passe</label>
              <input type="password" name="mdp" class="form-control" id="mdp" placeholder="Votre mot de passe">
            </div>

            <button type="submit" class="btn btn-primary me-2">Valider</button>
            <a type="button" class="btn btn-success" href="inscription.php">Pas de compte?</a>

          </form>
          <?php include "includes/messageErreur.php" ?>
        </div>
      </div>
      <br>
    </main>
    <footer class="pb-3"><?php include "includes/footer.php" ?></footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
