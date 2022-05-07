<div class="container-fluid intro">
  <div class="row">
    <div class="col-4 col-md-1"></div>
    <div class="col-4 col-md-1 d-flex justify-content-center">
      <a href="index.php"><img src="images/Logic.logo.png" class="img-fluid"></a>
    </div>

    <?php
    if (isset($_SESSION['compte'])) {
      $query = $bdd -> query('SELECT type FROM UTILISATEURS WHERE email="'.$_SESSION['compte'].'"');
      $type = $query -> fetchAll(PDO::FETCH_COLUMN);
      if ($type[0] == 1) {
        $admin = 1;
      } else {
        $admin = 0;
      }
    } else {
      $admin = 0;
    }
    ?>

    <div class="col-12 col-md-9">
      <form class="d-flex" method="GET" action="liste_jeux.php">
        <div class="col-10">
          <input id="search" class="form-control form-control-lg me-3" name="search" type="search" oninput="searchGame()" placeholder="Recherche" aria-label="Search">
          <div class="absolute" id="suggestion">

          </div>
        </div>
        <div class="col-2">
          <button id="searchbar" class="btn btn-outline-light btn-lg" type="submit">Rechercher</button>
        </div>
      </form>

      <div class="col-md-1"></div>
      <div class="row">
        <a type="button" class="btn btn-secondary col-4 col-md-3 mt-3 mx-3" <?php if(isset($_SESSION['compte'])){
          echo 'href="profil.php">Profil</a>';
        } else {
          echo 'href="connexion.php">Connexion</a>';
        }
        ?>
        <a type="button" class="btn btn-secondary col-4 col-md-3 mt-3 mx-3" <?php if(isset($_SESSION['compte'])){
          echo 'href="deconnexion.php">Deconnexion</a>';
        } else {
          echo 'href="inscription.php">Inscription</a>';
        }
        ?>
        <?php
        if ($admin == 1) {
          echo '<a type="button" class="btn btn-secondary col-4 col-md-3 mt-3 mx-3" href="ajout_jeu.php">Ajouter un jeu</a>';
        }
        ?>
      </div>
    </div>
  </div>
</div>
<nav id="navbar" class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="liste_jeux.php?jeu=!nouveaux">Nouveaux jeux</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="liste_jeux.php?jeu=!populaires">Jeux populaires</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Genre
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <?php
              $query = $bdd -> query('SELECT nom FROM GENRE');
              $fetch = $query -> fetchAll(PDO::FETCH_COLUMN);
              $count = count($fetch);

              for ($i=0; $i < $count; $i++) {
                echo '<li><a class="dropdown-item" href="genre.php?genre='.$fetch[$i].'">'.$fetch[$i].'</a></li>';
              }
              ?>
              <?php
              if ($admin == 1) {
                echo
                '<li><hr class="dropdown-divider"></li>
                <li><a class=dropdown-item href="ajout_genre.php">Ajouter un genre</a></li>';
              }
              ?>
            </ul>
            <li class="nav-item">
              <a class="nav-link" href="liste_jeux.php">Liste de jeux</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="bibliotheque.php">Votre bibliothèque</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="liste_tournoi.php">Tournoi</a>
            </li>
            <?php
            if ($admin == 1) {
              echo
              '<li class="nav-item">
                <a class="nav-link" href="liste_utilisateurs.php">Liste utilisateurs</a>
              </li>';
            }
            ?>
            <li class="nav-item">
              <a class="nav-link" href="forum.php">Forum</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="avatar/test.php">TEST</a>
            </li>
          </ul>
          <span>
            <a id="lightDark" type="button" class="btn btn-light" onclick="switchMode()"><i id="lightDark-icon" class="bi-sun light"></i></a>
          </span>
        </div>
      </div>
      <script src="css-js/script.js?<?php echo time(); ?>"></script>
    </nav>
