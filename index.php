<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <?php include "includes/head.php" ?>
  <title>Accueil</title>
</head>

<body>

  <?php include "includes/header.php" ?>

    <main>
      <div class="container rounded">
        <div id="tendance" class="carousel slide" data-bs-ride="carousel" data-interval="5000">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#tendance" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#tendance" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#tendance" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>

          <?php
          $query = $bdd -> query('SELECT nom FROM NOTE GROUP BY nom ORDER BY AVG(valeur) DESC');
          $note = $query -> fetchAll(PDO::FETCH_COLUMN);
          ?>
          <div class="carousel-inner">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="imageJeux/<?php echo $note[0] ?>0.jpg" class="d-block w-100">
              </div>
              <div class="carousel-item">
                <img src="imageJeux/<?php echo $note[1] ?>0.jpg" class="d-block w-100">
              </div>
              <div class="carousel-item">
                <img src="imageJeux/<?php echo $note[2] ?>0.jpg" class="d-block w-100">
              </div>
            </div>

          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#tendance" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#tendance" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>

        <br>

        <div class="container categorie rounded align-text-bottom">
          <div class="row align-items-center">
            <div class="col-8">
              <h5>Nouveaux jeux</h5>
            </div>
            <div class="col-4 d-grid gap-2 d-md-flex justify-content-md-end">
              <a class="btn btn-outline-dark" type="submit" href="liste_jeux.php?search=!nouveaux">Voir plus</a>
            </div>
          </div>
        </div>

        <br>

        <div class="container">

          <div class="row">
            <?php
            $query = $bdd -> query('SELECT nom FROM JEUX ORDER BY date_sortie DESC');
            $count = 0;
            while($req = $query -> fetch(PDO::FETCH_OBJ)){
              if ($count < 4) {
                echo '
                <div class="col-md col-sm-6 mb-3">
                  <div class="card">
                    <a href="page_jeu.php?jeu='.$req->nom.'"><img class="rounded img-fluid" src="imageJeux/'.$req->nom.'0.jpg"></a>
                  </div>
                </div>
                ';
                $count += 1;
              }
            }
            while($count < 4){
              echo '
              <div class="col-md col-sm-6 mb-3">
                <div class="card">
                  <img class="rounded img-fluid" src="imageJeux/placeholder.jpg">
                </div>
              </div>
              ';
              $count += 1;
            }
            ?>
          </div>
        </div>

        <br>

        <div class="container categorie rounded">
          <div class="row align-items-center">
            <div class="col-8">
              <h5>Jeux populaires</h5>
            </div>
            <div class="col-4 d-grid gap-2 d-md-flex justify-content-md-end">
              <a class="btn btn-outline-dark" type="submit" href="liste_jeux.php?search=!populaires">Voir plus</a>
            </div>
          </div>
        </div>

        <br>

        <div class="container">

          <div class="row">
            <?php
            $query = $bdd -> query('SELECT nom FROM ((SELECT COUNT(id) AS count,nom FROM FAVORI WHERE nom IN (SELECT nom FROM JEUX) GROUP BY nom ORDER BY count DESC)AS temp)');
            $count = 0;
            while($req = $query -> fetch(PDO::FETCH_OBJ)){
              if ($count < 4) {
                echo '
                <div class="col-md col-sm-6 mb-3">
                  <div class="card">
                    <a href="'.$req->nom.'"><img class="rounded img-fluid" src="imageJeux/'.$req->nom.'0.jpg"></a>
                  </div>
                </div>
                ';
                $count += 1;
              }
            }
            while($count < 4){
              echo '
              <div class="col-md col-sm-6 mb-3">
                <div class="card">
                  <img class="rounded img-fluid" src="imageJeux/placeholder.jpg">
                </div>
              </div>
              ';
              $count += 1;
            }
            ?>
          </div>
        </div>

        <br>

        <div class="container row">

          <a href="liste_jeux.php" id="seeAll" class="btn btn-outline-light btn-lg">Voir tous les jeux</a>

        </div>
      </div>
    </div>
    </main>

    <footer><?php include "includes/footer.php" ?></footer>

  <!--script js-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
