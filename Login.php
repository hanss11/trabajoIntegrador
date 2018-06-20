<?php
namespace repositorio;

session_start();
require_once('funciones.php');



if (estaLogueado()) {
    header('location:homepage.php');
    exit;
}

$errorUser = $errorPass = $user = $pass = $noValido = '';

if($_POST) {
   $user=trim($_POST['user']);
   $pass=trim($_POST['pass']);

  $countError=0;
  if($user=='') {
     $errorUser='Debe ingresar su usuario';
     $countError++;
   }

  if($pass=='') {
     $errorPass='Debe ingresar su contraseña';
     $countError++;
  }
   if (($countError)==0 && ($usuario = verificaCredenciales($user,$pass))) {
     echo "Listo! ";
     loguear($usuario);
     if ($_POST['conectado']) {
           setcookie('id', $usuario['id'], time() + 3600 );
       }

     header('Location:homepage.php');
      exit;
  /*   var_dump($usuario);
     echo '<br>';
     var_dump($countError);
     var_dump($_SESSION);
  */
} elseif(($countError)==0 && (verificaCredenciales($user,$pass) == false)){
          $noValido = 'El correo electrónico y la contraseña que ingresaste no coinciden con nuestros registros. Por favor, revisa e inténtalo de nuevo.';
      }
}
/*
var_dump($user);
var_dump($pass);
var_dump($errorUser);
var_dump($errorPass);
echo 'count errororo please!';
var_dump($countError);
//var_dump($usuario);*/
 ?>






<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Beers Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
      <link rel="stylesheet" href="./css/style2.css">
</head>
<body>
  <form class="" action="#" method="post">

  <div class="login-form">
     <a id="titulo" href="index.php"><h1>Beers</h1></a>
      <span class="errorstyle"> <?php  echo $errorUser; ?></span>
     <div class="form-group ">

       <input type="text" name="user" class="form-control" placeholder="Usuario " id="UserName" value="<?php echo $user; ?>">
       <i class="fa fa-user"></i>
     </div>
      <span class="errorstyle"> <?php echo $errorPass; ?></span>
     <div class="form-group log-status">
       <input type="password" name="pass" class="form-control" placeholder="Contraseña" id="Passwod" value="">
       <i class="fa fa-lock"></i>
     </div>
      <span class="alert">Hey! Bebiste demasiado ; )</span>
      <label class="conect" ><input  type="checkbox" name="Conectado" value="conectado"> <p>Mantener Conectado</p></label>
      <a class="link" href="#">Olvidaste Tu contraseña?</a>
     <button type="submit" class="log-btn" >Entrar</button>

     <span class="errorstyle"> <?php echo $noValido; ?> </span>

   </div>

<!--  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script  src="js/index.js"></script>-->


 </form>
</body>

</html>
