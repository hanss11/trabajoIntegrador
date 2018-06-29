<?php
namespace beers\models;
use beers\models\user;
abstract class Auth {
  public function loguearPerfil(Usuario $usuario) {
    session_start();
    $_SESSION['usuario'] = $usuario->getUsuario();
     header('location:perfil.php');
     exit;
  }
  public function loguearInicio(Usuario $usuario) {
    session_start();
    $_SESSION['usuario'] = $usuario->getUsuario();
     header('location:homepage.php');
     exit;
  }
  public function desloguear() {
    setcookie('id', '', -10);
    session_destroy();
    header('location:index.php');
  }
  public function verificarLogueo(){
    session_start();
      return isset($_SESSION['usuario']);
  }
  public function estaLogueado() {
    session_start();
  return isset($_SESSION['usuario']);
  }
}
?>
