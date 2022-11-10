<?php 

$alerta = '';

session_start();

if (!empty($_SESSION['active'])) {
    
    header('location: sistema/');
}else {


if (!empty($_POST)) {

	if (empty($_POST['username']) || empty($_POST['password'])) {
		$alerta = "Ingrese su clave y su usuario";
		
	} else{

        require_once "conexion.php";

        $usuario = mysqli_real_escape_string($conexion,$_POST['username']);
        $contraseña = $_POST['password'];

        $query_usuario = mysqli_query($conexion, "SELECT * FROM usuario WHERE usuario = '$usuario'");
        mysqli_close($conexion);


        $resultado = mysqli_num_rows($query_usuario);

        if ($resultado > 0) {
             
        $datos = mysqli_fetch_array($query_usuario);


        $codigo_hash = $datos['clave']; 
        if (password_verify($contraseña, $codigo_hash)) {

            $_SESSION['active'] = true;
            $_SESSION['idUser'] = $datos['idusuario'];
            $_SESSION['nombre'] = $datos['nombre '];
            $_SESSION['email']  = $datos['correo'];
            $_SESSION['user']   = $datos['usuario'];
            $_SESSION['rol']    = $datos['rol'];

            header('location: sistema/');
            
        } else {
            $alerta = "El usuario o la clave son incorrecto";
            session_destroy();
             }
        } else{

            $alerta = "El usuario o la clave son incorrecto";
            session_destroy();
         }

	   }
	
    }

}
 ?>



<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>login</title>
</head>
<body>

    <form action="" method="POST">
    <div class="body"></div>
        <div class="grad"></div>
        <div class="header">
            <div style="font-size: 19pt;">ISC-INVENTARIO</div>
        </div>
        <br>
        <div class="login">
                <input type="text" placeholder="username" name="username" pattern="[a-zA-ZàáèéìíòóùúñÀÁÈÉÌÍÒÓÙÚÑ]{5,15}" required/><br>
                <input type="password" placeholder="password" name="password" required/><br>
                <div class="alerta"><p><?php echo isset($alerta)? $alerta : ''; ?></p></div>
                <input type="submit" value="ENTRAR">
        </div>
</form>

</body>
</html>


    


