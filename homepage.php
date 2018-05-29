<?php
session_start(); 
require_once('funciones.php');
echo '<br><br><br><br><br><br><br>';

var_dump($_SESSION);


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
    <div class="BGHomepage">
      <div class="stickyBar">
      <div class="globalNav">
        <div class="colorNav">
          <div class="navContain">
              <div class="ProfilePhoto">
              </div>
              <i class="flecha fas fa-angle-down"></i>
              <div class="NavigationBar">
                <ul class="ulNavBar">
                  <li><i class="noti fas fa-envelope"></i></li>
                  <li><i class="noti fas fa-bell"></i></li>
                </ul>
              </div>


              <div class="NavigationBar">
                <ul class="ulNavBar">
                  <li class="liNavBar"> <a href=""><span class="textnav"> HOME</span> </a> </li>
                  <li class="liNavBar"> <a href="#"> <span class="textnav"> MOMENTS</span> </a> </li>
                </ul>
              </div>

              <div class="boxsearch">
                <div class="container-1">
                  <span class="busca" ><i class="fas fa-search"></i></span>
                  <input type="search" id="search" placeholder="Buscar" />
                </div>
              </div>

              <div class="newpost">
                <a href="#"><i class="mas fas fa-plus"></i><span>NEW</span> </a>
              </div>
          </div>
        </div>
      </div>
    </div>
    <div class="page">
      <div class="homecontent">
        <div class="card"></div>
        <div class="card"></div>
        <div class="card"></div>
        <div class="card"></div>
      </div>

    </div>
    </div>
  </body>
</html>
