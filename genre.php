<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <?php
    include "includes/bootstrap.php";
    include "includes/bdd.php";

    if (isset($_GET['genre'])) {          //Pour verifier si le genre existe et eviter les injections sql
      $genre=$_GET['genre'];
      $exist=$bdd->prepare('SELECT nom FROM GENRE WHERE nom=?');
      $exist->execute([
        $genre
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

    ?>

    <title><?php echo $genre ?></title>
  </head>
  <body>
    <?php include "includes/header.php" ?>

    <main class="container p-5">
      <br>
      <h1 class="d-flex justify-content-center"><?php echo $genre ?></h1>
      <div>
        <br>
        <p>
          <?php
          $query = $bdd -> query('SELECT description FROM GENRE WHERE nom= "'. $genre .'"');
          while($req = $query -> fetch(PDO::FETCH_OBJ)){
            echo $req->description;
          }
          ?>
        </p>
      </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
