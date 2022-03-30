<html>
  <head>
    <meta charset="utf-8">
    <?php include "includes/bootstrap.php" ?>
    <title>Liste d'utilisateurs</title>
  </head>
  <body>
    <?php include "includes/header.php" ?>

    <main class="container p-5">
      <br>
      <h2 class="d-flex justify-content-center">Liste d'utilisateurs</h2>
      <div>

        <?php
        $query = $bdd -> query('SELECT pseudo FROM UTILISATEURS');   //Compte le nombre d'utilisateurs et recupere les pseudos
        $pseudo = $query -> fetchAll(PDO::FETCH_COLUMN);
        $users = count($pseudo);

        $query = $bdd -> query('SELECT email FROM UTILISATEURS');
        $email = $query -> fetchAll(PDO::FETCH_COLUMN);

        $query = $bdd -> query('SELECT type FROM UTILISATEURS');
        $type = $query -> fetchAll(PDO::FETCH_COLUMN);

        $query = $bdd -> query('SELECT date_creation FROM UTILISATEURS');
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
            <a href="#"></a>
            <?php
            for ($i=0; $i < $users; $i++) {
              echo
              '<tr>
                <th scope="row">'.$pseudo[$i].'</th>
                <td>'.$email[$i].'</td>
                <td>'.$type[$i].'</td>
                <td>'.$date_creation[$i].'</td>
                <td>
                  <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edition'.$pseudo[$i].'">Editer</button>
                  <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#suppression'.$pseudo[$i].'">Supprimer</button>
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
                      Etes-vous sûr de supprimer cet utilisateur de la base de donnée? Cet action est irréversible !
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                      <a type="button" class="btn btn-danger" href="verification_modification.php?delete='.$pseudo[$i].'">Supprimer</a>
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
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
