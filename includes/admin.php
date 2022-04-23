<?php
if (!isset($_SESSION['compte'])){
  header("location:index.php");
} else {
  $query = $bdd -> query('SELECT type FROM UTILISATEURS WHERE email="'.$_SESSION['compte'].'"');
  $type = $query -> fetchAll(PDO::FETCH_COLUMN);
  if ($type[0] != 1) {
    header("location:index.php");
  }
}
?>
