#prohibido cristians y nicos!!!! FUERA DE NUESTRO CODIGO!

#Advertencia: si usted se chorea este codigo recibira un muletaso. atte: el rey del ping pong

<?php
require_once('funciones.php');

$errorName = $errorMail = $errorPass= $mail = $pass = $name = '';

if($_POST) {
  $name=trim($_POST['name']);
  $pass=trim($_POST['pass']);
  $mail=trim($_POST['mail']);
#creamos los errores y un contador de errores
   $countError=[];
   if($name=='') {
       $errorName='Elige un nombre de usuario';
       $countError[] = 'error';
   }
   if($mail=='') {
      $errorMail='El mail es obligatorio';
      $countError[] = 'error';
   }elseif (verificaMail($mail)) {
     $errorMail='Ya existe una cuenta con su email';
   }
   if($pass==''){
     $errorPass='La contraseña es obligatoria';
     $countError[] = 'error';
   }


   #crea usuario
   $array=[
     'name' => $name,
     'pass' => $pass,
     'mail' => $mail,
     'ID' => ID(),
     "profile" => 'img/' . $mail. '.' . pathinfo($_FILES['avatar']['name'],PATHINFO_EXTENSION)
   ];
#si el contador de errores es 0 y el mail no se encuentra en la base de datos
#se procedera a escribir en el JSON la informacion del usuario
if (verificaMail($mail) != true && empty($countError)){
  guardaperfil('avatar');
  $json=json_encode($array);
  $archivo='datauser.txt';
  file_put_contents($archivo, $json. PHP_EOL, FILE_APPEND);
  header('Location: homepage.php');
}





// if($_FILES[$archivo]['error'] !=UPLOAD_ERR_OKK) { $arrayADevolver['avatar'] ="Necesita subir una foto"; } //
// if
// $ext = pathinfo($nombreArchivo, PATHINFO_EXTENSION); //
// $dondeEstoyParado = dirname(__FILE__);
// $rutaFinalConNombre = $dondeEstoyParado. '/img/'. $_POST['email']. '.'. $ext; //
// move_uploaded_file($archivoFisico, $rutaFinalConNombre); //
//EXISTE MAIL//
  //function existeMail($mail) {
  //$todos = traerTodos();//
  //foreach($todos as $unUsuario){
   //if($unUsuario)......//
//}
//TRAER TODOS//
  //$todosJSON = file_get_contents('usuarios.json')
  //$usuarioArray = explode(PHP_EOL, $tdosJSON)//
  //$todosPHP=[];
  //foreach($usuariosARRay as $unUsuario) {
    //$todosPHP[] = json_decode($unUsuario, true);
  //}
  //retur $todosPHP;//
  //
  //TRAER ULTIMO ID//
  //function traerUltimolID() {
  //$todos = traerTdoso();
  //if (count($todos) == 0) {
  //  return 1;
  //}
  //$ultuimoUsuario = array_pop($todos;);
  //$ultimoID = $ultimoUsuario['id'];
  //return $ultimoID +1;
//}

#crea usuario

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
            <form class="form" action="registro.php" method="post" enctype="multipart/form-data">
              <input type="text" name="name" autofocus placeholder="Usuario" value="<?php echo $name; ?>"> <span class="errorstyle"> <?php  echo $errorName; ?></span>
              <input type="email" name="mail"  placeholder="Email" value="<?php echo $mail; ?>"> <span class="errorstyle"> <?php echo $errorMail; ?></span>
              <input type="password" name="pass"  placeholder="Contraseña" value="<?php echo $pass; ?>"> <span class="errorstyle"> <?php echo $errorPass; ?></span>
              <label> <p>Foto de perfil</p> <input id="regAvatar" type="file" name="avatar" value=""></label>

              <input id="registro" type="submit" name="" value="REGISTRATE">
              <a href="Login.php"> <p>Ya tenes cuenta?</p></a>
          </form>
        </div>
    </div>
  </body>
</html>
