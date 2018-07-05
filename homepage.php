
 <?php
require_once('autoload.php');
use beers\models\auth;
use beers\repositorio\mysql;
if (!Auth::verificarLogueo()){
    header('Location:login.php');
    exit;
}
$repositorio = new mysql;
$user= $_SESSION['usuario'];
$nombreDeUsuario = $user;
$nombreDeProfile = $repositorio->existeUsuario($user);
$nombreDeProfile= $nombreDeProfile['avatar'];

?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="./css/styles.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <title>Beers</title>
  </head>

  <body>
<?php include('header.php') ?>
    <div class="page">
      <div class="homecontent">
        <div class="card"></div>
        <div class="card"></div>
        <div class="card"></div>
        <div class="card"></div>
      </div>

    </div>

  </body>
</html>
