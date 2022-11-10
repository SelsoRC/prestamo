<?php

session_start();
include "../conexion.php";

if ($_SESSION['rol']!=1 ) {
	
	header("location: ./");
	
} else{
	
	if (empty($_REQUEST['id']) || $_REQUEST['id']==1 ) {
	header("location: ./");
}
else{
	
	$idusuario = $_REQUEST['id'];

	$query_delete = mysqli_query($conexion,"DELETE FROM usuario WHERE idusuario = $idusuario");
	mysqli_close($conexion);
	

	if ($query_delete) {
		header("location: lista_usuario.php");
		$_SESSION['msj_usuario']=1;
		
	}else{
		echo "<script> alert('No se pudo eliminar'); window.history.go(-1);</script>	
";
	}

}


}





 ?>

	
