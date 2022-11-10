<?php 
session_start();
if ($_SESSION['rol']!=1) {
	
	header("location: ./");
}
// se manda a llamar el archovo de coneccion  
include "../conexion.php";
// si clic para hacer la accion si es diferente a vacio la variable post
if (!empty($_POST)) {
	//se declara la variable alert pa utilizarla despues 
	$alerta="";

	//si checa si todos los campos estan vacios 
	if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['rol'])) {

		// en caso de se cumpla imprimir el msj

		         $alerta = "<script>
                            Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Todos los campos son obligatorios'
                            })
                            </script>";

		
	} else {

		// si no entoce si no estan vacio los campos guardar los dats en las siguientes variables 
		//extraemos datos del formilario
		$idUsuario = $_POST['id'];
		$nombre = $_POST['nombre'];
		$email = $_POST['correo'];
		$user = $_POST['usuario'];
		$rol = $_POST['rol'];

		$query = mysqli_query($conexion,"SELECT * FROM usuario WHERE (usuario = '$user' AND idusuario != $idUsuario) OR (correo = '$email' AND idusuario != $idUsuario)");
		//el resultado se gurda en result
		$result = mysqli_fetch_array($query);
		$result = count((array) $result);
		// si el resultado es mayor a 0 entrar en la funcion 
		if ($result > 0) {
			// imprimi que el usuario ya existe

				$alerta = "<script>
                            Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'El correo o el usuario ya existe'
                            })
                            </script>";

			# code...
		} else{

			if (empty($_POST['clave'])) {
				
			$sql_update = mysqli_query($conexion,"UPDATE usuario SET nombre = '$nombre', correo = '$email', usuario = '$user', rol= '$rol' WHERE idusuario = $idUsuario");	

			} 
			else{

			$clave  = password_hash($_POST['clave'], PASSWORD_DEFAULT);
			$sql_update = mysqli_query($conexion,"UPDATE usuario SET nombre = '$nombre', correo = '$email',usuario = '$user', clave = '$clave', rol= '$rol'WHERE idusuario = $idUsuario");
			}

			// en caso de que no encuentr el usuario se crea otro con el siguiente query
			// si se cumplio imprime el msj
			if ($sql_update) {
				
				                 $alerta = "<script>
                                                Swal.fire(
                                                '¡Usuario actualizado!',
                                                'Usuario actualizado correctamente',
                                                'success' 
                                                         )
                                            </script>";
			}
			  // en caso de que no imprime el siguiente msj
			else{

				$alerta = "<script>
                            Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error al actualizar el usuario'
                            })
                            </script>";


			}
		}
	}
		
}

//////////////////////////////////////
 
if (empty($_REQUEST['id'])) {
	# code...
	header("location: lista_usuario.php");
	mysqli_close($conexion);
}

$iduser = $_REQUEST['id']; 

$sql= mysqli_query($conexion,"SELECT u.idusuario, u.nombre, u.correo, u.usuario, (u.rol) as idrol, (r.rol) as rol From usuario u INNER JOIN rol r on u.rol = r.idrol WHERE idusuario= $iduser ");
mysqli_close($conexion);

$result_sql = mysqli_num_rows($sql);

if ($result_sql == 0) {
	# code...
	header('location: lista_usuario.php');
}
else{
	$option = '';
	while ($data = mysqli_fetch_array($sql)) {

		$iduser = $data['idusuario'];
		$nombre = $data['nombre'];
		$correo = $data['correo'];
		$usuario = $data['usuario'];
		$idrol = $data['idrol'];
		$rol = $data['rol'];
		# code...
		if ($idrol == 1) {
			$option = '<option value ="'.$idrol.'"select>'.$rol.'</option>';
		}
		if ($idrol == 2) {
			$option = '<option value ="'.$idrol.'"select>'.$rol.'</option>';
		}
		if ($idrol == 3) {
			$option = '<option value ="'.$idrol.'"select>'.$rol.'</option>';
		}
	}
}


 ?>



 <html class="no-js" lang=""> 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registro usuario</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="sweetalert2/jquery.min.js"></script>
    <script src="sweetalert2/sweetalert2.all.min.js"></script>

    <?php include "includes/script.php"; ?>
</head>  
<body>

 <!-- /#left-panel -->
    <?php include "includes/left-panel.php"; ?>
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">

        <?php include "includes/header.php"; ?>

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Inicio</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="index.php">Inicio</a></li>
                                    <li><a href="#">Usuarios</a></li>
                                    <li class="active">Editar usuario</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
           
            <div class="animated fadeIn">


            	                <div class="col-lg-13">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Usuario</strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center">Actualizar usuario</h3>
                                        </div>
                                        <hr>
                                        <?php echo isset($alerta) ? $alerta :""; ?>

                                        <form action="" method="post">

                                            <div class="row">


                                                <div class="col-6">
                                                    <div class="form-group">
                                                    	<input type="hidden" name="id" value="<?php echo $iduser ?>">
                                                        <label for="nombre" class="control-label mb-1">Nombre</label>
                                                        <input id="nombre" name="nombre" type="text" class="form-control cc-exp" value="<?php echo $nombre; ?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Nombre completo" pattern="[a-zA-ZàáèéìíòóùúñÀÁÈÉÌÍÒÓÙÚÑ .']{5,50}" required/>
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="correo" class="control-label mb-1">Correo electrónico</label>
                                                        <input id="correo" name="correo" type="email" class="form-control cc-exp" value="<?php echo $correo; ?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Correo electrónico" required/>
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="usuario" class="control-label mb-1">Usuario</label>
                                                        <input id="usuario" name="usuario" type="text" class="form-control cc-exp" value="<?php echo $usuario; ?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Usuario" pattern="[a-zA-ZàáèéìíòóùúñÀÁÈÉÌÍÒÓÙÚÑ]{5,15}" required/>
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="clave" class="control-label mb-1">Clave</label>
                                                        <input id="clave" name="clave" type="password" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Clave de acceso" >
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>


                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="rol" class="control-label mb-1">Tipo Usuario</label>

					<?php 
					// selecciona todos los roles 
					include "../conexion.php";
					$query_rol = mysqli_query($conexion,"SELECT * FROM rol");
					mysqli_close($conexion);
					// se curda en numero en esta variable
					$result_rol = mysqli_num_rows($query_rol);
					

					 ?>

                                                <select name="rol" id="rol" class="notItemOne" >
                     <?php 
					echo $option;
					// si se cumple entra en la condicion 

					if ($result_rol>0) {

						// recorre hasta la cantidad de rol
						while ($rol = mysqli_fetch_array($query_rol)) {

							 ?>
							 <!-- se jalan los datos desdde la bd para crear los tipos  -->
							 <option value="<?php echo $rol["idrol"]; ?>"><?php echo $rol["rol"]; ?></option>
							 <?php 

							 	}
							}

						?>
					<!-- termina el select -->



                                                </select>
                                                    <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>




                                            </div>
                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    <span id="payment-button-amount">Actualizar usuario</span>
                                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div> <!-- .card -->

                    </div><!--/.col-->





               
            </div>
            
        </div>

        <div class="clearfix"></div>
        <?php include "includes/footer.php"; ?>

    </div>

   
 
</body>
</html>