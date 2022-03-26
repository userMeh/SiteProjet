<?php

include ('includes/bdd.php');

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

            $request=$bdd->prepare('INSERT INTO UTILISATEURS(pseudo, email, mdp) VALUES(:pseudo, :email, :mdp)');
            $result=$request->execute([
              'pseudo' => $_POST['pseudo'],
              'email' => $_POST['email'],
              'mdp' => hash('sha512', $_POST['mdp'])
            ]);

            if($result){
              $message="succès";
              header('location:inscription.php?message='.$message);
              exit;
            } else {
              $message="Erreur lors de l'inscription";
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
$message="Ca a merdé";
header('location:inscription.php?message='.$message);
exit;

?>
