<?php

session_start();
include "../conexion.php";

if ($_SESSION['rol']!=1 and $_SESSION['rol']!=3) {
	
	header("location: ./");

}else{

if (empty($_REQUEST['id'])) {
	header("location: lista_material.php");
}
else{
	
	$idmaterial = $_REQUEST['id'];

	$query = mysqli_query($conexion,"SELECT * FROM material WHERE idmaterial = $idmaterial");

	$result = mysqli_num_rows($query);

	if ($result > 0) {

		$data = mysqli_fetch_array($query);
		$query_delete = mysqli_query($conexion,"DELETE FROM material WHERE idmaterial = $idmaterial");

		if ($data['foto']!='img_producto.png') {
			unlink('images/img_material/'.$data['foto']);
			
		}

		if ($query_delete) {

		header("location: lista_material.php");
		$_SESSION['msj_material']=1;
		
		}else{

		echo "<script> alert('No se pudo eliminar'); window.history.go(-1);</script>";
		}

		
	}
	

}

}

 ?>