<html lang="fr">
  <head>
    <meta charset="utf-8">
    <?php include "includes/head.php" ?>
    <title>Liste Tournoi</title>
  </head>
  <body>
    <?php include "includes/header.php" ?>

    <main>
      <div class="container p-5">
        <br>
        <h2 class="d-flex justify-content-center">Liste des Tournoi</h2>
        <br>

        <hr size="5">

        <?php include "includes/messageErreur.php" ?>

        <?php

        if (isset($_GET['search']) AND !empty($_GET['search'])) {
          $search = htmlspecialchars($_GET['search']);
          $query = $bdd -> query('SELECT nom_du_jeu FROM TOURNI WHERE nom_du_jeu LIKE "%'.$search.'%"');
        } else {
          $query = $bdd -> query('SELECT nom_du_jeu FROM TOURNOI');
        }

        $tournoi = $query -> fetchAll(PDO::FETCH_COLUMN);
        $count_tournoi = count($tournoi);

        $query = $bdd -> query('SELECT recompense FROM TOURNOI');
        $recompense = $query -> fetchAll(PDO::FETCH_COLUMN);

        $query = $bdd -> query('SELECT date_de_depart FROM TOURNOI');
        $date = $query -> fetchAll(PDO::FETCH_COLUMN);

        $query = $bdd -> query('SELECT duree FROM TOURNOI');
        $date_fin = $query -> fetchAll(PDO::FETCH_COLUMN);

        $query = $bdd -> query('SELECT nombre_participant FROM TOURNOI');
        $participant_max = $query -> fetchAll(PDO::FETCH_COLUMN);

        $query = $bdd -> query('SELECT participant_actuel FROM TOURNOI');
        $participant = $query -> fetchAll(PDO::FETCH_COLUMN);

        if ($count_tournoi == 0) {
          echo '<div class="my-5">
            <h3 class="py-5"><p class="text-secondary text-center">Aucun jeu trouvé</p></h3>
          </div>';
        } else {
          for ($i=0; $i < $count_tournoi; $i++) {

            $query = $bdd -> prepare('SELECT SUBSTRING(description,1,450) FROM TOURNOI WHERE nom_du_jeu=:nom_du_jeu');
            $req = $query -> execute([
              'nom_du_jeu' => $tournoi[$i]
            ]);
            $regle = $query -> fetchAll(PDO::FETCH_COLUMN);

            echo'
            <div class="card text-white bg-dark mb-3">

            <div class="row">
            <div class="col-4">
            <a href="page_tournoi.php?jeu='.$tournoi[$i].'"><img src="imagetournoi/'.$tournoi[$i].'0.jpg" class="card-img-top" alt="..."></a>
            </div>
            <div class="card-body col-8 row">
            <div class="col-11 card-title">
            <h4><a href="page_tournoi.php?jeu='.$tournoi[$i].'">'.$tournoi[$i].'</a></h4>
            </div>';



            $altertournoi = str_replace(" ","-","$tournoi[$i]");   //On remplace les espaces par des . pcq sinon ca passe pas en id pour les modals/popup

            if ($admin == 1) {
              echo'
              <div class="col-1 d-flex justify-content-end pe-3">
              <button type="button" class="btn-close btn-danger btn-sm" aria-label="Close" data-bs-toggle="modal" data-bs-target="#suppression'.$altertournoi.'"></button>
              </div>';
            }

            echo'
            <div class="modal fade popup" id="suppression'.$altertournoi.'" tabindex="-1" aria-labelledby="suppressionLabel" aria-hidden="true">
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
            <a type="button" class="btn btn-danger" href="verification_tournoi.php?delete='.$altertournoi.'">Supprimer</a>
            </div>
            </div>
            </div>
            </div>

            <p>Les récompenses : '.$recompense[$i].'   |   début le '.$date[$i].'  | fin le '.$date_fin[$i].' |  <img src="images/views-light.png" style="width: 20px;"> '.$participant[$i].'/'.$participant_max[$i].'</p>
            <p>'.$regle[0].'...</p>

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
