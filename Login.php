<?php
require_once('funciones.php');

$errorUser = $errorPass = $user = $pass = '';

if($_POST) {
   $user=trim($_POST['user']);
   $pass=trim($_POST['pass']);

$countError=[];
if($user=='') {
   $errorUser='Debe ingresar su usuario'
   #$countError[]= 'error';
 }elseif (verificaUser($user)) {
   $errorUser='Usuario incorrecto'
 }


if($pass=='') {
   $errorPass='Debe ingresar su contraseña'
   #$countError[]= 'error';
}elseif (verificaPassword($pass)) {
   $errorPass='Contraseña incorrecta'
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
     <div class="form-group ">
       <input type="text" name="user" class="form-control" placeholder="Usuario " id="UserName" value="<?php echo $user; ?>"><span class="errorstyle" <?php echo $errorUser ?>></span>
       <i class="fa fa-user"></i>
     </div>
     <div class="form-group log-status">
       <input type="password" name="pass" class="form-control" placeholder="Contraseña" id="Passwod" value="<?php echo $pass; ?>"><span class="errorstyle" <?php echo $errorPass ?>></span>
       <i class="fa fa-lock"></i>
     </div>
      <span class="alert">Hey! Bebiste demasiado ; )</span>
      <label class="conect" ><input  type="checkbox" name="Conectado" value="conectado"> <p>Mantener Conectado</p></label>
      <a class="link" href="#">Olvidaste Tu contraseña?</a>
     <button type="button" class="log-btn" >Entrar</button>

   </div>

<!--  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script  src="js/index.js"></script>-->


 </form>
</body>

</html>
