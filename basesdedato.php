<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Formulario</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">

    </head>
    <body>
        <div class="data-form">
        <form  method="post" enctype="multipart/form-data">
<?php
//$_POST = '';
$UserDB = '';
$PassDB = '';
?>

          <div class="form-group">
              <label for="name">usuarios base de datos:</label>
              <input class="form-control" type="text" name="name" value="<?=$UserDB?>">
              <br>
              <label for="pass">password base de datos:</label>
              <input class="form-control" type="text" name="pass" value="<?=$PassDB?>">
              <br>
            <?php
              var_dump ($_POST);
              if ($_POST["Restaurar"]){
                  $mi_var=$_POST["Restaurar"];
                  echo "ver que tiene: ",$mi_var ;
                  $UserDB=$_POST["name"];
                  $PassDBr=$_POST["pass"];
                  conectarme($UserDB,$PassDB);
                }
            ?>
            <button class="btn btn-primary mb-2" name="Restaurar"  type="submit">Restaurar</button>
        </div>
        </form>

    </body>

</html>
<?php
/* Conectar a una base de datos de MySQL invocando al controlador */

function conectarme ($UserDB,$PassDB){
$dsn = 'mysql:dbname=MySQL;host=127.0.0.1';
//$UserDB = 'root';
//$PassDB = '';


try {
    $gbd = new PDO($dsn, $UserDB, $PassDB);
    echo "entre en try, me conecte al MySql Local   ";
} catch (PDOException $e) {
    echo 'Falló la conexión: ' . $e->getMessage();
}

 $gsent = $gbd->prepare("CREATE DATABASE IF NOT EXISTS proyecto;");
 $gsent->execute();

 $gsent = $gbd->prepare("CREATE TABLE proyecto.usuarios(
     id INT primary KEY auto_increment not null,
     nickname VARCHAR(50) UNIQUE NOT NULL,
     email VARCHAR(100) UNIQUE NOT NULL,
     pass VARCHAR(100) NOT NULL,
     tipoDeUsuario INT NOT NULL,
     avatar VARCHAR(150) );
     CREATE TABLE proyecto.locales(
     id INT primary KEY auto_increment not null,
     direccion VARCHAR(30) UNIQUE NOT NULL,
     horarios VARCHAR (20) NOT NULL,
     formasDePago VARCHAR(100),
     localidad VARCHAR(30),
     avatar VARCHAR(150),
     empresa_id INT
   );

CREATE TABLE proyecto.empresa(
    id INT primary KEY auto_increment not null,
    avatar VARCHAR(150)
  );

CREATE TABLE proyecto.posteos(
    id INT primary KEY auto_increment not null,
	titulo VARCHAR(80) not null,
    descripcion VARCHAR(300),
    ubicacion VARCHAR(30),
    raking INT,
    meGusta INT,
    usupost_id INT,
    publicidad INT
  );

CREATE TABLE proyecto.seguidores(
   id INT primary KEY auto_increment not null,
   id_usuario INT,
   id_empresa INT
 );

CREATE TABLE proyecto.amigos(
   id INT primary KEY auto_increment not null,
   id_usuario INT
   )");
 $gsent->execute();

}




?>
