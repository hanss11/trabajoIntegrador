<?php

/* para probar la solucion con un solo campo
*/
$UserDB='';
$PassDB='';

if($_POST){
  $UserDB=$_POST['name'];
  $PassDB=$_POST['pass'];
  $error = [];

  if (!$UserDB) {
    $error['name'] = "   Es obligatorio que informes tu Usuario \n";
  }

  if ($PassDB) {
    $error['pass'] = "Password es no requerido \n";
  }

  if($error){
    foreach ($error as $value) {
      echo $value;
    }
  } else  {
        // restaurar base de datos porque tienen los dotos Ok
        echo "<label> Base de datos del Proyecto, Restaurada con exito</label><br><br>";

        conectarme ($UserDB,$PassDB);
      }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Restaurar</title>
    <link rel="stylesheet" href="./css/style3.css">
</head>
<body>
   <form method='POST' action="/trabajoIntegrador/basededato.php">
      <fieldset >
			<legend>Mantenimiento de Base de Datos del Proyecto</legend>
			<br><br>

      <div class='form-control'>
        <label for='username' >Nombre de usuario*:</label>
        <?php
                 echo    "<input type=\"text\" name=\"name\" size=\"200\" maxlength=\"200\" value=\"".$UserDB."\">";
        ?>
      </div>

      <div class='form-control'>
        <label for='password'>Contraseña*:</label>
        <?php
                 echo    "<input type=\"password\" name=\"pass\" size=\"200\" maxlength=\"200\" >";
        ?>
      </div>

			<div class='form-control'>
				<button type="submit">RESTAURAR</button>
			</div>

      </fieldset>
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
    // echo "entre en try, me conecte al MySql Local   ";
} catch (PDOException $e) {
    echo 'Falló la conexión: ' . $e->getMessage();
}

 $gsent = $gbd->prepare("DROP DATABASE IF EXISTS proyecto;");
 $gsent->execute();

 $gsent = $gbd->prepare("CREATE DATABASE IF NOT EXISTS proyecto;");
 $gsent->execute();

 $gsent = $gbd->prepare("
 -- -----------------------------------------------------
 -- Table `proyecto`.`amigos`
 -- -----------------------------------------------------
 DROP TABLE IF EXISTS `proyecto`.`amigos` ;

 CREATE TABLE IF NOT EXISTS `proyecto`.`amigos` (
   `id_amigos` INT(11) NOT NULL AUTO_INCREMENT,
   `id_usuario` INT(11) NOT NULL,
   PRIMARY KEY (`id_amigos`, `id_usuario`))
 ENGINE = InnoDB
 AUTO_INCREMENT = 2
 DEFAULT CHARACTER SET = latin1;


 -- -----------------------------------------------------
 -- Table `proyecto`.`locales`
 -- -----------------------------------------------------
 DROP TABLE IF EXISTS `proyecto`.`locales` ;

 CREATE TABLE IF NOT EXISTS `proyecto`.`locales` (
   `id_locales` INT(11) NOT NULL AUTO_INCREMENT,
   `direccion` VARCHAR(30) NOT NULL,
   `horarios` VARCHAR(20) NOT NULL,
   `formasDePago` VARCHAR(100) NULL DEFAULT NULL,
   `localidad` VARCHAR(30) NULL DEFAULT NULL,
   `avatar` VARCHAR(150) NULL DEFAULT NULL,
   `empresa_id` INT(11) NOT NULL,
   PRIMARY KEY (`id_locales`, `empresa_id`),
   UNIQUE INDEX `direccion` (`direccion` ASC));


 -- -----------------------------------------------------
 -- Table `proyecto`.`empresa`
 -- -----------------------------------------------------
 DROP TABLE IF EXISTS `proyecto`.`empresa` ;

 CREATE TABLE `proyecto`.`empresa` (
   `id_empresa` int(11) NOT NULL AUTO_INCREMENT,
   `avatar` varchar(150) DEFAULT NULL,
   PRIMARY KEY (`id_empresa`),
   CONSTRAINT `PK_locales` FOREIGN KEY (`id_empresa`) REFERENCES `locales` (`id_locales`) ON DELETE NO ACTION ON UPDATE NO ACTION
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;


 -- -----------------------------------------------------
 -- Table `proyecto`.`seguidores`
 -- -----------------------------------------------------
 DROP TABLE IF EXISTS `proyecto`.`seguidores` ;

 CREATE TABLE IF NOT EXISTS `proyecto`.`seguidores` (
   `id_seguidores` INT(11) NOT NULL AUTO_INCREMENT,
   `id_usuario` INT(11) NOT NULL,
   `id_empresa` INT(11) NOT NULL,
   PRIMARY KEY (`id_seguidores`))
 ENGINE = InnoDB
 DEFAULT CHARACTER SET = latin1;


 -- -----------------------------------------------------
 -- Table `proyecto`.`usuarios`
 -- -----------------------------------------------------
 DROP TABLE IF EXISTS `proyecto`.`usuarios` ;

 CREATE TABLE IF NOT EXISTS `proyecto`.`usuarios` (
   `id` INT(11) NOT NULL AUTO_INCREMENT,
   `nickname` VARCHAR(50) NOT NULL,
   `email` VARCHAR(100) NOT NULL,
   `pass` VARCHAR(100) NOT NULL,
   `tipoDeUsuario` INT(11) NOT NULL,
   `avatar` VARCHAR(150) NULL DEFAULT NULL,
   PRIMARY KEY (`id`),
   UNIQUE INDEX `nickname` (`nickname` ASC),
   UNIQUE INDEX `email` (`email` ASC));

 -- -----------------------------------------------------
 -- Table `proyecto`.`posteos`
 -- -----------------------------------------------------
 DROP TABLE IF EXISTS `proyecto`.`posteos` ;

 CREATE TABLE IF NOT EXISTS `proyecto`.`posteos` (
   `id` INT(11) NOT NULL AUTO_INCREMENT,
   `titulo` VARCHAR(80) NOT NULL,
   `descripcion` VARCHAR(300) NULL DEFAULT NULL,
   `ubicacion` VARCHAR(30) NULL DEFAULT NULL,
   `raking` INT(11) NULL DEFAULT NULL,
   `meGusta` INT(11) NULL DEFAULT NULL,
   `usupost_id` INT(11) NOT NULL,
   `publicidad` INT(11) NULL DEFAULT NULL,
   PRIMARY KEY (`id`, `usupost_id`),
   INDEX `PK_usuarios_idx` (`usupost_id` ASC),
   CONSTRAINT `PK_usuarios`
     FOREIGN KEY (`usupost_id`)
     REFERENCES `proyecto`.`usuarios` (`id`)
     ON DELETE NO ACTION
     ON UPDATE NO ACTION)
 ENGINE = InnoDB
 DEFAULT CHARACTER SET = latin1;

");
 $gsent->execute();

}




?>
