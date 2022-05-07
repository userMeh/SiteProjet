<?php

include "includes/bdd.php";

if(isset($_GET['cle'])){
  $cle = $_GET['cle'];

  $query = $bdd -> prepare('SELECT pseudo FROM UTILISATEURS WHERE cle_verif=:cle_verif');
  $query -> execute([
    'cle_verif' => $cle
  ]);

  $exist = $query->fetchAll();
  if(count($exist) != 1 ){
    $message="Erreur lors de l'inscription";
    header('location:inscription.php?message='.$message);
    exit;
  } else {
    $query = $bdd -> prepare('SELECT verifie FROM UTILISATEURS WHERE cle_verif=:cle_verif');
    $query -> execute([
      'cle_verif' => $cle
    ]);

    $verifie = $query -> fetchAll(PDO::FETCH_COLUMN);
    if($verifie[0]!='non'){
      $message="Votre compte est déjà verifié";
      header('location:inscription.php?message='.$message);
      exit;
    } else {
      $bdd -> query('UPDATE UTILISATEURS SET verifie="oui" WHERE cle_verif="'.$cle.'"');
      $message="succès compte 2";
      header('location:inscription.php?message='.$message);
      exit;
    }
  }
}

if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
  $message="Votre email n'est pas valide";
  header('location:inscription.php?message='.$message);
  exit;

} else {
  if (strlen($_POST['pseudo']) >= 3 && strlen($_POST['pseudo']) <= 14) {
    $doublon=$bdd->prepare('SELECT pseudo FROM UTILISATEURS WHERE pseudo=?');
    $doublon->execute([
      $_POST['pseudo']
    ]);

    $result=$doublon->fetchAll(); //Recupere les utilisateurs sous forme de tableau
    if( count($result)!=0 ){      //Pour voir si le tableau est pas vide
      $message="Pseudo déjà utilisé";
      header('location:inscription.php?message='.$message);
      exit;

    }if (!isset($_POST['verifCaptcha'])) {
      $message = "Veuillez confirmer que vous êtes de la race Homo Sapiens";
      header('location:inscription.php?message='.$message);
      exit;

    } if(!isset($_POST['cgu'])){
      $message = "Veuillez acceptez les conditions générales d'utilisation";
      header('location:inscription.php?message='.$message);
      exit;
    } else {
      if (strlen($_POST['mdp']) >= 8 && strlen($_POST['mdp']) <= 20){
        $doublon=$bdd->prepare('SELECT pseudo FROM UTILISATEURS WHERE email=?');
        $doublon->execute([
          $_POST['email']
        ]);

        $result=$doublon->fetchAll(); //Recupere les utilisateurs sous forme de tableau
        if( count($result)!=0 ){      //Pour voir si le tableau est pas vide
          $message="Email déjà utilisé";
          header('location:inscription.php?message='.$message);
          exit;

        } else {
          if ($_POST['mdp'] == $_POST['confirmation']) {
            $minuscule = preg_match("#[a-z]+#", $_POST["mdp"]);
            $majuscule = preg_match("#[A-Z]+#", $_POST["mdp"]);
            $chiffre = preg_match("#[0-9]+#", $_POST["mdp"]);
            $special = preg_match("/[\[^\'£$%^&*()}{@:\'#~?><>,;@\|\\\-=\-_+\-¬\`\]]/", $_POST["mdp"]);

            if($minuscule == 1 || $majuscule == 1 && $chiffre == 1 && $special != 1){

              date_default_timezone_set('Europe/Paris');
              $date_creation = date('d/m/Y, H:i:s');
              $vCle = md5(time().$_POST['pseudo']);

              $request=$bdd->prepare('INSERT INTO UTILISATEURS(pseudo, email, mdp, prix, type, date_creation, verifie, cle_verif) VALUES (:pseudo, :email, :mdp, :prix, :type, :date_creation, :verifie, :cle_verif)');
              $result=$request->execute([
                'pseudo' => $_POST['pseudo'],
                'email' => $_POST['email'],
                'mdp' => hash('sha512', $_POST['mdp']),
                'prix' => 0,
                'type' => 0,
                'date_creation' => $date_creation,
                'verifie' => 'non',
                'cle_verif' => $vCle
              ]);

              $query = $bdd -> query('SELECT id FROM AVATAR ORDER BY id DESC');
              $verif = $query -> fetchAll(PDO::FETCH_COLUMN);
              if (!$verif) {
                $id = 0;
              } else {
                $id = $verif[0]+1;
              }

              $request=$bdd->prepare('INSERT INTO AVATAR(id, email, id_yeux, id_barbe, id_sourcil, id_cheveux, id_bouche, id_visage) VALUES (:id, :email, :id_yeux, :id_barbe, :id_sourcil, :id_cheveux, :id_bouche, :id_visage)');
              $result=$request->execute([
                'id' => $id,
                'email' => $_POST['email'],
                'id_yeux' => 1,
                'id_sourcil' => 1,
                'id_cheveux' => 1
                'id_bouche' => 1,
                'id_sourcil' => 1,
                'id_visage' => 1
              ]);

              include "includes/mail.php";

              if($result){
                $message="succès compte 1";
                header('location:inscription.php?message='.$message);
                exit;
              } else {
                $message="Erreur lors de l'inscription";
                header('location:inscription.php?message='.$message);
                exit;
              }

            } else {
              $message="Le mot de passe doit contenir au moins une lettre et un chiffre";
              header('location:inscription.php?message='.$message);
              exit;
            }

          } else {
            $message="Les 2 mots de passe ne correspondent pas";
            header('location:inscription.php?message='.$message);
            exit;
          }
        }
      } else {
        $message="Le mot de passe doit contenir entre 8 et 20 caractères";
        header('location:inscription.php?message='.$message);
        exit;
      }
    }
  } else {
    $message="Le pseudo doit contenir entre 3 et 14 caractères";
    header('location:inscription.php?message='.$message);
    exit;
  }
}
$message="Y'a eu un probleme";
header('location:inscription.php?message='.$message);
exit;

?>
