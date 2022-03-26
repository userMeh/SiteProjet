<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <?php include "includes/bootstrap.php" ?>
    <title>Inscription</title>
  </head>
  <body>
    <?php include "includes/header.php" ?>

    <main class="container p-5">
      <br>
      <div>
        <form action="verification_inscription.php" method="post" enctype="multipart/form-data">

          <div class="mb-3">
            <label for="pseudo" class="form-label">Pseudo</label>
            <input type="text" name="pseudo" class="form-control" id="email" placeholder="Votre pseudo" value="<?= isset($_COOKIE['pseudo']) ? $_COOKIE['pseudo'] : '' ?>" required>
            <div id="emailHelp" class="form-text">Entre 3 et 14 caractères.</div>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Votre email" value="<?= isset($_COOKIE['email']) ? $_COOKIE['email'] : '' ?>" required>
          </div>

          <div class="mb-3">
            <label for="mdp" class="form-label">Mot de passe</label>
            <input type="password" name="mdp" class="form-control" id="mdp" placeholder="Votre mot de passe">
            <div id="passwordHelpBlock" class="form-text">
              Votre mot de passe doit faire entre 8 et 20 caractères de long, contenir des lettres et des chiffres, et pas d'espaces, de caractères spéciaux, ou d'emoji.
          </div>

          <div class="mb-3">
            <label for="confirmation" class="form-label">Confirmation du mot de passe</label>
            <input type="password" name="confirmation" class="form-control" id="confirmation" placeholder="">
          </div>

              <button type="submit" class="btn btn-primary me-2">Valider</button>
              <a type="button" class="btn btn-success" href="connexion.php">Déjà un compte?</a>
        </form>
        <?php include "includes/messageErreur.php" ?>
      </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
