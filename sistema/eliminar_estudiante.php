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
	
	$idestudiante = $_REQUEST['id'];

	$query_delete = mysqli_query($conexion,"DELETE FROM estudiante WHERE idestudiante = $idestudiante");
	mysqli_close($conexion);
	

	if ($query_delete) {
		header("location: lista_estudiante.php");
		$_SESSION['msj_estudiante']=1;
		
	}else{
		echo "<script> alert('No se pudo eliminar'); window.history.go(-1);</script>	
";
	}

}
	

}




 ?>