<meta charset="utf-8">
<?php include "includes/head.php" ?>
<title>Ajout Tournoi</title>
</head>
<body>
<?php include "includes/header.php" ?>

<main class="container p-5">
  <br>
  <div>
    <form action="verification_tournoi.php" method="POST" enctype="multipart/form-data">

      <div class="mb-3">
        <label for="nom_du_jeux" class="form-label">Nom du Tournoi / (jeux)</label>
        <input type="text" name="nom_du_jeux" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="nombre_participant" class="form-label">Nombre de participant maximun</label>
        <input type="number" name="nombre_participant" class="form-control" required>
      </div>

      <div class="form-group mb-3">
        <label for="description">Regle du Tournoi</label>
        <textarea name="description" class="form-control" rows="10"></textarea>
      </div>

      <div class="mb-3">
        <label for="recompense" class="form-label">Recompense</label>
        <input type="text" name="recompense" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="imagePrincipale" class="form-label"><h4>Image principale</h4></label>
        <input class="form-control" name="imagePrincipale" type="file" accept="image/jpeg" required>
      </div>

      <div class="mb-3">
        <label for="date_de_depart" class="form-label"><h4>Date de demarrage</h4></label>
        <input type="date" name="date_de_depart" class="form-control" placeholder="11/04/2021" value="" required>
        <div class="form-text">Format: Jour/Mois/Année , JJ/MM/AA.</div>
      </div>
      <div class="mb-3">
        <label for="duree" class="form-label"><h4>Date de fin</h4></label>
        <input type="date" name="duree" class="form-control" placeholder="11/04/2021" value="" required>
        <div class="form-text">Format: Jour/Mois/Année , JJ/MM/AA.</div>
      </div>

      <button type="submit" class="btn btn-primary btn-lg">Valider</button>
    </form>

    <?php include "includes/messageErreur.php" ?>

  </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
