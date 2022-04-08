<!DOCTYPE html>
<html>
  <head>
    <?php
    include "includes/head.php";

    if (!isset($_SESSION['compte'])){
      header("location:index.php");
    }
    ?>
    <meta charset="utf-8">

    <title>bibliothèque</title>
  </head>
  <body>

    <?php include "includes/header.php" ?>

    <?php
    $query = $bdd -> query('SELECT id FROM BIBLIOTHEQUE WHERE email="'.$_SESSION['compte'].'"');
    $id = $query -> fetchAll(PDO::FETCH_COLUMN);

    $query = $bdd -> query('SELECT nom FROM FAVORI WHERE id='.$id[0].'');
    $jeu = $query -> fetchAll(PDO::FETCH_COLUMN);
    $count_jeu = count($jeu);
    ?>

    <main>
      <div class="container">
        <h1 class="mb-3"><b>Votre bibliothèque</b></h1>
        <hr>
        <?php
        for ($i=0; $i < $count_jeu; $i++) {
          if ($i==0) {
            echo '<div class="row mt-5">';
          }

          echo
          '<div class="card bg-dark" style="width: 33%;">
            <a href="page_jeu.php?jeu='.$jeu[$i].'"><img src="imageJeux/'.$jeu[$i].'0.jpg" class="card-img-top"></a>
            <div class="card-body">
              <h3 class="card-title d-flex justify-content-center"><b>'.$jeu[$i].'</b></h3>
            </div>
          </div>';

          if ($count_jeu%4 == 0 AND $i != 0) {
            echo '</div>';
            echo '<div class="row">';
          }
          echo
          '';
        }
        if ($count_jeu%4 != 0) {
          echo '</div>';
        }

        ?>

        <div class="row">

        </div>
      </div>
    </main>

    <?php include "includes/footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
