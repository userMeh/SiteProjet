<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">

  <?php
  include "includes/head.php";

  if (isset($_GET['jeu'])) {          //Pour verifier si le jeu existe
    $jeu=$_GET['jeu'];
    $exist=$bdd->prepare('SELECT nom FROM JEUX WHERE nom=?');
    $exist->execute([
      $jeu
    ]);
    $result=$exist->fetchAll();
    if(count($result) != 1){
      header('location:index.php');
      exit;
    }
  } else {
    header('location:index.php');
    exit;
  }
  $bdd -> query('UPDATE JEUX SET nb_vues = nb_vues + 1 WHERE nom = "'.$jeu.'"'); //Comptabilise la visite
  if (isset($_SESSION['compte'])) {
    $email = $_SESSION['compte'];

    $query = $bdd -> query('SELECT id FROM BIBLIOTHEQUE WHERE email="'.$email.'"');
    $id = $query -> fetchAll(PDO::FETCH_COLUMN);
    if (!$id) {
      $query = $bdd -> query('SELECT id FROM BIBLIOTHEQUE ORDER BY id DESC');
      $incr = $query -> fetchAll(PDO::FETCH_COLUMN);

      $prepare = $bdd -> prepare('INSERT INTO BIBLIOTHEQUE(id, nombre_jeux, email) VALUES(:id, :nombre_jeux, :email)');
      $prepare -> execute([
        'id' => $incr[0]+1,
        'nombre_jeux' => 0,
        'email' => $email
      ]);

      $id = $incr[0]+1;
    }
    $query = $bdd -> query('SELECT nom FROM FAVORI WHERE id = "'.$id[0].'"');
    $favorite = $query -> fetchAll(PDO::FETCH_COLUMN);
  }
  ?>

  <title> <?php echo $jeu ?> </title>
