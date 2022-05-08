<?php

include "includes/bdd.php";

$search = isset($_GET['search']) ? $_GET['search'] : NULL;
$user = isset($_GET['session']) ? $_GET['session'] : NULL;

$query = $bdd -> query('SELECT type FROM UTILISATEURS WHERE email ="'.$user.'"');
$type = $query -> fetch();

if (isset($type['type'])) {
  $admin = $type['type'];
} else {
  $admin = 0;
}


$sql = 'SELECT id, titre, tag, SUBSTRING(contenu,1,200) AS contenu, date_poste, heure_poste, email FROM POSTE';
$params = [];

if ($search == 'self') {
  $sql .= ' WHERE email=?';
  $params[] = $user;
} else if ($search == 'tag') {
  $sql .= ' WHERE tag IN (SELECT nom FROM FAVORI WHERE id=(SELECT id FROM BIBLIOTHEQUE WHERE email="'.$user.'"))';
  $params[] = $user;
} else if ($search) {
  $sql .= ' WHERE titre LIKE ? OR tag LIKE ? AND tag IN (SELECT nom FROM FAVORI WHERE id=(SELECT id FROM BIBLIOTHEQUE WHERE email="'.$user.'"))';
  $params[] = '%' . $search . '%';
  $params[] = '%' . $search . '%';
} else {
  $sql .= ' WHERE tag IN (SELECT nom FROM FAVORI WHERE id=(SELECT id FROM BIBLIOTHEQUE WHERE email="'.$user.'"))OR tag="0"';
}

$statement = $bdd -> prepare($sql);
$statement -> execute($params);
$postes = $statement -> fetchAll(PDO::FETCH_ASSOC);

$count = count($postes);
$i=0;

foreach (array_reverse($postes) as $poste ) {

  $array = explode('-', $poste['date_poste']);
  $annee = current($array);
  $mois = next($array);
  $jour = next($array);
  $date_poste = $jour .'/'. $mois .'/'. $annee;

  $countLike = 0;
  $countDislike = 0;

  $id = $poste['id'];

  if (file_exists("logs/like/$id.txt")) {
    $file = file("logs/like/$id.txt");
    $file = array_reverse($file);

    $query = $bdd->query('SELECT email FROM UTILISATEURS');
    $compte = $query->fetchAll(PDO::FETCH_COLUMN);
    $count_compte = count($compte);

    for ($j=0; $j < $count_compte; $j++) {
      foreach($file as $f){
        if (preg_match("#$compte[$j]#", $f)==1){

          if (preg_match("#retiré#", $f)){

          } else if (preg_match("#dislike#", $f)) {
            $countDislike += 1;
          } else if (preg_match("#like#", $f)){
            $countLike += 1;
          }
          break;
        }
      }
    }
  }
  $query = $bdd->query('SELECT COUNT(id) AS compteur FROM COMMENTAIRE WHERE id_poste="'.$id.'"');
  $commentaire = $query->fetch();

  $query = $bdd -> query('SELECT pseudo FROM UTILISATEURS,(SELECT email FROM POSTE WHERE tag IN (SELECT nom FROM FAVORI WHERE id=(SELECT id FROM BIBLIOTHEQUE WHERE email="'.$user.'"))OR tag="0") AS meh WHERE UTILISATEURS.email=meh.email');
  $auteur = $query -> fetchAll(PDO::FETCH_COLUMN);

  echo'
  <div class="d-flex justify-content-center mb-5">
    <div class="card w-75">
      <div class="card-body text-light bg-dark p-3">
      <div class="row">
      <a href="page_poste.php?id='.$poste['id'].'">
        <h5 class="card-title p-3 col-10"><b class="fs-2 text-uppercase text-light">'.$poste['titre'].'</b>
        </a>';
        if ($poste['tag'] != '0') {
          echo '<button class="btn btn-sm btn-secondary ms-3 mb-2">'.$poste['tag'].'</button>';
        }
        echo'</h5>';
        if ($admin == 1) {
          echo '
            <div class="col-2 d-flex justify-content-end">
              <button type="button" class="btn-close btn-danger btn-sm " aria-label="Close" data-bs-toggle="modal" data-bs-target="#suppression'.$poste['id'].'"></button>
            </div>';
        }
        echo '</div>
        <hr size="3">
        <p class="card-text p-3">'.$poste['contenu'].'</p>
        <div class="row">
        <p class="card-text col-9"><small class="text-muted">Posté le '.$date_poste.' à '.$poste['heure_poste'].' par '.$auteur[$count-1-$i].'</small></p>
        <p class="col-3"><i class="bi bi-hand-thumbs-up mx-2" style="font-size:1.5rem;">'.$countLike.'</i><i class="bi bi-chat-left-text mx-2" style="font-size:1.5rem;">'.$commentaire['compteur'].'</i></p>
        </div>
      </div>
    </div>
  </div>
  ';
  $i++;
  if ($admin == 1) {
    echo '
    <div class="modal fade popup" id="suppression'.$poste['id'].'" tabindex="-1" aria-labelledby="suppressionLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="suppressionLabel">Suppression</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Etes-vous sûr de supprimer ce poste de la base de donnée? Cet action est irréversible !
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            <a type="button" class="btn btn-danger" href="verification_forum.php?delete='.$poste['id'].'">Supprimer</a>
          </div>
        </div>
      </div>
    </div>';
  }
}

?>
