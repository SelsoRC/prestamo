<?php 

$host = '127.0.0.1:33065';
$usuario = 'root';
$contraseña = '';
$bd = 'bdprestamo';

$conexion = mysqli_connect($host, $usuario, $contraseña, $bd); 

if (!$conexion) {
	echo "Error de conexion";
}


 ?>