<?php

/* Ojo! hay que corregir el css para que el estilo quede acorde a la estetica del proyecto*/
/* Ojo! la funcion guardarUsuario no tiene que estar dentro de la misma pagina*/
/* Ojo! sino tiene que estar en la clase que le corresponda*/
/* Ojo! falta adecuar toda la pagina registro con este feature*/

$name='';
$email='';
$avatar='';

if($_POST){
  $name=$_POST['name'];
  $email=$_POST['email'];
  $password=$_POST['password'];
  $avatar=$_POST['avatar'];
  $error = [];
  if (!$name)    {
      $error['name'] = "   Es obligatorio que informes tu Nombre y no pueder estar duplicado \n";
  }

  if (!$email) {
    $error['email'] = "   Es obligatorio que informes tu Email y no puede estar duplicado \n";
  }

  if (!$password) {
    $error['password'] = "   Es obligatorio que informes tu Password \n";
  }
  if (!$avatar) {
    $error['avatar'] = "   Es obligatorio que informes tu Usuario \n";
  }

  if($error){
    foreach ($error as $value) {
      echo $value;
    }
  } else  {
    // insert en base de datos porque los datos estan Ok
    // var_dump($_POST);
    echo "<label> Base de datos del Proyecto, Insert del registro con exito exito</label><br><br>";

    guardarUsuario ($name,$email,$password,$avatar);

    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Guardar datos por databing</title>
    <link rel="stylesheet" href="./css/style3.css">

</head>
<body>
   <form method='POST' action="guardarUsuario.php">
      <fieldset >
			<legend>Guardar datos por databing</legend>
			<br><br>

      <div class='form-control'>
        <label for='name' >usuario: </label>
        <?php
                 echo    "<input type=\"text\" name=\"name\" size=\"200\" maxlength=\"200\" value=\"".$name."\">";
        ?>
      </div>

			<div class='form-control'>
				<label for='email' >Email*:</label>
          <?php
                 echo    "<input type=\"text\" name=\"email\" size=\"200\" maxlength=\"200\" value=\"".$email."\">";
          ?>
			</div>

      <div class='form-control'>
        <label for='password'>Contraseña*:</label>
        <?php
                 echo    "<input type=\"password\" name=\"password\" size=\"200\" maxlength=\"200\" >";
        ?>
      </div>

      <div class='form-control'>
        <label for='username' >Foto Avatar:</label>
        <?php
                 echo    "<input type=\"text\" name=\"avatar\" size=\"200\" maxlength=\"200\" value=\"".$avatar."\">";
        ?>
      </div>

			<div class='form-control'>
				<button type="submit">GUARDAR EN BASE DE DATOS</button>
			</div>

      </fieldset>
   </form>
</body>
</html>
<?php
/* Conectar a una base de datos de MySQL invocando al controlador */
/* ojo! el conectar debe estar en un solo lado*/
function guardarUsuario ($name,$email,$password,$avatar){
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
VALUES(:name,:email,:password,1,:avatar);');
 $gsent->bindValue(':name',     $name, PDO::PARAM_STR);
 $gsent->bindValue(':email',    $email, PDO::PARAM_STR);
 $gsent->bindValue(':password', $password, PDO::PARAM_STR);
 $gsent->bindValue(':avatar',   $avatar, PDO::PARAM_STR);
 //var_dump($gsent);
 $gsent->execute();
 $results = $gsent->fetchAll(PDO::FETCH_ASSOC);

}
?>
