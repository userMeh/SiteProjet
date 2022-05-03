<html lang="fr">
  <head>
    <meta charset="utf-8">
    <?php include "includes/head.php" ?>
    <?php
    $id = $_GET['id'];
    $query = $bdd -> query('SELECT titre FROM POSTE WHERE id ="'.$id.'"');
    $titre = $query -> fetch();

    $query = $bdd -> query('SELECT email FROM POSTE WHERE id='.$id.'');
    $email = $query -> fetch();

    $query = $bdd -> query('SELECT pseudo FROM UTILISATEURS WHERE email=(SELECT email FROM POSTE WHERE id ='.$id.')');
    $auteur = $query -> fetch();

    $query = $bdd -> query('SELECT contenu FROM POSTE WHERE id ="'.$id.'"');
    $contenu = $query -> fetch();
    ?>
    <p id="idPoste" style="display:none;"><?php echo $id ?></p>
    <p id="idCompte" style="display:none;"><?php echo $_SESSION['compte'] ?></p>

    <title><?php echo $titre['titre'] ?></title>
  </head>
  <body onload="verifLike()">
    <?php include "includes/header.php" ?>

    <main>
      <div class="container p-5">
        <br>
        <h1 class="d-flex justify-content-center text-uppercase"><?php echo $titre['titre']; ?></h1>
        <br>

        <hr size="5">

        <div class="my-5 d-flex justify-content-center fs-3">
          <p>
            <?php echo $contenu['contenu']; ?>
          </p>
        </div>

        <div class="d-flex justify-content-end me-5">
          <a href="profil.php?visit=<?php $email['email'] ?>" class="text-light"><p class="fst-italic fs-4"><?php echo $auteur['pseudo'] ?></p></a>
        </div>

        <?php include "includes/count_like_dislike.php" ?>

        <div id="like and dislike" class="d-flex justify-content-end">
          <i id="like" class="bi bi-hand-thumbs-up mx-3" onclick="like()" style="font-size:2rem;"><?php echo $countLike ?></i>
          <i id="dislike" class="bi bi-hand-thumbs-down mx-3" onclick="dislike()" style="font-size:2rem;"><?php echo $countDislike ?></i>
        </div>

        <hr size="5">

        <h2 class="d-flex justify-content-center">Commentaires</h2>

          <?php
          if(isset($_SESSION['compte'])){
            echo '
            <form action="verification_commentaire_poste.php" method="post">
              <div class="my-3">
                <label for="commentaire" class="form-label">Mettez un commentaire</label>
                <textarea class="form-control" id="commentaire" name="commentaire" rows="3"></textarea>
              </div>
              <div style="display:none"><input value="'.$id.'" name="idPoste"></input></div>
              <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-lg">Envoyer</button>
              </div>
            </form>
            ';
          }
          ?>


        <hr size="5">

        <div id="liste_commentaire">

        </div>

        <?php

        $query = $bdd -> query('SELECT id FROM COMMENTAIRE WHERE id_poste="'.$id.'"');
        $idCommentaire = $query -> fetchAll(PDO::FETCH_COLUMN);
        $countCommentaire = count($idCommentaire);

        $query = $bdd -> query('SELECT email FROM COMMENTAIRE WHERE id_poste="'.$id.'"');
        $email = $query -> fetchAll(PDO::FETCH_COLUMN);

        $query = $bdd -> query('SELECT pseudo FROM UTILISATEURS WHERE email=(SELECT email FROM COMMENTAIRE WHERE id="'.$id.'")');
        $auteur = $query -> fetchAll(PDO::FETCH_COLUMN);

        $query = $bdd -> query('SELECT date_commentaire FROM COMMENTAIRE WHERE id_poste="'.$id.'"');
        $date_commentaire = $query -> fetchAll(PDO::FETCH_COLUMN);

        $query = $bdd -> query('SELECT heure_commentaire FROM COMMENTAIRE WHERE id_poste="'.$id.'"');
        $heure = $query -> fetchAll(PDO::FETCH_COLUMN);

        for ($i=0; $i < $countCommentaire; $i++) {
          $query = $bdd->query('SELECT contenu FROM COMMENTAIRE WHERE id="'.$idCommentaire[$i].'"');
          $commentaire = $query->fetch();
          $query = $bdd->query('SELECT pseudo FROM UTILISATEURS WHERE email=(SELECT email FROM COMMENTAIRE WHERE id="'.$idCommentaire[$i].'")');
          $auteur = $query->fetch();

          $array = explode('-', $date_commentaire[$i]);
          $annee = current($array);
          $mois = next($array);
          $jour = next($array);
          $date = $jour .'/'. $mois .'/'. $annee;

          echo '
          <div class="d-flex justify-content-center mb-5">
            <div class="card w-75">
              <div class="card-body text-light bg-dark p-3">
              <div class="row">
                <h5 class="card-title p-3 col-11"><a href="profil.php?visit='.$email[$i].'" class="text-light"><b class="fs-4 text-uppercase">'.$auteur['pseudo'].'</b></a></h5>';
                if ($admin == 1) {
                  echo '
                    <div class="col-1 d-flex justify-content-end">
                      <button type="button" class="btn-close btn-danger btn-sm " aria-label="Close" data-bs-toggle="modal" data-bs-target="#suppression'.$idCommentaire[$i].'"></button>
                    </div>';
                }
                echo '
                <p class="card-text p-3">'.$commentaire['contenu'].'</p>
                <p class="card-text col-9"><small class="text-muted">Posté le '.$date.' à '.$heure[$i].'</small></p>
              </div>
            </div>
          </div>';

          if ($admin == 1) {
            echo '
            <div class="modal fade popup" id="suppression'.$idCommentaire[$i].'" tabindex="-1" aria-labelledby="suppressionLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="suppressionLabel">Suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    Etes-vous sûr de supprimer ce commentaire de la base de donnée? Cet action est irréversible !
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <a type="button" class="btn btn-danger" href="verification_commentaire_poste.php?delete='.$idCommentaire[$i].'">Supprimer</a>
                  </div>
                </div>
              </div>
            </div>';
        }
      }

        ?>
      </div>
    </main>

    <?php include "includes/footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
