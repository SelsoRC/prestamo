<?php 
session_start();
    if($_SESSION['rol'] != 1)
    {
        header("location: ./");
    }

include "../conexion.php";

if (!empty($_POST)) {
    $alerta = "";

    if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['rol'])) {

                        $alerta = "<script>
                            Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Todos los campos son obligatorios'
                            })
                            </script>";
        
    }else {

    	$nombre       = $_POST['nombre'];
		$email        = $_POST['correo'];
		$usuario      = $_POST['usuario'];
		$clave        = password_hash($_POST['clave'], PASSWORD_DEFAULT);
		$rol          = $_POST['rol'];

		$query = mysqli_query($conexion,"SELECT * FROM usuario WHERE usuario = '$usuario' OR correo = '$email' ");
        

		$resultado = mysqli_fetch_array($query);

		if($resultado > 0){

                $alerta = "<script>
                            Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'El correo o el usuario ya existe'
                            })
                            </script>";

			}else {

				$query_insert = mysqli_query($conexion,"INSERT INTO usuario(rol,nombre,correo,usuario,clave)VALUES('$rol','$nombre','$email','$usuario','$clave')");

                if($query_insert){

                                    $alerta = "<script>
                                                Swal.fire(
                                                '¡Usuario creado!',
                                                'Usuario creado correctamente',
                                                'success' 
                                                         )
                                            </script>";

                }else{

                    $alerta = "<script>
                            Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error al crear el usuario'
                            })
                            </script>";
                }

				
			}       
    }
    mysqli_close($conexion);
    
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
                                    <li class="active">Nuevo usuario</li>
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
                                            <h3 class="text-center">Registro usuario</h3>
                                        </div>
                                        <hr>
                                        <?php echo isset($alerta) ? $alerta :""; ?>

                                        <form action="" method="post">

                                            <div class="row">


                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="nombre" class="control-label mb-1">Nombre</label>
                                                        <input id="nombre" name="nombre" type="text" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Nombre completo" pattern="[a-zA-ZàáèéìíòóùúñÀÁÈÉÌÍÒÓÙÚÑ .']{5,50}" required/>
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="correo" class="control-label mb-1">Correo electrónico</label>
                                                        <input id="correo" name="correo" type="email" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Correo electrónico" required/>
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="usuario" class="control-label mb-1">Usuario</label>
                                                        <input id="usuario" name="usuario" type="text" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Usuario" pattern="[a-zA-ZàáèéìíòóùúñÀÁÈÉÌÍÒÓÙÚÑ]{5,15}" required/>
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="clave" class="control-label mb-1">Clave</label>
                                                        <input id="clave" name="clave" type="password" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Clave de acceso" required/>
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>


                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="rol" class="control-label mb-1">Tipo Usuario</label>
                    <?php 
                    include "../conexion.php";
                    $query_rol = mysqli_query($conexion,"SELECT * FROM rol");
                    mysqli_close($conexion);
                    $resultado_rol = mysqli_num_rows($query_rol);


                     ?>
                                                <select name="rol" id="rol" >


                        <?php 
                        if($resultado_rol > 0){

                            while ($rol = mysqli_fetch_array($query_rol)) {
                    ?>
                            <option value="<?php echo $rol["idrol"]; ?>"><?php echo $rol["rol"] ?></option>
                    <?php 
                                # code...
                            }
                            
                        }
                        
                     ?>
                                                </select>
                                                    <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>




                                            </div>
                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    <span id="payment-button-amount">Crear usuario</span>
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