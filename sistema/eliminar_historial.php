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
	
	$idhistorial = $_REQUEST['id'];

	$query_delete = mysqli_query($conexion,"DELETE FROM historial WHERE idhistorial = $idhistorial");
	mysqli_close($conexion);
	

	if ($query_delete) {
		header("location: lista_historial.php");
		$_SESSION['msj_historial']=1;
		
	}else{
		echo "<script> alert('No se pudo eliminar'); window.history.go(-1);</script>	
";
	}

}
	

}

 ?>

