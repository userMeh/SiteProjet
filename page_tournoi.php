<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">

  <?php
  include "includes/head.php";



  if (isset($_GET['jeu'])) {          //Vérification du tournoi existant

    $array = explode('/', $_GET['jeu']);
    $tournoi = $array[0];

    if (!empty($array[1])) {
      $message = $array[1];
    }

    $tournament =$bdd->prepare('SELECT nom_du_jeu FROM TOURNOI WHERE nom_du_jeu=?');
    $tournament->execute([
      $tournoi
    ]);
    $result=$tournament->fetchAll();
    if(count($result) != 1){
      header('location:index.php');
      exit;
    }
  }

  ?>
  <title> <?php echo $tournoi ?> </title>
</head>
<body>
  <main>
    <?php include "includes/header.php" ?>
    <?php
    if(isset($_SESSION['compte'])){
      $compte = $_SESSION['compte'];
      if(!file_exists("logs/visite_tournoi/")){
        mkdir("logs/visite_tournoi/$compte", 0777,True);
      }

      $logs = fopen("logs/visite_tournoi/$compte.txt", "a+");
      date_default_timezone_set('Europe/Paris');
      $date = date('d/m/Y à H:i:s');
      $txt = "$compte a visité la page $tournoi le $date\n";

      fwrite($logs, $txt);
      fclose($logs);
    }
    ?>

    <div class="container rounded">

      <div class="centreur mb-5">
        <h1><b> <?php echo $tournoi ?> </b></h1>
        <div class="row mt-5">
          <div class="col-8" style="border-right:solid #3f3f3f;">
            <img class="images img-thumbnail" src='imagetournoi/<?php
            $query = $bdd -> query('SELECT image FROM TOURNOI WHERE nom_du_jeu= "'. $tournoi .'"');
            $image = $query -> fetchAll(PDO::FETCH_COLUMN);
              echo $image[0];
            ?>
            '>

          </div>

          <div class="col-4">
            <div class="row">



              <p>
                <br><br>
                <b>Date de fin</b>:
                <?php
                $query = $bdd -> query('SELECT duree FROM TOURNOI WHERE nom_du_jeu= "'. $tournoi .'"');
                $date = $query -> fetchAll(PDO::FETCH_COLUMN);
                $liste = 0;
                include "includes/date.php";

                echo ''.$jour.' '.$mois.' '.$annee.'';
                ?>

                <br><br><br>
                <b>participant actuel</b>:
                <?php
                $query = $bdd -> query('SELECT participant_actuel FROM TOURNOI WHERE nom_du_jeu= "'. $tournoi .'"');
                $participant = $query -> fetchAll(PDO::FETCH_COLUMN);
                  echo $participant[0];
                ?>


                 <div class="row">
                  <div class="col-6 pt-4" style="border-left:solid #3f3f3f">

                    <?php
                    if (isset($_SESSION['compte'])){
                      $query = $bdd -> query('SELECT id FROM TOURNOI WHERE nom_du_jeu="'.$tournoi.'"');
                      $id = $query -> fetchAll(PDO::FETCH_COLUMN);
                      $query = $bdd -> query('SELECT email FROM PARTICIPATION WHERE id='.$id[0].' AND email="'.$_SESSION['compte'].'"');
                      $participants = $query -> fetchAll(PDO::FETCH_COLUMN);

                      if (count($participants) == 0) {
                        echo '<a href="verification_participant.php?participe='.$compte.'/'.$id[0].'"><button style="font-size:15px; background:#3f3f3f;">Rejoindre</button></a>';
                      } else {
                        echo '<a href="verification_participant.php?leave='.$compte.'/'.$id[0].'"><button style="font-size:15px; background:#3f3f3f;">Quitter</button></a>';
                      }
                    } else {
                      echo '<a class="btn btn-primary mt-3" href="connexion.php">Se connecter</a><br><br>';
                    }
                    ?>
                  </div>
                </div>

                <?php
                $query = $bdd -> query('SELECT nombre_participant FROM TOURNOI WHERE nom_du_jeu= "'. $tournoi .'"');
                $participant_max = $query -> fetchAll(PDO::FETCH_COLUMN);
                  echo'<b>participant maximun : '.$participant_max[0].'</b>';
                ?>



            </div>
          </div>
            <?php
          $query = $bdd -> query('SELECT date_de_depart FROM TOURNOI WHERE nom_du_jeu= "'. $tournoi .'"');
          $date_de_debut = $query -> fetchAll(PDO::FETCH_COLUMN);

          $date = time();
          $date_de_debut[0] = strtotime($date_de_debut[0]);
          $date_de_fin[0] = strtotime($date_de_fin[0]);



          $date_now= strftime('%d %B %Y', $date);
          $date_de_debut[0] = strftime('%d %B %Y', $date_de_debut[0]);
          $duree[0] = strftime('%d %B %Y', $date_de_fin[0]);


           if ($date_now > $date_de_fin[0]){
             echo "<a> Statue </a>";
             echo '<button type="button" style="background: #663300">Terminé</button> ';
           }
           if ($date_now < $date_de_debut[0]){
             echo "<a> Statue </a>";
             echo '<button type="button" style="background: #663300">En Préparation</button> ';
           } else {
             echo "<a> Statue </a>";
             echo '<button type="button" style="background: #663300">En Cours</button> ';
           }

          ?>
        </div>
      </div>

      <hr class="mt-3">

    <div class="container">
      <h1>Regle du tournoi</h1>
      <p>

        <?php
        $query = $bdd -> query('SELECT description FROM TOURNOI WHERE nom_du_jeu= "'. $tournoi .'"');
        $regle = $query -> fetchAll(PDO::FETCH_COLUMN);
          echo $regle[0];
        ?>

      </p>
      <?php  if ($admin == 1) { ?>
     <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edition-synopsis">Editer</button>
   <?php } ?>
  </main>

  <?php  if ($admin == 1) { ?>
  <div class="modal fade popup" id="edition-synopsis" tabindex="-1" aria-labelledby="editionLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editionLabel">Edition du regle</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="verification_modification_reglement.php?modify=<?php echo $tournoi ?>" method="post" enctype="multipart/form-data">

            <div class="form-group mb-3">
              <label for="synopsis">regle</label>
              <textarea name="synopsis" class="form-control" rows="10"><?php echo $regle[0] ?></textarea>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
              <button type="submit" class="btn btn-primary">Sauvegarder</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?php } ?>
  <?php include "includes/footer.php" ?>


  <!--script js-->
  <script src="css-js/script.js?<?php echo time(); ?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>

</html>
