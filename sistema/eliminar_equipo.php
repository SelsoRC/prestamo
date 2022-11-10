<?php

session_start();
include "../conexion.php";

if ($_SESSION['rol']!=1 and $_SESSION['rol']!=3) {
	
	header("location: ./");

}else{

if (empty($_REQUEST['id'])) {
	header("location: lista_equipo.php");
}
else{
	
	$idequipo = $_REQUEST['id'];

	$query = mysqli_query($conexion,"SELECT * FROM equipo WHERE idequipo = $idequipo");

	$result = mysqli_num_rows($query);

	if ($result > 0) {

		$data = mysqli_fetch_array($query);
		$query_delete = mysqli_query($conexion,"DELETE FROM equipo WHERE idequipo = $idequipo");

		if ($data['foto']!='img_producto.png') {
			unlink('images/img_equipo/'.$data['foto']);
			
		}

		if ($query_delete) {

		header("location: lista_equipo.php");
		$_SESSION['msj_equipo']=1;
		
		}else{

		echo "<script> alert('No se pudo eliminar'); window.history.go(-1);</script>";
		}

		
	}
	

}

}

 ?>