<div class="container-fluid intro">
  <div class="row">
    <div class="col-4 col-md-1"></div>
    <div class="col-4 col-md-1 d-flex justify-content-center">
      <a href="index.php"><img src="images/Logic.logo.png" class="img-fluid"></a>
    </div>

    <div class="col-12 col-md-9">
      <form class="d-flex">
        <input class="form-control form-control-lg" type="search" placeholder="Barre de recherche" aria-label="Search">
        <button class="btn btn-outline-light btn-lg" type="submit">Rechercher</button>
      </form>
      <div class="col-md-1"></div>
      <div class="row">
        <a type="button" class="btn btn-secondary col-4 col-md-3 mt-3 mx-3" <?php if(isset($_SESSION['compte'])){
          echo 'href="profil.php">Profil</a>';
        } else {
          echo 'href="connexion.php">Connexion</a>';
        }
        ?>
        <a type="button" class="btn btn-secondary col-4 col-md-3 mt-3 mx-3" href="inscription.php">Inscription</a>
        <a type="button" class="btn btn-secondary col-4 col-md-3 mt-3 mx-3" href="ajout_jeu.php">Ajouter un jeu</a>
      </div>
    </div>
  </div>
</div>
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
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
            <a class="nav-link" href="#">Nouveaux jeux</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Jeux populaires</a>
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
              <!--
              <li><a class="dropdown-item" href="genre.php">Action</a></li>
              <li><a class="dropdown-item" href="#">Aventure</a></li>
              <li><a class="dropdown-item" href="#">Hack & slash</a></li>
              <li><a class="dropdown-item" href="#">Horreur</a></li>
              <li><a class="dropdown-item" href="#">Management</a></li>
              <li><a class="dropdown-item" href="#">Open World / Sandbox</a></li>
              <li><a class="dropdown-item" href="#">Course</a></li>
              <li><a class="dropdown-item" href="#">RPG</a></li>
              <li><a class="dropdown-item" href="#">STR</a></li>
              <li><a class="dropdown-item" href="#">FPS</a></li>
              <li><a class="dropdown-item" href="#">Simulation</a></li>
              <li><a class="dropdown-item" href="#">Stratégie</a></li>
              <li><a class="dropdown-item" href="#">Survie</a></li>
              <li><a class="dropdown-item" href="#">Visual novel</a></li>
              -->
              <li><hr class="dropdown-divider"></li>
              <li><a class=dropdown-item href="ajout_genre.php">Ajouter un genre</a></li>
            </ul>
            <li class="nav-item">
              <a class="nav-link" href="liste_jeux.php">Liste de jeux</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Votre bibliothèque</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="liste_utilisateurs.php">Liste utilisateurs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="test.php">TEST</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
