<?php
namespace beers\repositorio;
use beers\models\user;
use PDO;
class mysql {
  private $host = 'mysql:host=127.0.0.1;dbname=beers';
  private $conex;
  private $dbuser = 'root';
  private $dbpass = 'root';
  public function __construct() {
    $this->conex = new PDO($this->host, $this->dbuser,  $this->dbpass,
      [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
  }
  public function guardarUsuario(Usuario $usuario) {
    $stmt = $this->conex->prepare("INSERT INTO usuarios (nombre, apellido, usuario, email, pass, nacimiento, foto_perfil)
    VALUES (:name,:email,:pass,:avatar)");
    $stmt->bindValue(':name', $usuario->getUsuario());
    $stmt->bindValue(':email', $usuario->getEmail());
    $stmt->bindValue(':pass', $usuario->passwordHash($usuario->getPass()));
    $stmt->bindValue(':avatar', $usuario->getAvatar()??"img/avatar.png" );
    $stmt->execute();
  }
  public function traerTodos() {
    $stmt = $this->conex->prepare("SELECT * FROM usuarios");
    $stmt->execute();
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
  }
  public function existeEmail($email) {
    $stmt = $this->conex->prepare("SELECT * FROM usuarios WHERE email=:email");
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($results) {
      return $results;
    }
  }
  public function traerPorId($id) {
    $stmt = $this->conex->prepare("SELECT * FROM usuarios WHERE id=:id");
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($results) {
      return $results;
    }
  }
  public function existeUsuario($usuario) {
    $stmt = $this->conex->prepare("SELECT * FROM usuarios WHERE usuario=:usuario");
    $stmt->bindValue(':usuario', $usuario);
    $stmt->execute();
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($results) {
      return $results;
    }
  }
}
 ?>
