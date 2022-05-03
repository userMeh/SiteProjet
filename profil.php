<!DOCTYPE html>
<html>
  <head>
    <?php
    include "includes/head.php";

    if (!isset($_SESSION['compte']) && !isset($_GET['visit'])){
      header("location:index.php");
    } else if(isset($_GET['visit'])) {
      $compte = $_GET['visit'];
    } else {
      $compte = $_SESSION['compte'];
    }
    ?>
    <meta charset="utf-8">

    <title>Profil</title>
  </head>
  <body>
    <?php include "includes/header.php" ?>
    <?php
    $query = $bdd -> query('SELECT pseudo FROM UTILISATEURS WHERE email="'.$compte.'"');
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
            <div class="row my-3"><h4 class="fw-bold">Status</h4></div>
            <div class="row mt-3">
              <?php
              $query = $bdd -> query('SELECT status FROM UTILISATEURS WHERE email="'.$compte.'"');
              $status = $query -> fetch();
              ?>
              <form action="verification_modification.php" method="post">
                <textarea class="form-control bg-dark text-light border border-4 border-secondary" id="status" name="status" rows="10"><?php echo $status['status'] ?></textarea>
                <input type="submit" class="btn btn-primary" value="Sauvegarder"></input>
              </form>
            </div>
          </div>
        </div>
        <br>
        <hr size=5px>
        <br>

        <?php

        $sql = 'SELECT id, titre, tag, SUBSTRING(contenu,1,200) AS contenu FROM POSTE';
        $query = $bdd-> query($sql);
        $postes = $query -> fetchAll(PDO::FETCH_ASSOC);

        $query = $bdd -> query('SELECT nom FROM FAVORI WHERE id=(SELECT id FROM BIBLIOTHEQUE WHERE email="'.$compte.'")');
        $jeu = $query-> fetchAll(PDO::FETCH_COLUMN);

        ?>
        <div class="row">
          <div class="col">
            <h3 class="d-flex justify-content-center">Favoris</h3>
            <div class="border border-secondary border-3 p-3">
              <?php
              for ($i=0; $i < 2; $i++) {
                if (isset($jeu[$i])) {
                  echo '<a href="page_jeu.php?jeu='.$jeu[$i].'"><img src="imageJeux/'.$jeu[$i].'0.jpg" class="img-thumbnail"></a>';
                }
              }
              ?>
              <a href="bibliotheque.php?visit=<?php echo $compte ?>" class="d-flex justify-content-center btn btn-primary mt-3">Voir sa bibliothèque</a>
            </div>
          </div>
          <div class="col">
            <h3 class="d-flex justify-content-center">Postes récents</h3>
            <div class="border border-secondary border-3">
              <?php

              $i = 0;
              foreach (array_reverse($postes) as $poste) {
                if ($i < 2) {
                  echo'
                  <div class="d-flex justify-content-center my-3">
                    <div class="card w-75">
                    <a href="page_poste.php?id='.$poste['id'].'">
                      <div class="card-body text-light bg-dark p-3">
                        <h5 class="card-title p-3"><b class="fs-2 text-uppercase">'.$poste['titre'].'</b>';
                        if ($poste['tag'] != '0') {
                          echo '<button class="btn btn-sm btn-secondary ms-3 mb-2">'.$poste['tag'].'</button>';
                        }
                        echo'</h5>
                        <hr size="3">
                        <p class="card-text p-3">'.$poste['contenu'].'</p>
                      </div>
                    </div>
                    </a>
                  </div>';
                }
                $i++;
              }
              ?>
            </div>
          </div>
        </div>

      </div>
    </main>
    <a href="deconnexion.php">Deconnexion</a>
    <?php include "includes/footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
