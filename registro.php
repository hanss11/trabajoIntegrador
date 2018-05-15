#prohibido cristians y nicos!!!! FUERA DE NUESTRO CODIGO!

<?php

$errorName = $errorMail = $errorPass= $mail = $pass = $name = '';

if($_POST) {
  $name=trim($_POST['name']);
  $pass=trim($_POST['pass']);
  $mail=trim($_POST['mail']);

   if($name=='') {
       $errorName='El campo es obligatorio';
   }

   if($mail=='') {
      $errorMail='El mail es obligatorio';
   }

   if($pass==''){
     $errorPass='La contraseña es obligatoria';

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



$array=[
  'name' => $name,
  'pass' => $pass,
  'mail' => $mail
];


$json=json_encode($array);

$archivo='datauser.txt';
file_put_contents($archivo, $json. PHP_EOL, FILE_APPEND);

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
            <a href="index.html"> <img src="./images/logo.png" alt=""></a>
            <p>¡Unite a la comunidad!</p>
            <form class="form" action="registro.php" method="post" enctype="multipart/form-data">
              <input type="text" name="name"  placeholder="Usuario" value="<?php echo $name; ?>"> <span> <?php  echo $errorName; ?></span>
              <input type="email" name="mail"  placeholder="Email" value="<?php echo $mail; ?>"> <span> <?php echo $errorMail; ?></span>
              <input type="password" name="pass"  placeholder="Contraseña" value="<?php echo $pass; ?>"> <span> <?php echo $errorPass; ?></span>
              <input type="file" name="photo" value="">
              <input id="registro" type="submit" name="" value="REGISTRATE">
              <a href="Login.html"> <p>Ya tenes cuenta?</p></a>
          </form>
        </div>
    </div>
  </body>  
</html>

