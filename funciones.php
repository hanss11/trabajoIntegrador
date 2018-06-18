<?php

#Obtenemos los datos del Json
function decode(){
    $UserJSON = file_get_contents('datauser.txt');
    $usersArray = explode(PHP_EOL, $UserJSON);
    array_pop($usersArray);
    $UsersDecode = [];
    foreach ($usersArray as $unUsuario) {
        $UsersDecode[] = json_decode($unUsuario, true);
    }
    return $UsersDecode;
}
#Recorre el array que hicimos decode, y verifica si existe un mail.
function verificaMail($mail){
  $todos = decode();
   foreach ($todos as $Usuario) {
     if ($Usuario['mail'] == $mail) {
         return $Usuario;
     }
    }
   return false;
}
#crea un nuevo ID
function ID(){
    $lista = decode();
    if (count($lista) == 0) {
        return 1;
    }
    $usuarioFinal = array_pop($lista);
    $ultimoID = $usuarioFinal['ID'];
    return $ultimoID + 1;
}
#se guarda y mueve la imagen a la carpeta img
function guardaPerfil($imagen){
    if ($_FILES[$imagen]['error'] == UPLOAD_ERR_OK) {
        $nombreArchivo = $_FILES[$imagen]['name'];
        $ext = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
        $archivoFisico = $_FILES[$imagen]['tmp_name'];
        if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'JPG') {
            $dondeEstoyParado = dirname(__FILE__);
            $rutaFinalConNombre = $dondeEstoyParado . '/img/'. $_POST['mail'] . '.' . $ext;
            move_uploaded_file($archivoFisico, $rutaFinalConNombre);
        }
    }
}



#Verifica si el usuario es correcto.
/* correcion de Juan Carlos, no se usa
function verificaUser($user){
  $todos = decode();
   foreach ($todos as $Usuario) {
     if ($Usuario['name'] == $user) {
         return $Usuario;
     }
    }
   return false;
}*/


#Verifica si la contraseña es correcta.
function verificaPassword($pass){
  $todos = decode();
   foreach ($todos as $Password) {
     if ($Password['pass'] == $pass) {
         return $Password;
     }
    }
   return false;
}

#Verifica el par de datos
function verificaCredenciales($user, $pass){
  $todos = decode();
   foreach ($todos as $Usuario) {
     if (($Usuario['name'] == $user) && ($Usuario['pass'] == $pass)) {
         return $Usuario;
     }
    }
   return false;
}

function loguear($user){
    $_SESSION['ID'] = $user['ID'];
    $_SESSION['name'] = $user['name'];
    $_SESSION['profile']  = $user['profile'];
}

function estaLogueado(){
  return isset ($_SESSION['ID']) ;

}

function conectar(){
$dsn = 'mysql:dbname=MySQL;host=127.0.0.1';
$UserDB = 'root';
$PassDB = '';

try {
    $gbd = new PDO($dsn, $UserDB, $PassDB);
    echo "entre en try, me conecte al MySql Local   ";
} catch (PDOException $e) {
    echo 'Falló la conexión: ' . $e->getMessage();
}

$gsent = $gbd->prepare("insert into proyecto.usuarios values ('1','asda','123@gmail.com','asda','1','1');");
$gsent->execute();
$results=$gsent->(PDO::FETCH_ASSOC);
echo "esto es gsent -->";
var_dump ($gsent);
$row= $gsent->rowcount();
echo "esto es row -->";
var_dump ($row);
echo "esto es results -->";
var_dump ($results);
//echo "esto es gbd -->";
//var_dump ($gbd);
//echo "esto es gsent -->";
//var_dump ($gsent);

}

function altaUser(){
//   conectar($gbd);

//   $gsent = $gbd->prepare("insert into proyecto.usuarios values ('2','asda','123@gmail.com','asda','1','1');");
//   $gsent->execute();

///   $row= $gsent->rowcount();
//   echo "esto es row -->";
///   var_dump ($row);

}
 ?>
