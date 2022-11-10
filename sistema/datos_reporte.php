<?php 

session_start(); 

if ($_SESSION['rol']!=1 and $_SESSION['rol']!=3) {
    
    header("location: ./");
}


include"../conexion.php";

if (!empty($_POST)) {
    $alerta = "";

    if (empty($_POST['nombre']) || empty($_POST['periodo']) ) {

                $alerta = "<script>
                            Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Todos los campos son obligatorios'
                            })
                            </script>";
        
    }else {

    	$nombre   = $_POST['nombre'];
		$periodo = $_POST['periodo'];

        $query_update = mysqli_query($conexion,"UPDATE reporte SET 
            encargado = '$nombre',
            periodo ='$periodo'");


                if($query_update){
                                $alerta = "<script>
                                                Swal.fire(
                                                '¡Registrado!',
                                                'Actualizado',
                                                'success' 
                                                         )
                                            </script>";

                }else{

                $alerta = "<script>
                            Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error al actualizar'
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
    <title>Reporte</title>
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
                                    <li><a href="#">Configuración</a></li>
                                    <li class="active">Datos reportes</li>
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
                                <strong class="card-title">Datos reporte</strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center">Registro de datos</h3>
                                        </div>
                                        <hr>
                                        <?php echo isset($alerta) ? $alerta :""; ?>

                                        <form action="" method="post">

                                            <div class="row">


                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="nombre" class="control-label mb-1">Nombre del responsable</label>
                                                        <input id="nombre" name="nombre" type="text" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Nombre del responsable" required/ pattern="[a-zA-ZàáèéìíòóùúñÀÁÈÉÌÍÒÓÙÚÑ .]{5,50}">
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="periodo" class="control-label mb-1">Periodo</label>
                                                        <input id="periodo" name="periodo" type="text" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Periodo" required/ pattern="[a-zA-Z0-9àáèéìíòóùúñÀÁÈÉÌÍÒÓÙÚÑ- ]+">
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>




                                            </div>
                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    <span id="payment-button-amount">Actualizar</span>
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