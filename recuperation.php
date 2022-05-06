<!DOCTYPE html>
<html style="overflow-x:hidden">
  <head>
    <meta charset="utf-8">
    <?php include "includes/head.php" ?>
    <title>Récupération mot de passe</title>
  </head>
  <body>
    <?php include "includes/header.php" ?>

    <main>
      <div class="container p-5">
        <div>
          <form action="verification_recuperation.php" method="post" enctype="multipart/form-data">

            <?php

            if (!isset($_GET['email'])) {
              echo
              '<div class="my-5">
                <label for="mdp" class="form-label">Votre email</label>
                <input type="text" name="email" class="form-control" id="email" placeholder="email" required>
              </div>';
            } else {
              echo
              '<div class="my-5">
                <label for="mdp" class="form-label">Votre nouveaux mot de passe</label>
                <input type="password" name="mdp" class="form-control" id="mdp" placeholder="mot de passe" required>
              </div>';
              echo
              '<div class="my-5">
                <label for="conf_mdp" class="form-label">Confirmation mot de passe</label>
                <input type="password" name="conf_mdp" class="form-control" id="conf_mdp" placeholder="confirmation mot de passe" required>
              </div>';
              echo
              '<input type="text" name="email" value="'.$_GET['email'].'" style="display:none;">';
            }


            ?>


            <button type="submit" class="btn btn-primary me-2 mb-5">Valider</button>
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
