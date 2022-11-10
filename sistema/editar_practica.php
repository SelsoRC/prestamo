<?php

session_start();
include "../conexion.php";

	
if (empty($_REQUEST['id'])) {
	header("location: ./");
}
else{
	
	$idpractica = $_REQUEST['id'];

	$query_update = mysqli_query($conexion,"UPDATE practica SET horasalida = NOW() WHERE idpractica = $idpractica");


	mysqli_close($conexion);
	

	if ($query_update) {
		header("location: lista_practica.php");
		
	}else{
		echo "<script> alert('No se pudo guardar'); window.history.go(-1);</script>	
";
	}

}