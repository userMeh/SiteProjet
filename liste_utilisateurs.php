<html>
  <head>
    <meta charset="utf-8">
    <?php include "includes/head.php" ?>
    <?php include "includes/admin.php" ?>

    <title>Liste d'utilisateurs</title>
  </head>
  <body>
    <?php include "includes/header.php" ?>

    <main >
      <div class="container p-5">
        <br>
        <h2 class="d-flex justify-content-center">Liste d'utilisateurs</h2>
        <div>

          <?php
          $query = $bdd -> query('SELECT pseudo FROM UTILISATEURS WHERE verifie="oui"');   //Compte le nombre d'utilisateurs et recupere les pseudos
          $pseudo = $query -> fetchAll(PDO::FETCH_COLUMN);
          $users = count($pseudo);

          $query = $bdd -> query('SELECT email FROM UTILISATEURS WHERE verifie="oui"');
          $email = $query -> fetchAll(PDO::FETCH_COLUMN);

          $query = $bdd -> query('SELECT type FROM UTILISATEURS WHERE verifie="oui"');
          $type = $query -> fetchAll(PDO::FETCH_COLUMN);

          $query = $bdd -> query('SELECT date_creation FROM UTILISATEURS WHERE verifie="oui"');
          $date_creation = $query -> fetchAll(PDO::FETCH_COLUMN);

          ?>

          <table class="table table-dark table-striped mt-5">
            <thead>
              <tr>
                <th scope="col">Nom d'utilisateur</th>
                <th scope="col">Email</th>
                <th scope="col">Type d'utilisateur</th>
                <th scope="col">Date de création</th>
                <th scope="col">Modification</th>
              </tr>
            </thead>
            <tbody>
              <?php
              for ($i=0; $i < $users; $i++) {
                echo
                '<tr>
                  <th scope="row">'.$pseudo[$i].'</th>
                  <td>'.$email[$i].'</td>
                  ';
                  if ($type[$i] == 1) {
                    echo
                    '<td style="color:blue;">
                    admin';
                  } else if ($type[$i] == 2){
                    echo
                    '<td style="color:orange;">
                    suspendu';
                  } else {
                    echo
                    '<td>
                    utilisateur';
                  }
                  echo '</td>
                  <td>'.$date_creation[$i].'</td>
                  <td>
                    <button class="btn btn-primary btn-sm me-1" data-bs-toggle="modal" data-bs-target="#edition'.$pseudo[$i].'"><i class="bi-list" style="font-size: 1.2rem"></i></button>';
                    if ($type[$i] == 2) {
                      echo '<button class="btn btn-success btn-sm me-1" data-bs-toggle="modal" data-bs-target="#bannir'.$pseudo[$i].'"><i class="bi-unlock" style="font-size: 1.2rem"></i></button>';
                    } else {
                      echo '<button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#bannir'.$pseudo[$i].'"><i class="bi-lock" style="font-size: 1.2rem"></i></button>';
                    }
                    echo '<button class="btn btn-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#suppression'.$pseudo[$i].'"><i class="bi-x-lg" style="font-size: 1.2rem"></i></button>
                  </td>
                </tr>

                <div class="modal fade popup" id="suppression'.$pseudo[$i].'" tabindex="-1" aria-labelledby="suppressionLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="suppressionLabel">Suppression</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        Etes-vous sûr de supprimer cet utilisateur de la base de donnée ? Cet action est irréversible !
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <a type="button" class="btn btn-danger" href="verification_modification.php?delete='.$pseudo[$i].'">Supprimer</a>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="modal fade popup" id="bannir'.$pseudo[$i].'" tabindex="-1" aria-labelledby="suppressionLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="suppressionLabel">Bannissement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">';
                        if ($type[$i] == 2) {
                          echo 'Souhaitez vous débannir cet utilisateur ?';
                        } else {
                          echo 'Souhaitez vous bannir cet utilisateur ?';
                        }
                      echo '</div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <a type="button" class="btn btn-warning" href="verification_modification.php?ban='.$pseudo[$i].'">';
                        if ($type[$i] == 2) {
                          echo 'Débannir';
                        } else {
                          echo 'Bannir';
                        }
                        echo '</a>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="modal fade popup" id="Edition'.$pseudo[$i].'" tabindex="-1" aria-labelledby="editionLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="editionLabel">Edition</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="verification_modification.php?modify='.$pseudo[$i].'" method="post" enctype="multipart/form-data">

                          <div class="mb-3">
                            <label for="pseudo" class="form-label">Pseudo</label>
                            <input type="text" name="pseudo" class="form-control" id="email" placeholder="" value="" required>
                            <div id="emailHelp" class="form-text">Entre 3 et 14 caractères.</div>
                          </div>

                          <div class="mb-3">
                            <label for="email" class="form-label">Type</label>
                            <select class="form-select" name="type" aria-label="Default select example">
                              <option value="utilisateur">Utilisateur</option>
                              <option value="admin">Admin</option>
                            </select>
                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Sauvegarder</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>';
              }
              ?>

            </tbody>
          </table>

          <?php include "includes/messageErreur.php" ?>

        </div>
      </div>
    </main>
    <footer><?php include "includes/footer.php" ?></footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
