<?php
namespace beers\models;
class User {
  private $id;
  private $email;
  private $usuario;
  private $pass;
  private $avatar;
  public function __construct($email, $usuario, $pass, $avatar) {
    $this->id = '';
    $this->setEmail($email);
    $this->setUsuario($usuario);
    $this->setPass($pass);
    $this->setAvatar($avatar);
  }
  public function passwordHash($pass){
    $passHasheado = password_hash($pass, PASSWORD_DEFAULT);
    return $passHasheado;
  }
    public function getID() {
      return $this->id;
    }
    public function setPass($pass) {
      $this->pass = $pass;
    }
    public function getPass() {
      return $this->pass;
    }
    public function setEmail($email) {
      $this->email = $email;
    }
    public function getEmail() {
      return $this->email;
    }
    public function setAvatar($avatar) {
      $this->avatar = $avatar;
    }
    public function getAvatar() {
      return $this->avatar;
    }
    public function setUsuario($usuario) {
      $this->usuario = $usuario;
    }
    public function getUsuario() {
      return $this->usuario;
    }
}
 ?>
