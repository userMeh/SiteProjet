<html lang="fr">
  <head>
    <meta charset="utf-8">
    <?php include "includes/head.php" ?>
    <title>Forum de discussion</title>
  </head>
  <body>
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
          <button type="button" class="btn btn-primary col-4 col-md-3 mt-3 mx-3" data-bs-toggle="modal" data-bs-target="#poste">
            Créer un poste
          </button>
          <button type="button" class="btn btn-primary col-4 col-md-3 mt-3 mx-3">
            Mes postes
          </button>

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

          <?php
          if (!isset($_SESSION['compte'])) {
            $placeholder = "";
          } else {
            $placeholder = $_SESSION['compte'];
          }
          $query = $bdd -> query('SELECT id FROM POSTE WHERE tag IN (SELECT nom FROM FAVORI WHERE id=(SELECT id FROM BIBLIOTHEQUE WHERE email="'.$placeholder.'"))OR tag="0"');
          $id = $query -> fetchAll(PDO::FETCH_COLUMN);
          $count = count($id);

          $query = $bdd -> query('SELECT pseudo FROM UTILISATEURS,(SELECT email FROM POSTE WHERE tag IN (SELECT nom FROM FAVORI WHERE id=(SELECT id FROM BIBLIOTHEQUE WHERE email="'.$placeholder.'"))OR tag="0") AS meh WHERE UTILISATEURS.email=meh.email');
          $auteur = $query -> fetchAll(PDO::FETCH_COLUMN);

          $query = $bdd -> query('SELECT titre FROM POSTE WHERE tag IN (SELECT nom FROM FAVORI WHERE id=(SELECT id FROM BIBLIOTHEQUE WHERE email="'.$placeholder.'"))OR tag="0"');
          $titre = $query -> fetchAll(PDO::FETCH_COLUMN);

          $query = $bdd -> query('SELECT SUBSTRING(contenu,1,450) FROM POSTE WHERE tag IN (SELECT nom FROM FAVORI WHERE id=(SELECT id FROM BIBLIOTHEQUE WHERE email="'.$placeholder.'"))OR tag="0"');
          $contenu = $query -> fetchAll(PDO::FETCH_COLUMN);

          $query = $bdd -> query('SELECT date_poste FROM POSTE WHERE tag IN (SELECT nom FROM FAVORI WHERE id=(SELECT id FROM BIBLIOTHEQUE WHERE email="'.$placeholder.'"))OR tag="0"');
          $date = $query -> fetchAll(PDO::FETCH_COLUMN);

          $query = $bdd -> query('SELECT heure_poste FROM POSTE WHERE tag IN (SELECT nom FROM FAVORI WHERE id=(SELECT id FROM BIBLIOTHEQUE WHERE email="'.$placeholder.'"))OR tag="0"');
          $heure_poste = $query -> fetchAll(PDO::FETCH_COLUMN);

          $query = $bdd -> query('SELECT tag FROM POSTE WHERE tag IN (SELECT nom FROM FAVORI WHERE id=(SELECT id FROM BIBLIOTHEQUE WHERE email="'.$placeholder.'"))OR tag="0"');
          $tag = $query -> fetchAll(PDO::FETCH_COLUMN);

          for ($i=0; $i < $count; $i++) {
            $array = explode('-', $date[$i]);
            $annee = current($array);
            $mois = next($array);
            $jour = next($array);
            $date_poste = $jour .'/'. $mois .'/'. $annee;

            $countLike = 0;
            $countDislike = 0;

            if (file_exists("logs/like/$id[$i].txt")) {
              $file = file("logs/like/$id[$i].txt");
              $file = array_reverse($file);

              $query = $bdd->query('SELECT email FROM UTILISATEURS');
              $compte = $query->fetchAll(PDO::FETCH_COLUMN);
              $count_compte = count($compte);

              for ($j=0; $j < $count_compte; $j++) {
                foreach($file as $f){
                  if (preg_match("#$compte[$j]#", $f)==1){

                    if (preg_match("#retiré#", $f)){

                    } else if (preg_match("#dislike#", $f)) {
                      $countDislike += 1;
                    } else if (preg_match("#like#", $f)){
                      $countLike += 1;
                    }
                    break;
                  }
                }
              }
            }
            $query = $bdd->query('SELECT COUNT(id) AS compteur FROM COMMENTAIRE WHERE id_poste="'.$id[$i].'"');
            $commentaire = $query->fetch();

            echo'
            <div class="d-flex justify-content-center mb-5">
              <div class="card w-75">
              <a href="page_poste.php?id='.$id[$i].'">
                <div class="card-body text-white bg-dark p-3">
                  <h5 class="card-title p-3"><b class="fs-2 text-uppercase">'.$titre[$i].'</b>';
                  if ($tag[$i] != '0') {
                    echo '<button class="btn btn-sm btn-secondary ms-3 mb-2">'.$tag[$i].'</button>';
                  }
                  echo'</h5>
                  <hr size="3">
                  <p class="card-text p-3">'.$contenu[$i].'</p>
                  <div class="row">
                  <p class="card-text col-9"><small class="text-muted">Posté le '.$date_poste.' à '.$heure_poste[$i].' par '.$auteur[$i].'</small></p>
                  <p class="col-3"><i class="bi bi-hand-thumbs-up mx-2" style="font-size:1.5rem;">'.$countLike.'</i><i class="bi bi-chat-left-text mx-2" style="font-size:1.5rem;">'.$commentaire['compteur'].'</i></p>
                  </div>
                </div>
              </div>
              </a>
            </div>
            ';
          }
          ?>
        </div>
      </div>
    </main>

    <?php include "includes/footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
