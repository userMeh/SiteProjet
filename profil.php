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
            <div class="image-avatar">
              <?php include "avatar.php" ?>
            </div>
            <?php if(!isset($_GET['visit'])){
              echo'<a class="btn btn-primary me-3" href="select_avatar.php?compte='.$_SESSION['compte'].'">Modifier son avatar</a>';
              echo'<a class="btn btn-primary" href="generate_pdf.php?compte='.$_SESSION['compte'].'">Export du profil</a>';
            } ?>
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
              <?php
              if(isset($_GET['visit'])){
                echo'<p>'.$status['status'].'</p>';
              } else {
                echo
                '
                <form action="verification_modification.php" method="post">
                  <textarea class="form-control bg-dark text-light border border-4 border-secondary" id="status" name="status" rows="10">'.$status['status'].'</textarea>
                  <input type="submit" class="btn btn-primary" value="Sauvegarder"></input>
                </form>
                ';
              }
              ?>
            </div>
          </div>
        </div>
        <br>
        <hr size=5px>
        <br>

        <?php

        $sql = 'SELECT id, titre, tag, SUBSTRING(contenu,1,200) AS contenu FROM POSTE WHERE email="'.$compte.'"';
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
              $exist = 0;
              for ($i=0; $i < 2; $i++) {
                if (isset($jeu[$i])) {
                  echo '<a href="page_jeu.php?jeu='.$jeu[$i].'"><img src="imageJeux/'.$jeu[$i].'0.jpg" class="img-thumbnail"></a>';
                  $exist = 1;
                }
              }
              if ($exist == 0) {
                echo '<p class="text-secondary fs-2 text-center">Aucun favori</p>';
              } else {
                echo '<a href="bibliotheque.php?visit=$compte" class="d-flex justify-content-center btn btn-primary mt-3">Voir sa bibliothèque</a>';
              }
              ?>
            </div>
          </div>
          <div class="col">
            <h3 class="d-flex justify-content-center">Postes récents</h3>
            <div class="border border-secondary border-3 p-3">
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
              if ($i == 0) {
                echo '<p class="text-secondary fs-2 text-center">Aucun poste récent</p>';
              }
              ?>
            </div>
          </div>
        </div>

      </div>
    </main>
    <?php include "includes/footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
