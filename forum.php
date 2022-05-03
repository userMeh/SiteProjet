<html lang="fr">
  <head>
    <meta charset="utf-8">
    <?php include "includes/head.php" ?>
    <p id="compte" style="display:none;"><?php if (isset($_SESSION['compte'])) { echo $_SESSION['compte']; }?>
    </p>
    <title>Forum de discussion</title>
  </head>
  <body onload="searchPost()">
    <?php include "includes/header.php" ?>

    <main>
      <div class="container p-5">
        <br>
        <h2 class="d-flex justify-content-center">Forum</h2>
        <br>

        <hr size="5">

        <?php include "includes/messageErreur.php" ?>

        <div class="mt-3">
          <input id="searchPost" class="form-control form-control-lg me-3" name="search" type="search" oninput="searchPost()" placeholder="Recherche de poste" aria-label="Search">
          <?php
          if (isset($_SESSION['compte'])) {
            echo '
            <div class="row">
              <button type="button" class="btn btn-primary col mx-3 mt-2" data-bs-toggle="modal" data-bs-target="#poste">
                Créer un poste
              </button>
              <button type="button" class="btn btn-primary col mx-3 mt-2" onclick="searchPost('; echo "'self'"; echo')">
                Mes postes
              </button>
              <button type="button" class="btn btn-primary col mx-3 mt-2" onclick="searchPost('; echo "'tag'"; echo')">
                Mes tags
              </button>
            </div>';
          }
          ?>


          <div class="modal fade popup" id="poste" tabindex="-1" aria-labelledby="posteLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="posteLabel">Création du poste</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="verification_forum.php" method="post" enctype="multipart/form-data">

                    <div class="mb-3">
                      <label for="titre" class="form-label"><h5>Titre du poste</h5></label>
                      <input type="text" name="titre" class="form-control" required>
                    </div>

                    <label for="tag">Tag du poste</label>
                    <select class="form-select mb-3" name="tag">
                      <option value="0">Aucun</option>
                      <?php
                      $query = $bdd -> query('SELECT nom FROM FAVORI WHERE id = (SELECT id FROM BIBLIOTHEQUE WHERE email="'.$_SESSION['compte'].'")');
                      while($req = $query -> fetch(PDO::FETCH_OBJ)){
                        $altnom = str_replace(" ","-","$req->nom");
                        echo '
                        <option value='.$altnom.'>'.$req->nom.'</option>
                        ';
                      }
                      ?>
                    </select>

                    <div class="form-group mb-3">
                      <label for="synopsis">Contenu</label>
                      <textarea name="contenu" class="form-control" rows="10" required></textarea>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                      <button type="submit" class="btn btn-primary">Poster</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

        <hr size="5">

        <div class="my-3">
          <br>
          <h2 class="d-flex justify-content-center">Postes</h2>
          <br>

          <div id="post">

          </div>
        </div>
      </div>
    </main>

    <?php include "includes/footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
