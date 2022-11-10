<?php 
session_start();
    if($_SESSION['rol'] != 1 and $_SESSION['rol'] !=3)
    {
        header("location: ./");
    }

include "../conexion.php";

if (!empty($_POST)) {
    $alerta = "";

    if (empty($_POST['numero']) || empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['semestre']) || empty($_POST['carrera'])) {

                         $alerta = "<script>
                            Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Todos los campos son obligatorios'
                            })
                            </script>";
        
    }else {

    	$numerocontrol   = $_POST['numero'];
		$nombre        = $_POST['nombre'];
		$telefono      = $_POST['telefono'];
		$semestre        = $_POST['semestre'];
		$carrera          = $_POST['carrera'];

		$query = mysqli_query($conexion,"SELECT * FROM estudiante WHERE numerocontrol = '$numerocontrol'");
        

		$resultado = mysqli_fetch_array($query);

		if($resultado > 0){

                $alerta = "<script>
                            Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Estudiante existente'
                            })
                            </script>";

			}else {

				$query_insert = mysqli_query($conexion,"INSERT INTO estudiante(numerocontrol,carrera,semestre,nombre,telefono)VALUES($numerocontrol,$carrera,'$semestre','$nombre',$telefono)");

                if($query_insert){

                                $alerta = "<script>
                                                Swal.fire(
                                                '¡Registrado!',
                                                'Estudiante registrado correctamente',
                                                'success' 
                                                         )
                                            </script>";

                }else{

                $alerta = "<script>
                            Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error al registrar'
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
    <title>Registro estudiante</title>
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
                                    <li><a href="#">Alumnos</a></li>
                                    <li class="active">Nuevo Alumno</li>
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
                                            <h3 class="text-center">Registro estudiante</h3>
                                        </div>
                                        <hr>
                                        <?php echo isset($alerta) ? $alerta :""; ?>

                                        <form action="" method="post">

                                            <div class="row">


                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="numero" class="control-label mb-1">Número de control</label>
                                                        <input id="numero" name="numero" type="text" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Número de control" minlength="8" maxlength="8" pattern="[0-9]+" required/>
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="nombre" class="control-label mb-1">Nombre</label>
                                                        <input id="nombre" name="nombre" type="text" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Nombre completo" pattern="[a-zA-ZàáèéìíòóùúñÀÁÈÉÌÍÒÓÙÚÑ .]{5,50}" required/>
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="telefono" class="control-label mb-1">Número de teléfono</label>
                                                        <input id="telefono" name="telefono" type="text" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Número de teléfono" minlength="10" maxlength="10" pattern="[0-9]+" required/>
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="semestre" class="control-label mb-1">Semestre</label>
                                                        <input id="semestre" name="semestre" type="text" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Semestre" required/>
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>


                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="carrera" class="control-label mb-1">Carrera</label>
                    <?php 
                    include "../conexion.php";
                    $query_carrera = mysqli_query($conexion,"SELECT * FROM carrera");
                    mysqli_close($conexion);
                    $resultado_carrera = mysqli_num_rows($query_carrera);


                     ?>

                                                <select name="carrera" id="carrera" >


                        <?php 
                        if($resultado_carrera > 0){

                            while ($carrera = mysqli_fetch_array($query_carrera)) {
                    ?>
                            <option value="<?php echo $carrera["idcarrera"]; ?>"><?php echo $carrera["carrera"] ?></option>
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
                                                    <span id="payment-button-amount">Registrar estudiante</span>
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

