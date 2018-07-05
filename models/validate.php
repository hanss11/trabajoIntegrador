<?php
namespace beers\models;
use beers\repositorio\mysql;
class Validate
 {
  private $datosPost;
  function __construct($datos)
  {
    $this->datosPost= $datos;
  }
  public function validarLogin(){
    $devolucionDeDatos =[];
    $repositorio= new mysql();

    $usuario= trim($this->datosPost['user']);
    $pass = trim($this->datosPost['pass']);
    if ($usuario ==''){
          $devolucionDeDatos['email'] = 'Ingrese su Email';
        }
        if (!filter_var($usuario, FILTER_VALIDATE_EMAIL)){
          $devolucionDeDatos['email']= 'Ingrese correctamente su email';
        }
        if (!$repositorio->existeEmail($usuario)) {
      $devolucionDeDatos['email'] = 'Email no registrado';
    }
        $passHasheado = $repositorio->existeEmail($usuario);
        $passHasheado = $passHasheado['pass'];
        if (password_verify($pass, $passHasheado) === false) {
          $devolucionDeDatos['pass'] = "La contraseña no es correcta";
        }
    return $devolucionDeDatos;
}
  public function validarRegistro() {
    $errores = [];
    $repositorio= new mysql();
    $usuario = trim($this->datosPost['name']);
    $email = trim($this->datosPost['email']);
    $pass = trim($this->datosPost['pass']);
      if ($usuario == '') {
       $errores['name'] = "Completa el campo nombre";
     } elseif ($repositorio->existeUsuario($usuario)) {
       $errores['name'] = "Este usuario ya existe.";
     }
      if ($email == '') {
       $errores['email'] = "Completa tu email";
      } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $errores['email'] = "Por favor poner un email existente.";
      } elseif ($repositorio->existeEmail($email)) {
       $errores['email'] = "Este email ya existe.";
     }
      if ($pass == '') {
       $errores['pass'] = "Por favor completa tu contraseña";
     }
       return $errores;
      }
}
 ?>
