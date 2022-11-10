<?php

session_start();
include "../conexion.php";

if ($_SESSION['rol']!=1 and $_SESSION['rol']!=3) {
	
	header("location: ./");

}else{
	
	if (empty($_REQUEST['id'])) {
	header("location: ./");
}
else{
	
	$idprestamo = $_REQUEST['id'];

	$query_delete = mysqli_query($conexion,"DELETE FROM prestamo WHERE idprestamo = $idprestamo");
	mysqli_close($conexion);
	

	if ($query_delete) {
		header("location: lista_prestamo.php");
		$_SESSION['msj_devolver']=1;
		
	}else{
		echo "<script> alert('No se pudo eliminar'); window.history.go(-1);</script>	
";
	}

}
	

}

 ?>