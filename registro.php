
<?php
require_once('funciones.php');
require_once('autoload.php');
use beers\models\User;
use beers\models\auth;
use beers\Repositorio\mysql;
use beers\models\validate;
if (auth::verificarLogueo()) {
    header('Location:homepage.php');
    exit;
}
$user = $email = $pass= '';
if ($_POST) {
  $user = trim($_POST['name']);
  $email = trim($_POST['email']);
  $pass= trim($_POST['pass']);
  $errores = new validate($_POST);
  $errores = $errores->validarRegistro();
  $usuario = new User($email,$user,$pass,guardaPerfil('avatar'));
  $repositorio= new mysql();
if ($errores === []) {
  $repositorio->guardarUsuario($usuario);
  Auth::loguearPerfil($usuario);
}
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="./css/styles.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Beers</title>
  </head>
  <body>
    <div class="contain">
        <div class="register">
            <a href="index.php"> <img src="./images/logo.png" alt=""></a>
            <p>¡Unite a la comunidad!</p>
            <form class="form" action="" method="POST" enctype="multipart/form-data">
              <input type="text" name="name" autofocus placeholder="Usuario" value="<?php echo $user; ?>"> <span class="errorstyle"> <?php if (isset($errores['name'])):
      echo $errores['name'];
    else: echo '';
    endif; ?></span>
              <input type="email" name="email"  placeholder="Email" value="<?php echo $email; ?>"> <span class="errorstyle"> <?php if (isset($errores['email'])):
  echo $errores['email'];
else: echo '';
endif; ?></span>
              <input type="password" name="pass"  placeholder="Contraseña" value="<?php echo $pass; ?>"> <span class="errorstyle"> <?php if (isset($errores['pass'])):
    echo $errores['pass'];
  else: echo '';
  endif; ?></span>
              <label> <p>Foto de perfil</p> <input id="regAvatar" type="file" name="avatar" value=""></label>

              <input id="registro" type="submit" name="" value="REGISTRATE">
              <a href="Login.php"> <p>Ya tenes cuenta?</p></a>
          </form>
        </div>
    </div>
  </body>
</html>
<?php
/* Conectar a una base de datos de MySQL invocando al controlador */
/* ojo! el conectar debe estar en un solo lado*/
function guardarUsuario ($name,$email,$pass,$avatar){
$dsn = 'mysql:dbname=MySQL;host=127.0.0.1';
$UserDB = 'root';
$PassDB = '';

try {
    $gbd = new PDO($dsn, $UserDB, $PassDB);
    // echo "entre en try, me conecte al MySql Local   ";
} catch (PDOException $e) {
    echo 'Falló la conexión: ' . $e->getMessage();
}

/*la columna id se genera sola por eso no esta declarado en insert*/
/*todas las personas que se resigtran son usuarios por defaul de tipo 1(uno)*/
$gsent = $gbd->prepare('INSERT INTO proyecto.usuarios(nickname,email,pass,tipoDeUsuario,avatar)
VALUES(:name,:email,:pass,1,:avatar);');
 $gsent->bindValue(':name',     $name,   PDO::PARAM_STR);
 $gsent->bindValue(':email',    $email,  PDO::PARAM_STR);
 $gsent->bindValue(':pass',     $pass,   PDO::PARAM_STR);
 $gsent->bindValue(':avatar',   $avatar, PDO::PARAM_STR);
 var_dump($gsent);
 $gsent->execute();
 $results = $gsent->fetchAll(PDO::FETCH_ASSOC);

}
?>
