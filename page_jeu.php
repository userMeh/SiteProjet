<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">

  <?php
  include "includes/bdd.php";
  include "includes/bootstrap.php";

  if (isset($_GET['jeu'])) {          //Pour verifier si le jeu existe et eviter les injections sql
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
  ?>

  <title> <?php echo $jeu ?> </title>
</head>
<body>

  <?php include "includes/header.php" ?>

  <div class="containerhelp">
    <h1> <?php echo $jeu ?> </h1>
    <div class="container">
      <div class="row">
        <div class="col-12">

          <img class="images" src='imageJeux/<?php
          $query = $bdd -> query('SELECT image FROM JEUX WHERE nom= "'. $jeu .'"');
          while($req = $query -> fetch(PDO::FETCH_OBJ)){
            echo $req->image;
          }
          ?>'>
          <div class="col-4 d-grid gap-2 d-md-flex justify-content-md-end">
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container rounded">
    <h1>Images de <?php echo $jeu ?> :</h1>
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
  <div class="container rounded">
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

      Date de sortie:
      <?php
      $query = $bdd -> query('SELECT date_sortie FROM JEUX WHERE nom= "'. $jeu .'"');
      while($req = $query -> fetch(PDO::FETCH_OBJ)){
        echo $req->date_sortie;
      }
      ?>
      <br>
      Développeur:
      <?php
      $query = $bdd -> query('SELECT developpeur FROM JEUX WHERE nom= "'. $jeu .'"');
      while($req = $query -> fetch(PDO::FETCH_OBJ)){
        echo $req->developpeur;
      }
      ?>
      <br><hr>
      <h2>Configuration recommandée</h2><br>
      OS:
      <?php
      $query = $bdd -> query('SELECT systeme FROM JEUX WHERE nom= "'. $jeu .'"');
      while($req = $query -> fetch(PDO::FETCH_OBJ)){
        echo $req->systeme;
      }
      ?>
      <br>
      Processor:
      <?php
      $query = $bdd -> query('SELECT processeur FROM JEUX WHERE nom= "'. $jeu .'"');
      while($req = $query -> fetch(PDO::FETCH_OBJ)){
        echo $req->processeur;
      }
      ?>
      <br>
      Memory:
      <?php
      $query = $bdd -> query('SELECT memoire FROM JEUX WHERE nom= "'. $jeu .'"');
      while($req = $query -> fetch(PDO::FETCH_OBJ)){
        echo $req->memoire;
      }
      ?>
      <br>
      Graphics:
      <?php
      $query = $bdd -> query('SELECT graphique FROM JEUX WHERE nom= "'. $jeu .'"');
      while($req = $query -> fetch(PDO::FETCH_OBJ)){
        echo $req->graphique;
      }
      ?>
      <br>
      DirectX:
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
      " class="btn btn-primary">Cliquer ici</a>
    </p>
  </div>



  <!--script js-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>

</html>
