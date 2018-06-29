<?php
class BaseDeDatos {
  private $user;
  private $pass;
  public function __construct($user, $pass) {
    $this->setUser($user);
    $this->setPass($pass);
  }
  public function setUser($user) {
    $this->user = $user;
  }
  public function setPass($pass) {
    $this->pass = $pass;
  }
  public function getUser(){
    return $this->user;
  }
  public function getPass(){
    return $this->pass;
  }
  public function crear() {
    try {
      $opt = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
      $baseDatos = new PDO('mysql:host=127.0.0.1', $this->getUser(), $this->getPass());
      $query = $baseDatos->query('CREATE DATABASE Beers');
      $query = $baseDatos->query('USE Beers');
      $query = $baseDatos->query('CREATE TABLE usuarios (
        id INT(11) NOT NULL auto_increment primary KEY,
        nombre varchar(100),
        email varchar(100) unique NOT NULL,
        pass varchar(100),
        foto_perfil varchar(200) DEFAULT "img/avatar.png"
      )');
      $query = $baseDatos->query('CREATE TABLE posteos (
		    id INT(11) NOT NULL auto_increment primary KEY,
        id_usuario INT(11),
        imagen varchar(100),
        posteo varchar(300),
        id_categoria varchar(100),
        me_gusta INT(11),
        comentarios varchar(200),
        fecha DATE
      )');
      $query = $baseDatos->query('CREATE TABLE categoria_post (
		id INT(11) NOT NULL auto_increment primary KEY,
        nombre varchar(100)
      )');
      $query = $baseDatos->query('CREATE TABLE amistades (
		     id INT(11) NOT NULL auto_increment primary KEY,
        id_usuario INT(11),
        id_amigo INT(11)
      )');
      $query->execute();
    } catch (PDOEXCEPTION $exc) {
      echo $exc->getMessage();
    }
  }
}
?>
