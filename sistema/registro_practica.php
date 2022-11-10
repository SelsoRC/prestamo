<?php 
session_start();

include "../conexion.php";


if (!empty($_POST)) {
//se declara la variable alert pa utilizarla despues 
    $alerta="";
    //si checa si todos los campos estan vacios 
    if ( empty($_POST['materia']) || empty($_POST['area']) || empty($_POST['grupo']) || empty($_POST['carrera']) || empty($_POST['numeropractica']) || empty($_POST['nombrepractica']) || $_POST['numeropractica'] <= 0) {
        // en caso de se cumpla imprimir el msj
                $alerta = "<script>
                            Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Todos los campos son obligatorios'
                            })
                            </script>"; 
        
    }
    else{


        // si no entoce si no estan vacio los campos guardar los dats en las siguientes variables 
        //lo que viene en el metodo post
        date_default_timezone_set('America/Mexico_City');
        $fecha = date('Y-m-d'); 
        $materia = $_POST['materia'];
        $area = $_POST['area'];
        $grupo = $_POST['grupo'];
        $carrera = $_POST['carrera'];
        $numeropractica = $_POST['numeropractica'];
        $nombrepractica =  $_POST['nombrepractica'];
        $usuario_id = $_SESSION['idUser'];



        $query_insert = mysqli_query($conexion,"INSERT INTO practica(area,fecha,horaentrada,horasalida,materia,usuario,grupo,carrera,numeropractica,nombrepractica)
        	VALUES($area,'$fecha',NOW(),'','$materia','$usuario_id','$grupo','$carrera','$numeropractica','$nombrepractica')");

                if($query_insert){

                    header("location: lista_practica.php");
                    $_SESSION['registro_practica']=1;

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
	mysqli_close($conexion);
}




 ?>
 <html class="no-js" lang=""> 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registro práctica</title>
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
                                    <li><a href="#">Prácticas</a></li>
                                    <li class="active">Nueva Práctica</li>
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
                                <strong class="card-title">Prácticas</strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center">Registro práctica</h3>
                                        </div>
                                        <hr>
                                        <?php echo isset($alerta) ? $alerta :""; ?>

                                        <form action="" method="post">

                                            <div class="row">




                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="materia" class="control-label mb-1">Materia</label>
                                                        <textarea name="materia" id="materia" rows="9" placeholder="Nombre de la materia" class="form-control" style="height: 80px;" required/></textarea>
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="nombrepractica" class="control-label mb-1">Nombre práctica</label>
                                                        <textarea name="nombrepractica" id="nombrepractica" rows="9" placeholder="Nombre de la materia" class="form-control" style="height: 80px;" required/></textarea>
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>



                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="grupo" class="control-label mb-1">Grupo</label>
                                                        <input id="grupo" name="grupo" type="text" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Grupo" required/>
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>


                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="carrera" class="control-label mb-1">Carrera</label>
                                                        <input id="carrera" name="carrera" type="text" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Nombre de la carrera" minlength="2" maxlength="4" pattern="[a-zA-Z]+" required/>
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="numeropractica" class="control-label mb-1">Número práctica</label>
                                                        <input id="numeropractica" name="numeropractica" type="number" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Numero de la practica"  required/>
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>


                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="carrera" class="control-label mb-1">Área</label>
                    <?php 
                    include "../conexion.php";
                    $query_area = mysqli_query($conexion,"SELECT * FROM area");
                    mysqli_close($conexion);
                    $resultado_area = mysqli_num_rows($query_area);


                     ?>

                                                <select name="area" id="area" >

                    <?php 
                        if($resultado_area > 0){

                            while ($area = mysqli_fetch_array($query_area)) {
                    ?>
                            <option value="<?php echo $area["idarea"]; ?>"><?php echo $area["area"] ?></option>
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
                                                    <span id="payment-button-amount">Registrar práctica</span>
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