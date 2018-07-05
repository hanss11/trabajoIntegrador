<?php

#Obtenemos los datos del Json
function conectar(){
$dsn = 'mysql:dbname=MySQL;host=127.0.0.1';
$UserDB = 'root';
$PassDB = '';

try {
    $gbd = new PDO($dsn, $UserDB, $PassDB);
    echo "En try, conectado a MySQL   ";
} catch (PDOException $e) {
    echo 'Falló la conexión: ' . $e->getMessage();
}

$gsent = $gbd->prepare("select * from proyecto.amigos;");
$gsent->execute();

var_dump ($gsent);

}

 ?>
