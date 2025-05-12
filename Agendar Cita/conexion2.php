<?php
//  Esto es la conexion que se hace a la base datos del problemaCita.php
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_datos = "formulario_problemas";


$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);


if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}


$conexion->set_charset("utf8");
