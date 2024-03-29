<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">

  <?php
  include "includes/head.php";

  if (isset($_GET['jeu'])) {          //Pour verifier si le jeu existe

    $jeu = $_GET['jeu'];

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
  if (isset($_SESSION['compte'])) {
    $email = $_SESSION['compte'];

    $query = $bdd -> query('SELECT id FROM BIBLIOTHEQUE WHERE email="'.$email.'"');
    $id = $query -> fetchAll(PDO::FETCH_COLUMN);
    if (!$id) {
      $query = $bdd -> query('SELECT id FROM BIBLIOTHEQUE ORDER BY id DESC');
      $incr = $query -> fetchAll(PDO::FETCH_COLUMN);

      $prepare = $bdd -> prepare('INSERT INTO BIBLIOTHEQUE(id, email) VALUES(:id, :email)');
      $prepare -> execute([
        'id' => $incr[0]+1,
        'email' => $email
      ]);

      $id = $incr[0]+1;
    }
    $query = $bdd -> query('SELECT nom FROM FAVORI WHERE id='.$id[0].' AND nom="'.$jeu.'"');
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
      $txt = "$compte a visité la page $jeu à ce jour $date\n";
      fwrite($logs, $txt);
      fclose($logs);
    }
    ?>

    <div class="container rounded">

      <div class="centreur mb-5">
        <h1><b id="nomJeu"><?php echo $jeu ?></b></h1>
        <div class="row mt-5">
          <div class="col-8" style="border-right:solid #3f3f3f;">
            <img class="images img-thumbnail" src='imageJeux/<?php
            $query = $bdd -> query('SELECT image FROM JEUX WHERE nom= "'. $jeu .'"');
            $image = $query -> fetchAll(PDO::FETCH_COLUMN);
              echo $image[0];
            ?>'>
          </div>
          <div class="col-4">
            <div class="row">
              <span>
                <i class="bi-star-fill note me-2" data-value="1" style="font-size: 2.5rem;"></i>
                <i class="bi-star-fill note me-2" data-value="2" style="font-size: 2.5rem;"></i>
                <i class="bi-star-fill note me-2" data-value="3" style="font-size: 2.5rem;"></i>
                <i class="bi-star-fill note me-2" data-value="4" style="font-size: 2.5rem;"></i>
                <i class="bi-star-fill note me-2" data-value="5" style="font-size: 2.5rem;"></i>
              </span>
              <hr size="5">
              <div>
                <i class="bi-star-half" style="font-size: 4rem; color: yellow;"></i>
                <p class="fs-2">
                  <?php
                  $query = $bdd -> query('SELECT CAST(AVG(valeur) AS DECIMAL(2,1)) AS note FROM NOTE WHERE nom="'.$jeu.'"');
                  $note = $query -> fetch();
                  if (!$note['note']) {
                    echo "-";
                  } else {
                    echo $note['note'];
                  }
                  ?>
                </p>
              </div>
              <hr size="5" style="margin:0;">
            </div>
            <div class="row">
              <div class="col-6 pt-4">
                <p class="fs-5">Nombre de vues</p>
                <?php
                $query = $bdd -> query('SELECT email FROM UTILISATEURS');
                $vues=0;
                while($req = $query -> fetch(PDO::FETCH_OBJ)){
                  if (file_exists("logs/visite_jeu/$req->email.txt")) {
                    $fp = fopen("logs/visite_jeu/$req->email.txt","r");
                    while (!feof($fp)) {
                      $page = fgets($fp, 4096);
                      if (preg_match("#$jeu#", $page)) {
                        $vues+= 1;
                      }
                    }
                  }
                }
                ?>
                <p class="fs-4"><?php echo $vues.' <i class="bi-eye" style="font-size: 1.5rem;"></i>' ?></p>
              </div>
              <div class="col-6 pt-4" style="border-left:solid #3f3f3f">
                <p class="fs-5" style="margin:0;">Favori</p>
                <?php
                if (isset($_SESSION['compte'])){
                  if (!$favorite) {
                    echo '<a href="verification_favori.php?fav='.$jeu.'/'.$id[0].'"><i class="bi-bookmark-plus-fill" style="font-size: 3rem;"></i></a>';
                  } else {
                    echo '<a href="verification_favori.php?defav='.$jeu.'/'.$id[0].'"><i class="bi-bookmark-dash-fill" style="font-size: 3rem; color: red;"></i></a>';
                  }
                } else {
                  echo '<a class="btn btn-primary mt-3" href="connexion.php">Se connecter</a>';
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php include "includes/messageErreur.php" ?>

      <hr class="mb-3">
      <div class="d-flex justify-content-center">
        <?php
        $query = $bdd -> query('SELECT nom_genre FROM GENRE_JEUX WHERE nom_jeux= "'. $jeu .'"');
        $genre = $query -> fetchAll(PDO::FETCH_COLUMN);
        $nbGenre = count($genre);
        for ($i=0; $i < $nbGenre; $i++) {
          echo '<a href="genre.php?genre='.$genre[$i].'" class="btn btn-secondary col-2 mx-1">'.$genre[$i].'</a>';
        }
        ?>
      </div>

      <hr class="mt-3">

      <div class="row mt-5">
        <h2 class="col-12"><b>Images de <?php echo $jeu ?></b> :</h2>
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
            $carousel1 = $query -> fetchAll(PDO::FETCH_COLUMN);
              echo $carousel1[0];
            ?>" class="d-block w-100">
          </div>
          <div class="carousel-item">
            <img src="imageJeux/<?php
            $query = $bdd -> query('SELECT carousel2 FROM JEUX WHERE nom= "'. $jeu .'"');
            $carousel2 = $query -> fetchAll(PDO::FETCH_COLUMN);
              echo $carousel2[0];
            ?>" class="d-block w-100">
          </div>
          <div class="carousel-item">
            <img src="imageJeux/<?php
            $query = $bdd -> query('SELECT carousel3 FROM JEUX WHERE nom= "'. $jeu .'"');
            $carousel3 = $query -> fetchAll(PDO::FETCH_COLUMN);
              echo $carousel3[0];
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

      <h1>Synopsis
      <?php if ($admin == 1) {
        echo '<button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edition-synopsis">Editer</button>';
      }
      ?> </h1>
      <p>

        <?php
        $query = $bdd -> query('SELECT synopsis FROM JEUX WHERE nom= "'. $jeu .'"');
        $synopsis = $query -> fetchAll(PDO::FETCH_COLUMN);
          echo $synopsis[0];
        ?>

      </p>
      <hr>
      <h2>A Propos du jeu
      <?php if ($admin == 1) {
        echo '<button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edition-aPropos">Editer</button>';
      }
      ?></h2>
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
        $developpeur = $query -> fetchAll(PDO::FETCH_COLUMN);
          echo $developpeur[0];
        ?>
        <br><hr>
        <h2>Configuration recommandée
          <?php if ($admin == 1) {
            echo '<button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edition-config">Editer</button>';
          }
          ?></h2>
        <br>
        <b>OS</b>:
        <?php
        $query = $bdd -> query('SELECT systeme FROM JEUX WHERE nom= "'. $jeu .'"');
        $systeme = $query -> fetchAll(PDO::FETCH_COLUMN);
          echo $systeme[0];
        ?>
        <br>
        <b>Processor</b>:
        <?php
        $query = $bdd -> query('SELECT processeur FROM JEUX WHERE nom= "'. $jeu .'"');
        $processeur = $query -> fetchAll(PDO::FETCH_COLUMN);
          echo $processeur[0];
        ?>
        <br>
        <b>Memory</b>:
        <?php
        $query = $bdd -> query('SELECT memoire FROM JEUX WHERE nom= "'. $jeu .'"');
        $memoire = $query -> fetchAll(PDO::FETCH_COLUMN);
          echo $memoire[0];
        ?>
        <br>
        <b>Graphics</b>:
        <?php
        $query = $bdd -> query('SELECT graphique FROM JEUX WHERE nom= "'. $jeu .'"');
        $graphique = $query -> fetchAll(PDO::FETCH_COLUMN);
          echo $graphique[0];
        ?>
        <br>
        <b>DirectX</b>:
        <?php
        $query = $bdd -> query('SELECT directX FROM JEUX WHERE nom= "'. $jeu .'"');
        $directX = $query -> fetchAll(PDO::FETCH_COLUMN);
          echo $directX[0];
        ?>
        <br><br><br>

        Pour avoir plus d'information ou Acheté le jeu vous pouvez aller ici :
        <a href="
        <?php
        $query = $bdd -> query('SELECT redirection FROM JEUX WHERE nom= "'. $jeu .'"');
        $redirection = $query -> fetchAll(PDO::FETCH_COLUMN);
          echo $redirection[0];
        ?>
        " class="btn btn-info">Cliquer ici</a>
      </p>

      <hr size="5">

      <h2 class="d-flex justify-content-center">Commentaires</h2>

      <?php
      if(isset($_SESSION['compte'])){
        echo '
        <form action="verification_commentaire_jeu.php" method="post">
          <div class="my-3">
            <label for="commentaire" class="form-label">Mettez un commentaire</label>
            <textarea class="form-control" id="commentaire" name="commentaire" rows="3"></textarea>
          </div>
          <div style="display:none"><input value="'.$jeu.'" name="nomJeu"></input></div>
          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary btn-lg">Envoyer</button>
          </div>
        </form>
        ';
      }
      ?>

      <hr size="5">

      <?php

      $query = $bdd -> query('SELECT id, date, heure, email, contenu FROM COMMENTAIRE_JEUX');
      $commentaires = $query -> fetchAll(PDO::FETCH_ASSOC);

      foreach ($commentaires as $commentaire) {
        $array = explode('-', $commentaire['date']);
        $annee = current($array);
        $mois = next($array);
        $jour = next($array);
        $date = $jour .'/'. $mois .'/'. $annee;

        $query = $bdd -> query('SELECT pseudo FROM UTILISATEURS WHERE email="'.$commentaire['email'].'"');
        $auteur = $query -> fetch();

        echo '
        <div class="d-flex justify-content-center mb-5">
          <div class="card w-75">
            <div class="card-body text-light bg-dark p-3">
            <div class="row">
              <h5 class="card-title p-3 col-11"><a href="profil.php?visit='.$commentaire['email'].'" class="text-light"><b class="fs-4 text-uppercase">'.$auteur['pseudo'].'</b></a></h5>';
              if ($admin == 1) {
                echo '
                  <div class="col-1 d-flex justify-content-end">
                    <button type="button" class="btn-close btn-danger btn-sm " aria-label="Close" data-bs-toggle="modal" data-bs-target="#suppression'.$commentaire['id'].'"></button>
                  </div>';
              }
              echo '
              </div>
              <p class="card-text p-3">'.$commentaire['contenu'].'</p>
              <p class="card-text col-9"><small class="text-muted">Posté le '.$date.' à '.$commentaire['heure'].'</small></p>
            </div>
          </div>
        </div>';

        if ($admin == 1) {
          echo '
          <div class="modal fade popup" id="suppression'.$commentaire['id'].'" tabindex="-1" aria-labelledby="suppressionLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="suppressionLabel">Suppression</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Etes-vous sûr de supprimer ce commentaire de la base de donnée? Cet action est irréversible !
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                  <a type="button" class="btn btn-danger" href="verification_commentaire_jeu.php?delete='.$commentaire['id'].'">Supprimer</a>
                </div>
              </div>
            </div>
          </div>';
        }
      }

      ?>
    </div>
  </main>


  <!-- Modal edition synopsis -->
  <div class="modal fade popup" id="edition-synopsis" tabindex="-1" aria-labelledby="editionLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editionLabel">Edition du synopsis</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="verification_modification_jeu.php?modify1=<?php echo $jeu ?>" method="post" enctype="multipart/form-data">

            <div class="form-group mb-3">
              <label for="synopsis">synopsis</label>
              <textarea name="synopsis" class="form-control" rows="10"><?php echo $synopsis[0] ?></textarea>
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

  <!-- Modal edition a propos du jeu -->
  <div class="modal fade popup" id="edition-aPropos" tabindex="-1" aria-labelledby="editionLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editionLabel">Edition à propos du jeu</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="verification_modification_jeu.php?modify2=<?php echo $jeu ?>" method="post" enctype="multipart/form-data">

            <div class="mb-3">
              <label for="date_sortie" class="form-label"><h4>Date de sortie</h4></label>
              <input type="text" name="date_sortie" class="form-control" value="<?php echo ''.strftime("%d", strtotime($date[0])).'/'.strftime("%m", strtotime($date[0])).'/'.strftime("%G", strtotime($date[0])).''; ?>" required>
              <div class="form-text">Format: Jour/Mois/Année , JJ/MM/AA.</div>
            </div>

            <div class="mb-3">
              <label for="developpeur" class="form-label"><h4>Développeur</h4></label>
              <input type="text" name="developpeur" class="form-control" value="<?php echo $developpeur[0] ?>" required>
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

  <!-- Modal edition des configuration -->
  <div class="modal fade popup" id="edition-config" tabindex="-1" aria-labelledby="editionLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editionLabel">Edition des configurations recommandées</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="verification_modification_jeu.php?modify3=<?php echo $jeu ?>" method="post" enctype="multipart/form-data">

            <div class="mb-3">
              <label for="systeme" class="form-label"><h4>Système d'exploitation</h4></label>
              <input type="text" name="systeme" class="form-control" value="<?php echo $systeme[0] ?>" required>
            </div>

            <div class="mb-3">
              <label for="processeur" class="form-label"><h4>Processeur</h4></label>
              <input type="text" name="processeur" class="form-control" value="<?php echo $processeur[0] ?>" required>
            </div>

            <div class="mb-3">
              <label for="memoire" class="form-label"><h4>Mémoire</h4></label>
              <input type="text" name="memoire" class="form-control" value="<?php echo $memoire[0] ?>" required>
            </div>

            <div class="mb-3">
              <label for="graphique" class="form-label"><h4>Carte graphique</h4></label>
              <input type="text" name="graphique" class="form-control" value="<?php echo $graphique[0] ?>" required>
            </div>

            <div class="mb-3">
              <label for="directX" class="form-label"><h4>DirectX</h4></label>
              <input type="text" name="directX" class="form-control" value="<?php echo $directX[0] ?>" required>
            </div>

            <div class="mb-3">
              <label for="redirection" class="form-label"><h4>Redirection</h4></label>
              <input type="text" name="redirection" class="form-control" value="<?php echo $redirection[0] ?>" required>
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

  <?php include "includes/footer.php" ?>

  <!--script js-->
  <script src="css-js/script.js?<?php echo time(); ?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>

</html>
