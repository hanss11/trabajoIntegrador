<?php
require_once('funciones.php');
require_once('autoload.php');
use beers\models\User;
use beers\models\auth;
use beers\Repositorio\mysql;
use beers\models\validate;
 /* Verifico que el usuario no este logueado en caso que si lo este
 lo dirijo a la pagina principal y corto la ejecución del codigo */
 if (Auth::verificarLogueo()) {
     header('Location:homepage.php');
     exit;
 }
 $email= '';
 if ($_POST){
 $validacion= new validate($_POST);
 $errores = $validacion->validarLogin();
 $repositorio= new mysql();
 $email = trim($_POST['user']); //elimina los espacios del nombre de usuario recbida
   if ($errores === []) {
 			$usuario = $repositorio->existeEmail($email);
 			if (isset($_POST["recordar"])) {
 	        setcookie('id', $usuario['id'], time() + 3600 * 24 * 30);
 	      }
         $usuarioObj = new User($usuario['email'],$usuario['pass'],$usuario['name'],$usuario['foto_perfil']);
         Auth::loguearInicio($usuarioObj);
 		}
 	}
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
      <span class="errorstyle"> <?php if (isset($errores['email'])): ?></span>
        <?php endif; ?>
     <div class="form-group ">

       <input type="text" name="user" class="form-control" placeholder="Email " id="UserName" value="<?php echo $email;  ?>">
       <i class="fa fa-user"></i>
     </div>
      <span class="errorstyle"> <?php if (isset($errores['pass'])): ?></span>
        <?php endif; ?>
     <div class="form-group log-status">
       <input type="password" name="pass" class="form-control" placeholder="Contraseña" id="Passwod" value="">
       <i class="fa fa-lock"></i>
     </div>
      <span class="alert">Hey! Bebiste demasiado ; )</span>
      <label class="conect" ><input  type="checkbox" name="Conectado" value="conectado"> <p>Mantener Conectado</p></label>
      <a class="link" href="#">Olvidaste Tu contraseña?</a>
     <button type="submit" class="log-btn" >Entrar</button>


   </div>

<!--  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script  src="js/index.js"></script>-->


 </form>
</body>

</html>
