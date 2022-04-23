<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <?php include "includes/head.php" ?>
  <title>Inscription</title>
</head>
<body>
  <?php include "includes/header.php" ?>

  <main>
    <div class="container p-5">
      <br>
      <div>
        <form action="verification_inscription.php" method="post" enctype="multipart/form-data">

          <div class="mb-3">
            <label for="pseudo" class="form-label">Pseudo</label>
            <input type="text" name="pseudo" class="form-control" id="pseudo" placeholder="Votre pseudo" value="<?= isset($_COOKIE['pseudo']) ? $_COOKIE['pseudo'] : '' ?>" required>
            <div id="pseudoHelp" class="form-text">Entre 3 et 14 caractères.</div>
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

            <div class="mb-3">
              <label class="pe-3">Je suis fait de chair et de sang : </label>
              <input type="checkbox" class="btn btn-check" id="verifCaptcha" name="verifCaptcha" value="verifCaptcha" autocomplete="off">
              <label id="btnCheck" class="btn btn-secondary" for="verifCaptcha" data-bs-toggle="modal" data-bs-target="#checkCaptcha" onclick="random()"><i id="check" class=bi-square></i></label>

            </div>

            <div class="modal fade" id="checkCaptcha" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="checkCaptchaLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title popup">Reconstituez l'image</h5>
                  </div>
                  <div class="modal-body">
                    <div class="d-flex justify-content-center">
                      <img id="cap1-1" width="110px" height="110px" class="captcha" src="captcha/debug/1.jpg" onclick="captcha(this.id)" alt="">
                      <img id="cap2-2" width="110px" height="110px" class="captcha" src="captcha/debug/2.jpg" onclick="captcha(this.id)" alt="">
                      <img id="cap3-3" width="110px" height="110px" class="captcha" src="captcha/debug/3.jpg" onclick="captcha(this.id)" alt="">
                    </div>
                    <div class="d-flex justify-content-center">
                      <img id="cap4-4" width="110px" height="110px" class="captcha" src="captcha/debug/4.jpg" onclick="captcha(this.id)" alt="">
                      <img id="cap5-5" width="110px" height="110px" class="captcha" src="captcha/debug/5.jpg" onclick="captcha(this.id)" alt="">
                      <img id="cap6-6" width="110px" height="110px" class="captcha" src="captcha/debug/6.jpg" onclick="captcha(this.id)" alt="">
                    </div>
                    <div class="d-flex justify-content-center">
                      <img id="cap7-7" width="110px" height="110px" class="captcha" src="captcha/debug/7.jpg" onclick="captcha(this.id)" alt="">
                      <img id="cap8-8" width="110px" height="110px" class="captcha" src="captcha/debug/8.jpg" onclick="captcha(this.id)" alt="">
                      <img id="cap9-9" width="110px" height="110px" class="captcha" src="captcha/debug/9.jpg" onclick="captcha(this.id)" alt="">
                    </div>
                  </div>
                  <div id=modalFooter class="modal-footer d-flex justify-content-center">
                    <!-- <button type="button" class="btn btn-success" data-bs-dismiss="modal">Valider</button> -->
                  </div>
                </div>
              </div>
            </div>
          </div>

          <button type="submit" class="btn btn-primary me-2">Valider</button>
          <a type="button" class="btn btn-success" href="connexion.php">Déjà un compte?</a>
        </form>
        <?php include "includes/messageErreur.php" ?>
      </div>
    </div>
  </main>

  <?php include "includes/footer.php" ?>
  <script src="css-js/captcha.js?<?php echo time(); ?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
