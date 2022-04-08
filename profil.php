<!DOCTYPE html>
<html>
  <head>
    <?php
    include "includes/head.php"

    if (!isset($_SESSION['compte'])){
      header("location:index.php");
    }
    ?>
    <meta charset="utf-8">

    <title>Profil</title>
  </head>
  <body>
    <?php include "includes/header.php" ?>
    <?php
    $query = $bdd -> query('SELECT pseudo FROM UTILISATEURS WHERE email="'.$_SESSION['compte'].'"');
    $pseudo = $query -> fetchAll(PDO::FETCH_COLUMN);
    ?>
    <main>
      <div class="container p-5">
        <div class="row">
          <div class="col-1"></div>
          <div class="col-4">
            <img src="images/profile.png" class="border border-secondary border border-4 img-fluid">
          </div>
          <div class="col-6">
            <div class="row rounded-pill border border-4 border-secondary">
              <h1 class="d-flex justify-content-center fw-bolder"><?php echo $pseudo[0] ?></h1>
            </div>
            <div class="row my-3"><h4 class="fw-bold">Description</h4></div>
            <div class="row mt-3">
              <textarea class="form-control bg-dark text-light border border-4 border-secondary" id="description" rows="10"></textarea>
            </div>
          </div>
        </div>
        <br>
        <hr size=5px>
        <br>

        <div class="row">
          <div class="col">
            <img src="imageJeux/Elden Ring0.jpg" class="img-thumbnail">
          </div>
        </div>

      </div>
    </main>
    <a href="deconnexion.php">Deconnexion</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