</head>
<body>
  <main>

    <?php include "includes/header.php" ?>

    <?php
    if(isset($_SESSION['compte'])){

      $compte = $_SESSION['compte'];

      if(!file_exists("logs/visite_jeu")){
        mkdir("logs/visite_jeu", 0777);
      }

      $logs = fopen("logs/visite_jeu/$compte.txt", "a+");
      date_default_timezone_set('Europe/Paris');
      $date = date('d/m/Y à H:i:s');
      $txt = "$compte a visité la page $jeu le $date\n";
      fwrite($logs, $txt);
      fclose($logs);
    }
    ?>

    <div class="container rounded">

      <div class="centreur mb-5">
        <h1><b> <?php echo $jeu ?> </b></h1>
        <div class="row mt-5">
          <div class="col-12">
            <img class="images img-thumbnail" src='imageJeux/<?php
            $query = $bdd -> query('SELECT image FROM JEUX WHERE nom= "'. $jeu .'"');
            while($req = $query -> fetch(PDO::FETCH_OBJ)){
              echo $req->image;
            }
            ?>'>
          </div>
        </div>
      </div>

      <hr>

      <div class="row mt-5">
        <h2 class="col-10"><b>Images de <?php echo $jeu ?></b> :</h2>
        <div class="col-2 d-flex justify-content-end">
          <?php
          if (isset($_SESSION['compte'])){
            if (!$favorite) {
              echo '<a href="verification_favori.php?fav='.$jeu.'/'.$id[0].'"><button class="btn btn-info" type="button" name="button">Ajouter aux favoris</button></a>';
            } else {
              echo '<a href="verification_favori.php?defav='.$jeu.'/'.$id[0].'"><button class="btn btn-danger" type="button" name="button">Retirer des favoris</button></a>';
            }
          }
          ?>
        </div>
      </div>

      <div id="tendance" class="carousel slide" data-bs-ride="carousel" data-interval="5000">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#tendance" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#tendance" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#tendance" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="imageJeux/<?php
            $query = $bdd -> query('SELECT carousel1 FROM JEUX WHERE nom= "'. $jeu .'"');
            while($req = $query -> fetch(PDO::FETCH_OBJ)){
              echo $req->carousel1;
            }
            ?>" class="d-block w-100">
          </div>
          <div class="carousel-item">
            <img src="imageJeux/<?php
            $query = $bdd -> query('SELECT carousel2 FROM JEUX WHERE nom= "'. $jeu .'"');
            while($req = $query -> fetch(PDO::FETCH_OBJ)){
              echo $req->carousel2;
            }
            ?>" class="d-block w-100">
          </div>
          <div class="carousel-item">
            <img src="imageJeux/<?php
            $query = $bdd -> query('SELECT carousel3 FROM JEUX WHERE nom= "'. $jeu .'"');
            while($req = $query -> fetch(PDO::FETCH_OBJ)){
              echo $req->carousel3;
            }
            ?>" class="d-block w-100">
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
    </div>
    <div class="container">
      <h1>Synopsis</h1>
      <p>

        <?php
        $query = $bdd -> query('SELECT synopsis FROM JEUX WHERE nom= "'. $jeu .'"');
        while($req = $query -> fetch(PDO::FETCH_OBJ)){
          echo $req->synopsis;
        }
        ?>

      </p>
      <hr>
      <h2>A Propos du jeu </h2>
      <br>
      <p>

        <b>Date de sortie</b>:
        <?php
        $query = $bdd -> query('SELECT date_sortie FROM JEUX WHERE nom= "'. $jeu .'"');
        $date = $query -> fetchAll(PDO::FETCH_COLUMN);

        $liste = 0;
        include "includes/date.php";

        echo ''.$jour.' '.$mois.' '.$annee.'';
        ?>
        <br>
        <b>Développeur</b>:
        <?php
        $query = $bdd -> query('SELECT developpeur FROM JEUX WHERE nom= "'. $jeu .'"');
        while($req = $query -> fetch(PDO::FETCH_OBJ)){
          echo $req->developpeur;
        }
        ?>
        <br><hr>
        <h2>Configuration recommandée</h2><br>
        <b>OS</b>:
        <?php
        $query = $bdd -> query('SELECT systeme FROM JEUX WHERE nom= "'. $jeu .'"');
        while($req = $query -> fetch(PDO::FETCH_OBJ)){
          echo $req->systeme;
        }
        ?>
        <br>
        <b>Processor</b>:
        <?php
        $query = $bdd -> query('SELECT processeur FROM JEUX WHERE nom= "'. $jeu .'"');
        while($req = $query -> fetch(PDO::FETCH_OBJ)){
          echo $req->processeur;
        }
        ?>
        <br>
        <b>Memory</b>:
        <?php
        $query = $bdd -> query('SELECT memoire FROM JEUX WHERE nom= "'. $jeu .'"');
        while($req = $query -> fetch(PDO::FETCH_OBJ)){
          echo $req->memoire;
        }
        ?>
        <br>
        <b>Graphics</b>:
        <?php
        $query = $bdd -> query('SELECT graphique FROM JEUX WHERE nom= "'. $jeu .'"');
        while($req = $query -> fetch(PDO::FETCH_OBJ)){
          echo $req->graphique;
        }
        ?>
        <br>
        <b>DirectX</b>:
        <?php
        $query = $bdd -> query('SELECT directX FROM JEUX WHERE nom= "'. $jeu .'"');
        while($req = $query -> fetch(PDO::FETCH_OBJ)){
          echo $req->directX;
        }
        ?>
        <br><br><br>

        Pour avoir plus d'information ou Acheté le jeu vous pouvez aller ici :
        <a href="
        <?php
        $query = $bdd -> query('SELECT redirection FROM JEUX WHERE nom= "'. $jeu .'"');
        while($req = $query -> fetch(PDO::FETCH_OBJ)){
          echo $req->redirection;
        }
        ?>
        " class="btn btn-info">Cliquer ici</a>
      </p>
    </div>
  </main>

  <?php include "includes/footer.php" ?>

  <!--script js-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>

</html>
