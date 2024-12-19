<?php
// declarar variables de los valores de la conexion

$servidor = "localhost";
$usuario = "root";
$password = "";
$bd = "sistema_inscripcion";
$conectar = mysqli_connect($servidor, $usuario, $password, $bd);

if($conectar->connect_error){

    die("error al conectar la bd".$conectar->connect_error);
}




?>