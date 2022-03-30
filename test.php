<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Test</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css et js/style.css">
</head>

<body>
  

  <?php include "includes/header.php" ?>

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
              <a href="modification.php?='.$pseudo[$i].'/modify" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Editer</a>
              <a href="modification.php?='.$pseudo[$i].'/delete" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Supprimer</a>
            </td>
          </tr>';
        }
        ?>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                ...
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>

      </tbody>
    </table>

  </div>

  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
  </button>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
