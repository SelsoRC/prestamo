<?php 

session_start(); 

if ($_SESSION['rol']!=1 and $_SESSION['rol']!=3) {
    
    header("location: ./");
}
if (empty($_REQUEST['id'])) {
	
	header("location: prestamo_equipo.php");

}

include"../conexion.php";

if (!empty($_POST)) {
    $alerta = "";

    if (empty($_POST['numero']) || empty($_POST['cantidad']) || $_POST['cantidad'] <= 0) {

                        $alerta = "<script>
                            Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Todos los campos son obligatorios'
                            })
                            </script>";


        
    }else {

    	$numero   = $_POST['numero'];
		$cantidad = $_POST['cantidad'];
		$idEquipo = $_REQUEST['id'];
        $usuario  = $_SESSION['idUser'];

        $query_estudiante = mysqli_query($conexion,"SELECT * FROM estudiante WHERE numerocontrol = '$numero'");

        $resultado = mysqli_num_rows($query_estudiante);
        $datos_estudiante = mysqli_fetch_array($query_estudiante);

       

        if($resultado>0){
            $idestudiante=$datos_estudiante['idestudiante'];

            $query_equipo = mysqli_query($conexion,"SELECT * FROM equipo WHERE idequipo = $idEquipo");
            $query_prestamo = mysqli_query($conexion,"SELECT SUM(cantidadprestado) FROM prestamo WHERE equipo = $idEquipo");


            $datos_equipo = mysqli_fetch_array($query_equipo);
            $datos_prestamo = mysqli_fetch_array($query_prestamo);

            $disponible = $datos_equipo['cantidad']-$datos_prestamo['SUM(cantidadprestado)'];
            
            
            if ($cantidad <= $disponible) {


                $query_insertar = mysqli_query($conexion,"INSERT INTO prestamo(equipo,estudiante,usuario,cantidadprestado)VALUES($idEquipo,$idestudiante,$usuario,$cantidad)");

                $query_insertar = mysqli_query($conexion,"INSERT INTO historial(equipo,estudiante,usuario,cantidadprestado)VALUES($idEquipo,$idestudiante,$usuario,$cantidad)");

                if($query_insertar){

                                     $alerta = "<script>
                                                Swal.fire(
                                                '¡Realizado!',
                                                'Préstamo realizado',
                                                'success' 
                                                         )
                                            </script>";

                }else{

                $alerta = "<script>
                            Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error al prestas'
                            })
                            </script>";
                }

                
                
                
            }else{
                
                $alerta = "<script>
                            Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Equipo no disponible'
                            })
                            </script>";

            }


        }else{

                            $alerta = "<script>
                            Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'El alumno no existe'
                            })
                            </script>";

        }    
    }
    mysqli_close($conexion);
    
}


 ?>



<html class="no-js" lang=""> 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Préstamo</title>
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
                                    <li><a href="#">Préstamo</a></li>
                                    <li class="active">Realizar préstamo</li>
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
                                <strong class="card-title">Préstamo</strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center">Préstamo</h3>
                                        </div>
                                        <hr>
                                        <?php echo isset($alerta) ? $alerta :""; ?>

                                        <form action="" method="post">

                                            <div class="row">


                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="numero" class="control-label mb-1">Número control</label>
                                                        <input id="numero" name="numero" type="text" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Número de control" required/ minlength="8" maxlength="8" pattern="[0-9]+">
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cantidad" class="control-label mb-1">Cantidad</label>
                                                        <input id="cantidad" name="cantidad" type="number" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Cantidad" required/>
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>

                                            </div>
                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    <span id="payment-button-amount">Prestar</span>
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