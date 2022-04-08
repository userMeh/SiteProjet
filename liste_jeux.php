<html lang="fr">
  <head>
    <meta charset="utf-8">
    <?php include "includes/head.php" ?>
    <title>Liste des jeux</title>
  </head>
  <body>
    <?php include "includes/header.php" ?>

    <main>
      <div class="container p-5">
        <br>
        <h2 class="d-flex justify-content-center">Liste des jeux</h2>
        <br>

        <?php include "includes/messageErreur.php" ?>

        <?php

        $query = $bdd -> query('SELECT nom FROM JEUX');
        $jeu = $query -> fetchAll(PDO::FETCH_COLUMN);
        $count_jeu = count($jeu);

        $query = $bdd -> query('SELECT developpeur FROM JEUX');
        $developpeur = $query -> fetchAll(PDO::FETCH_COLUMN);

        $query = $bdd -> query('SELECT date_sortie FROM JEUX');
        $date = $query -> fetchAll(PDO::FETCH_COLUMN);

        $query = $bdd -> query('SELECT nb_vues FROM JEUX');
        $vues = $query -> fetchAll(PDO::FETCH_COLUMN);

        for ($i=0; $i < $count_jeu; $i++) {

          $liste = 1;
          include "includes/date.php";

          $query = $bdd -> prepare('SELECT SUBSTRING(synopsis,1,450) FROM JEUX WHERE nom=:nom');
          $req = $query -> execute([
            'nom' => $jeu[$i]
          ]);
          $extrait = $query -> fetchAll(PDO::FETCH_COLUMN);

          echo'
          <div class="card text-white bg-dark mb-3">

            <div class="row">
              <div class="col-4">
                <a href="page_jeu.php?jeu='.$jeu[$i].'"><img src="imageJeux/'.$jeu[$i].'0.jpg" class="card-img-top" alt="..."></a>
                </div>
              <div class="card-body col-8 row">
              <div class="col-8 card-title">
                <h4><a href="page_jeu.php?jeu='.$jeu[$i].'">'.$jeu[$i].'</a></h4>
              </div>';

              $altjeu = str_replace(" ","-","$jeu[$i]");   //On remplace les espaces par des . pcq sinon ca passe pas en id pour les modals/popup

              echo'
              <div class="col-4 d-flex justify-content-end pe-3">
              <button type="button" class="btn-close btn-danger btn-sm" aria-label="Close" data-bs-toggle="modal" data-bs-target="#suppression'.$altjeu.'"></button>
              </div>

              <div class="modal fade popup" id="suppression'.$altjeu.'" tabindex="-1" aria-labelledby="suppressionLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="suppressionLabel">Suppression</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      Etes-vous sûr de supprimer ce jeu de la base de donnée? Cet action est irréversible !
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                      <a type="button" class="btn btn-danger" href="verification_jeu.php?delete='.$altjeu.'">Supprimer</a>
                    </div>
                  </div>
                </div>
              </div>

                <p>Developpé par '.$developpeur[$i].'   |   Publié le '.$jour.' '.$mois.' '.$annee.'   |   <img src="images/views-light.png" style="width: 20px;"> '.$vues[$i].' vues</p>
                <p>'.$extrait[0].'...</p>

              </div>
            </div>
          </div>';
        }
        ?>
      </div>
    </main>

    <?php include "includes/footer.php" ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
