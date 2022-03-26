<?php session_start(); ?>
<div class="container-fluid intro">
  <div class="row">
    <div class="col-4 col-md-1">
    </div>
    <img src="images/Logic.png" class="img-fluid col-4 col-md-1">
    <div class="col-12 col-md-8">
      <form class="d-flex">
        <input class="form-control form-control-lg" type="search" placeholder="Meh Dan" aria-label="Search">
        <button class="btn btn-outline-light btn-lg" type="submit">Rechercher</button>
      </form>
      <div class="row">
        <a type="button" class="btn btn-secondary col-4 col-md-3 mt-3 mx-3" <?php if(isset($_SESSION['pseudo'])){
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
              <a class="dropdown-item" href="genre.php">Action</a>
              <a class="dropdown-item" href="#">Aventure</a>
              <a class="dropdown-item" href="#">Hack & slash</a>
              <a class="dropdown-item" href="#">Horreur</a>
              <a class="dropdown-item" href="#">Management</a>
              <a class="dropdown-item" href="#">Open World / Sandbox</a>
              <a class="dropdown-item" href="#">Course</a>
              <a class="dropdown-item" href="#">RPG</a>
              <a class="dropdown-item" href="#">STR</a>
              <a class="dropdown-item" href="#">FPS</a>
              <a class="dropdown-item" href="#">Simulation</a>
              <a class="dropdown-item" href="#">Stratégie</a>
              <a class="dropdown-item" href="#">Survie</a>
              <a class="dropdown-item" href="#">Visual novel</a>
            </ul>
            <li class="nav-item">
              <a class="nav-link" href="#">Liste de jeux</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Votre bibliothèque</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
