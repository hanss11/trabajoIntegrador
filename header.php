<?php
session_start();
 ?>
<div class="BGHomepage">
  <div class="stickyBar">
  <div class="globalNav">
    <div class="colorNav">
      <div class="navContain">
          <div class="ProfilePhoto">
            <img src="<?php echo './'. $_SESSION['profile']; ?>" alt="">
          </div>

          <div class="dropdown">
            <i class="flecha fas fa-angle-down"></i>
            <div class="dropdown-content">
              <p><a href="perfil.php"> Perfil</a></p>
              <p><a href="logout.php"> Salir</a></p>
            </div>
          </div>

          <div class="NavigationBar">
            <ul class="ulNavBar">
              <li class="notice"> <a href="#"> <i class="noti fas fa-envelope"></i></a></li>
              <li class="notice"> <a href="#"> <i class="noti fas fa-bell"></i></a> </li>
            </ul>
          </div>


          <div class="NavigationBar">
            <ul class="ulNavBar">
              <li class="liNavBar"> <a href="homepage.php"><span class="textnav"> HOME</span> </a> </li>
              <li class="liNavBar"> <a href="#"> <span class="textnav"> MOMENTS</span> </a> </li>
            </ul>
          </div>

          <div class="CenterUser">
            <a href="perfil.php"><span> <?php echo ucwords($_SESSION['name']); ?> </span></a>

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
