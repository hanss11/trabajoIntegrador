<?php
session_start();
require_once('funciones.php');

if (!estaLogueado()) {
    header('location:login.php');
    exit;
}
/*echo '<br><br><br><br><br><br><br>';

var_dump($_SESSION);

*/
 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="./css/styles.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <title>Perfil</title>
  </head>
  <body>
    <?php include('header.php') ?>

    <div class="page">
      <div class="profilecard">

        <div class="profileportada">
          <div class="imageprofilecard">
            <img src="./images/newyork.jpg" alt="">
          </div>
          <div class="cardAvatar">
            <img src="<?php echo './'. $_SESSION['profile']; ?>" alt="">
          </div>
          <span>  <?php echo ucwords($_SESSION['name']); ?> </span>
        </div>

        <div class="interactiveProfile">
          <a href="#"> <i class="friend fas fa-user-friends"></i><span>200</span></a>

          <a href="#"><i class="star fas fa-star"></i><span>542</span></a>

          <a href="#"><i class="heart fas fa-heart"></i><span>843</span></a>
        </div>

      </div>
    </div>
  </body>
</html>
