<?php 
session_start();
include "../conexion.php";
	
	if (empty($_REQUEST['id'])) {
	header("location: ./");
}
else{
	
	$idpractica = $_REQUEST['id'];

	$query_delete = mysqli_query($conexion,"DELETE FROM practica WHERE idpractica = $idpractica");
	mysqli_close($conexion);
	

	if ($query_delete) {
		header("location: lista_practica.php");
		$_SESSION['msj_practica']=1;
		
	}else{
		echo "<script> alert('No se pudo eliminar'); window.history.go(-1);</script>	
";
	}

}
	







 ?>