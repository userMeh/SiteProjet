<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <?php include "includes/bootstrap.php" ?>
  <title>Accueil</title>
</head>
<body>
  <!-- Barre de navigation -->
  <?php include "includes/header.php" ?>
    <!-- Fin Barre de navigation -->

    <!-- Jeux defilant -->
    <div class="container rounded">
      <div id="tendance" class="carousel slide" data-bs-ride="carousel" data-interval="5000">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#tendance" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#tendance" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#tendance" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="images/Total War Warhammer 3.jpg" class="d-block w-100">
          </div>
          <div class="carousel-item">
            <img src="images/League-of-Legends.jpg" class="d-block w-100">
          </div>
          <div class="carousel-item">
            <img src="images/Monark.png" class="d-block w-100">
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
      <!-- Fin jeux defilant -->

      <!-- Les jeux -->

      <br>

      <div class="container categorie rounded align-text-bottom">
        <div class="row align-items-center">
          <div class="col-8">
            <h5>Nouveaux jeux</h5>         <!-- nouveaux jeux -->
          </div>
          <div class="col-4 d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-outline-dark" type="submit">Voir plus</a>
          </div>
        </div>
      </div>

      <br>

      <div class="container">

        <div class="row">

          <div class="col-md col-sm-6 mb-3">
            <div class="card">
              <img class="rounded img-fluid" src="images/Total War Warhammer 3.jpg">
            </div>
          </div>

          <div class="col-md col-sm-6 mb-3">
            <div class="card">
              <a href="page_jeu.php?jeu=Elden Ring"><img class="rounded img-fluid" src="imageJeux/Elden Ring0.jpg"></a>
            </div>
          </div>

          <div class="col-md col-sm-6 mb-3">
            <div class="card">
              <img class="rounded img-fluid" src="images/League-of-Legends.jpg">
            </div>
          </div>

          <div class="col-md col-sm-6 mb-3">
            <div class="card">
              <img class="rounded img-fluid" src="images/Lost Ark.jpg">
            </div>
          </div>

        </div>
      </div>

      <br>

      <div class="container categorie rounded">
        <div class="row align-items-center">
          <div class="col-8">
            <h5>Jeux populaires</h5>         <!-- jeux populaires-->
          </div>
          <div class="col-4 d-grid gap-2 d-md-flex justify-content-md-end">
            <button class="btn btn-outline-dark" type="submit">Voir plus</button>
          </div>
        </div>
      </div>

      <br>

      <div class="container">

        <div class="row">

          <div class="col-md col-sm-6 mb-3">
            <div class="card">
              <img class="rounded img-fluid" src="images/Total War Warhammer 3.jpg">
            </div>
          </div>

          <div class="col-md col-sm-6 mb-3">
            <div class="card">
              <img class="rounded img-fluid" src="images/Monark.png">
            </div>
          </div>

          <div class="col-md col-sm-6 mb-3">
            <div class="card">
              <img class="rounded img-fluid" src="images/League-of-Legends.jpg">
            </div>
          </div>

          <div class="col-md col-sm-6 mb-3">
            <div class="card">
              <img class="rounded img-fluid" src="images/Lost Ark.jpg">
            </div>
          </div>

        </div>
      </div>

      <br>

      <div class="container categorie rounded">
        <div class="row align-items-center">
          <div class="col-8">
            <h5>Récemment visité</h5>         <!-- jeux recemment visite-->
          </div>
          <div class="col-4 d-grid gap-2 d-md-flex justify-content-md-end">
            <button class="btn btn-outline-dark" type="submit">Voir plus</button>
          </div>
        </div>
      </div>

      <br>

      <div class="container">

        <div class="row">

          <div class="col-md col-sm-6 mb-3">
            <div class="card">
              <img class="rounded img-fluid" src="images/Total War Warhammer 3.jpg">
            </div>
          </div>

          <div class="col-md col-sm-6 mb-3">
            <div class="card">
              <img class="rounded img-fluid" src="images/Monark.png">
            </div>
          </div>

          <div class="col-md col-sm-6 mb-3">
            <div class="card">
              <img class="rounded img-fluid" src="images/League-of-Legends.jpg">
            </div>
          </div>

          <div class="col-md col-sm-6 mb-3">
            <div class="card">
              <img class="rounded img-fluid" src="images/Lost Ark.jpg">
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>



  <!--script js-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
