<?php
/* Ojo! la funcion guardarUsuario no tiene que estar dentro de la misma pagina*/
/* Ojo! sino tiene que estar en la clase que le corresponda*/

session_start();
require_once('funciones.php');
if (estaLogueado()) {
    header('location:homepage.php');
    exit;
}

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

if (verificaMail($mail) != true && empty($countError)){
  guardaperfil('avatar');
  $json=json_encode($array);
  $archivo='datauser.txt';
  file_put_contents($archivo, $json. PHP_EOL, FILE_APPEND);
  header('Location: homepage.php');
/* insert en base de datos porque los datos estan Ok*/
/* parte nueva insert en base de datos llamo a la funcion guardarUsuario*/
/* ojo! datos duplicados ver como se hace esto mejor*/
$name1=trim($_POST['name']);
$pass1=trim($_POST['pass']);
$mail1=trim($_POST['mail']);
$avatar1= 'img/' . $mail. '.' . pathinfo($_FILES['avatar']['name'],PATHINFO_EXTENSION);
/*
echo "<br><br><br><br>";
echo "  name-->",$name1;
echo "  email-->",$mail1;
echo "  pass-->",$pass1;
echo "  avatar1-->",$avatar1;
echo "<br><br><br><br>";
echo "  post -->";
var_dump($_POST);*/
//echo "avatar",$avatar1;
guardarUsuario ($name1,$mail1,$pass1,$avatar1);
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
            <form class="form" action="registro2.php" method="POST" enctype="multipart/form-data">
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
