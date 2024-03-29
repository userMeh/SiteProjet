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
            <input type="text" name="pseudo" class="form-control" id="pseudo" placeholder="Votre pseudo" value="" required>
            <div id="pseudoHelp" class="form-text">Entre 3 et 14 caractères.</div>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Votre email" value="" required>
          </div>

          <div class="mb-3">
            <label for="mdp" class="form-label">Mot de passe</label>
            <input type="password" name="mdp" class="form-control" id="mdp" placeholder="Votre mot de passe" required>
            <div id="passwordHelpBlock" class="form-text">
              Votre mot de passe doit faire entre 8 et 20 caractères de long, contenir des lettres et des chiffres, et pas d'espaces ou de caractères spéciaux.
            </div>

            <div class="mb-3">
              <label for="confirmation" class="form-label">Confirmation du mot de passe</label>
              <input type="password" name="confirmation" class="form-control" id="confirmation" placeholder="" required>
            </div>

            <div class="mb-3">
              <label class="pe-3">Je ne suis pas un robot : </label>
              <input type="checkbox" class="btn btn-check" id="verifCaptcha" name="verifCaptcha" value="verifCaptcha" autocomplete="off">
              <label id="btnCheck" class="btn btn-secondary" for="verifCaptcha" data-bs-toggle="modal" data-bs-target="#checkCaptcha" onclick="random()"><i id="check" class=bi-square></i></label>
            </div>

            <div class="mb-3">
              <label class="pe-3">Conditions générales d'utilisation : </label>
              <input type="checkbox" class="form-check-input" id="cgu" name="cgu" autocomplete="off" data-bs-toggle="modal" data-bs-target="#condition">
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

            <div class="modal fade" id="condition" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Conditions générales d'utilisation</h5>
                  </div>
                  <div class="modal-body text-dark">
                    <p>Les présentes conditions générales régissent l'utilisation de ce site logic-gaming.online<br>
                      Ce site appartient et est géré par Etudiant ESGI<br>
                      En utilisant ce site; vous indiquez que vous avez lu et compris les conditions d'utilisation et que vous acceptez de les respecter en tout temps<br></p>
                      <p>
                        <b>Contribuations d'utilisateur</b>
                        <br>
                        Les utilisateurs peuvent publier les informations suivantes sur notre site :<br>
                        Photos<br>
                        Commentaire du public<br><br>
                        En affichant publiquement sur notre site, vous acceptez de ne pas agir illégalement ou violer les conditions d'utilisation acceptable énumérées dans ce document.<br>
                      </p>
                      <p>
                        <b>Comptes</b>
                        <br>
                        Lorsque vous créez un compte sur notre site, vous acceptez ce qui suit :<br>
                        1. que vous êtes seul responsable de votre compte et de la écurité et la confidentialité de votre compte, y compris les mots de passe ou renseignements de la nature décilate joints à ce compte, et<br>
                        2. que tous les renseingmeents personnels que vous nous fournissez par l'entremise de votre compte sont à jour, exacts et véridiques et que vous mettrez à jour vos renseignements personnels s'ils changent.<br>

                        Nous réservons le droit de susprendre ou de résilier votre compte si vous utilisez notre site illégalement ou si vous violez nos conditions d'utilisation acceptable.<br>
                      </p>
                      <p>
                        <b>Limitation de responsabilité</b>
                        <br>
                        Etudiant ESGI ou l'un de ses employés sera tenu responsable de tout problème découlant de ce site. Néanmoins, Etudiant ESGI et ses employés ne seront pas tenus responsables de tout problème découlant de toute utilisation irrégulière de ce site.<br>
                      </p>
                      <p>
                        <b>Indemnité</b>
                        <br>
                        En tant qu'utilisateur, vous indemnisez par les présentes Etudiant ESGI de toute responsabilité, de tout coût, de toute cause d'action, de tout dommage ou de toute dépense découlant de votre utilisation de ce site ou de votre violation de l'une des dispositions énoncées dans le présent document.<br>
                      </p>
                      <p>
                        <b>Soutenance</b>
                        <br>
                        Lors de la soutenance du projet annuel les coordinateurs chargés de nous notés sont dans l'obligation de nous accorder une "bonne note"<br>
                      </p>
                      <p>
                        <b>Contact</b>
                        <br>
                        Veuillez communiquer avec nous si vous avez des questions ou des préocupations. Nos coordonnées sont les suivantes :<br>
                        logic-gaming@gmail.com<br>
                        242 rue faubourg Saint-Antoine
                      </p>
                    </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">J'accepte</button>
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
