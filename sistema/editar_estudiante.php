<?php 
session_start();
if ($_SESSION['rol']!=1 and $_SESSION['rol'] !=3) {
	
	header("location: ./");
}
// se manda a llamar el archovo de coneccion  
include "../conexion.php";
// si clic para hacer la accion si es diferente a vacio la variable post
if (!empty($_POST)) {
	//se declara la variable alert pa utilizarla despues 
	$alerta="";

	//si checa si todos los campos estan vacios 
	if (empty($_POST['numero']) || empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['semestre']) || empty($_POST['carrera'])) {

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
		$idEstudiante = $_POST['id'];
		$numero = $_POST['numero'];
		$nombre = $_POST['nombre'];
		$telefono = $_POST['telefono'];
		$semestre = $_POST['semestre'];
		$carrera = $_POST['carrera'];

		$query = mysqli_query($conexion,"SELECT * FROM estudiante WHERE numerocontrol = $numero and idestudiante != $idEstudiante");
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
                            text: 'Estudiante existente'
                            })
                            </script>";

			# code...
		} else{

			$sql_update = mysqli_query($conexion,"UPDATE estudiante SET numerocontrol = '$numero', nombre = '$nombre',telefono = '$telefono', semestre = '$semestre', carrera= '$carrera' WHERE idestudiante = $idEstudiante");
			
			// en caso de que no encuentr el usuario se crea otro con el siguiente query
			// si se cumplio imprime el msj
			if ($sql_update) {

                                $alerta = "<script>
                                                Swal.fire(
                                                '¡Actualizado!',
                                                'Alumno actualizado correctamente',
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
                            text: 'Error al actualizar el Alumno'
                            })
                            </script>";

			}
		}
	}
		
}

//////////////////////////////////////Mostrar Datos ////////////////////////////////////////////////
 
if (empty($_REQUEST['id'])) {
	# code...
	header("location: lista_usuario.php");
	mysqli_close($conexion);
}

$idalumno = $_REQUEST['id']; 

$sql= mysqli_query($conexion,"SELECT u.idestudiante, u.numerocontrol, u.nombre, u.semestre,u.telefono, (u.carrera) as idcarrera, (r.carrera) as carrera From estudiante u INNER JOIN carrera r on u.carrera = r.idcarrera WHERE idestudiante= $idalumno ");
mysqli_close($conexion);

$result_sql = mysqli_num_rows($sql);

if ($result_sql == 0) {
	# code...
	header('location: lista_alumno.php');
}
else{
	$option = '';
	while ($data = mysqli_fetch_array($sql)) {

		$idalumno = $data['idestudiante'];
		$numerocontrol = $data['numerocontrol'];
		$nombre = $data['nombre'];
		$semestre = $data['semestre'];
		$carrera = $data['carrera'];
		$idcarrera = $data['idcarrera'];
		$telefono = $data['telefono'];
		# code...
		if ($idcarrera == 1) {
			$option = '<option value ="'.$idcarrera.'"select>'.$carrera.'</option>';
		}
		if ($idcarrera == 2) {
			$option = '<option value ="'.$idcarrera.'"select>'.$carrera.'</option>';
		}
		if ($idcarrera == 3) {
			$option = '<option value ="'.$idcarrera.'"select>'.$carrera.'</option>';
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
                                    <li><a href="#">alumnos</a></li>
                                    <li class="active">Editar alumno</li>
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
                                <strong class="card-title">Estudiante</strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center">Actualizar estudiante</h3>
                                        </div>
                                        <hr>
                                        <?php echo isset($alerta) ? $alerta :""; ?>

                                        <form action="" method="post">

                                            <div class="row">


                                                <div class="col-6">
                                                    <div class="form-group">
                                                <input type="hidden" name="id" value="<?php echo $idalumno ?>">
                                                        <label for="numero" class="control-label mb-1">Número de control</label>
                                                        <input id="numero" name="numero" type="text" class="form-control cc-exp" value="<?php echo $numerocontrol; ?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Número de control" minlength="8" maxlength="8" pattern="[0-9]+" required/>
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="nombre" class="control-label mb-1">Nombre</label>
                                                        <input id="nombre" name="nombre" type="text" class="form-control cc-exp" value="<?php echo $nombre; ?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Nombre completo" pattern="[a-zA-ZàáèéìíòóùúñÀÁÈÉÌÍÒÓÙÚÑ .]{5,50}" required/>
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="telefono" class="control-label mb-1">Número de teléfono</label>
                                                        <input id="telefono" name="telefono" type="text" class="form-control cc-exp" value="<?php echo $telefono; ?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Número de teléfono" minlength="10" maxlength="10" pattern="[0-9]+" required/>
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="semestre" class="control-label mb-1">Semestre</label>
                                                        <input id="semestre" name="semestre" type="text" class="form-control cc-exp" value="<?php echo $semestre; ?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Semestre" required/>
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>


                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="carrera" class="control-label mb-1">Carrera</label>
					<?php 
					// selecciona todos los roles 
					include "../conexion.php";
					$query_carrera = mysqli_query($conexion,"SELECT * FROM carrera");
					mysqli_close($conexion);
					// se curda en numero en esta variable
					$result_carrera = mysqli_num_rows($query_carrera);
					

					 ?>

                              <select name="carrera" id="carrera" class="notItemOne">

					<?php 
					echo $option;
					// si se cumple entra en la condicion 

					if ($result_carrera>0) {

						// recorre hasta la cantidad de rol
						while ($carrera = mysqli_fetch_array($query_carrera)) {

							 ?>
							 <!-- se jalan los datos desdde la bd para crear los tipos  -->
							 <option value="<?php echo $carrera["idcarrera"]; ?>"><?php echo $carrera["carrera"]; ?></option>
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
                                                    <span id="payment-button-amount">Actualizar estudiante</span>
                                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div> <!-- .card -->

                    </div>


               
            </div>
            
        </div>

        <div class="clearfix"></div>
        <?php include "includes/footer.php"; ?>

    </div>

   
 
</body>
</html>