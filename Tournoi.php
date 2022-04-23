<html>
  <head>
    <meta charset="utf-8">
    <?php include "includes/bootstrap.php" ?>
    <title>Liste des tournois</title>
  </head>
  <body>
    <?php include "includes/header.php" ?>

    <main class="container p-5">
      <br>
      <h2 class="d-flex justify-content-center">Liste des tournois</h2>
      <br>

      <?php
      $query = $bdd -> query('SELECT nom_du_jeux,id FROM TOURNOI');
      $nom_du_jeux = $query -> fetchAll(PDO::FETCH_COLUMN);
      $tournoi = count($jeu);

      $query = $bdd -> query('SELECT duree FROM TOURNOI');
      $fin = $query -> fetchAll(PDO::FETCH_COLUMN);

      $query = $bdd -> query('SELECT date_de_depart FROM TOURNOI');
      $date_de_depart = $query -> fetchAll(PDO::FETCH_COLUMN);

      $query = $bdd -> query('SELECT nombre_participant FROM TOURNOI');
      $participant = $query -> fetchAll(PDO::FETCH_COLUMN);

      for ($i=0; $i < $tournoi; $i++) {

        $query = $bdd -> prepare('SELECT SUBSTRING(description,1,450) FROM TOURNOI WHERE nom=:nom');
        $req = $query -> execute([
          'nom' => $tournoi[$i]
        ]);
        $snipet = $query -> fetchAll(PDO::FETCH_COLUMN);

        echo'
        <div class="card text-white bg-dark mb-3">
          <div class="row">
            <div class="col-4">
              <a href="page_jeu.php?jeu='.$jeu[$i].'"><img src="imageJeux/'.$jeu[$i].'0.jpg" class="card-img-top" alt="..."></a>
            </div>
            <div class="card-body col-8 row">
            <div class="col-8 card-title">
              <h4><a href="page_jeu.php?jeu='.$jeu[$i].'">'.$jeu[$i].'</a></h4>
            </div>
            <div class="col-4 d-flex justify-content-end pe-3">
              <button type="button" class="btn-close btn-danger btn-sm" aria-label="Close"></button>
            </div>
              <p>Developpé par '.$developpeur[$i].'   |   Publié le '.$date[$i].'   |   <img src="images/views-light.png" style="width: 20px;"> '.$vues[$i].' vues</p>
              <p>'.$snipet[0].'...</p>

            </div>
          </div>
        </div>';
      }
      ?>



    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
