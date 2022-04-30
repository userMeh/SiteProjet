<?php

include "includes/head.php";

if (isset($_GET['search'])) {
  $search = $_GET['search'];

  $search = htmlspecialchars($_GET['search']);
  $query = $bdd -> query('SELECT nom FROM JEUX WHERE nom LIKE "%'.$search.'%"');

  $count = 0;
  while($req = $query -> fetch(PDO::FETCH_OBJ)){
    if ($count < 6) {
      echo '<a href="page_jeu.php?jeu='.$req->nom.'">
              <div class="search-suggestions">'.$req -> nom.'</div>
            </a>';
      $count += 1;
    }
  }
}

?>
