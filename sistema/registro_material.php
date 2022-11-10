
<?php 
session_start(); 
  if($_SESSION['rol'] != 1 and $_SESSION['rol']!=3)
    {
        header("location: ./");
    }

include "../conexion.php";


if (!empty($_POST)) {
//se declara la variable alert pa utilizarla despues 
    $alerta="";
    //si checa si todos los campos estan vacios 
    if (empty($_POST['descripcion']) || empty($_POST['unidad']) || empty($_POST['cantidad']) || empty($_POST['observaciones']) || empty($_POST['area'])  || $_POST['cantidad'] <= 0) {
        // en caso de se cumpla imprimir el msj
        $alerta="<script>
        Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'Rellenar todos los campos'
            })
        </script>"; 
        
    }
    else{
        // si no entoce si no estan vacio los campos guardar los dats en las siguientes variables 
        //lo que viene en el metodo post
        $area = $_POST['area'];
        $descripcion = $_POST['descripcion'];
        $cantidad = $_POST['cantidad'];
        $unidad = $_POST['unidad'];
        $observaciones = $_POST['observaciones'];
        $usuario_id = $_SESSION['idUser'];


        $foto = $_FILES['foto'];
        $nombre_foto = $foto['name'];
        $type = $foto['type'];
        $url_temp = $foto['tmp_name'];

        $imgProducto = 'img_producto.png';

        if ($nombre_foto != '') {
            $destino = 'images/img_material/';
            $img_nombre = 'img_'.md5(date('d-m-Y H:m:s'));
            $imgProducto = $img_nombre.'.jpg';
            $src = $destino.$imgProducto;
        }
    // hacer una consulta que se guarda en la variable query checa si no se repiten los siguientyes datos en la db
        

            $query_insert = mysqli_query($conexion,"INSERT INTO material(area, descripcion, unidad, cantidad, observaciones, foto)
                VALUES ($area,'$descripcion','$unidad',$cantidad,'$observaciones','$imgProducto')");
        
            mysqli_close($conexion);
            if ($query_insert) {

                if ($nombre_foto != '') {
                    move_uploaded_file($url_temp, $src);
                    # code...
                }

                                                $alerta = "<script>
                                                Swal.fire(
                                                '¡Guardado!',
                                                'Material guarado correctamente',
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
  text: 'Error al guardar el Material'
            })
        </script>";
                
            

        }

    }
}



?>
<html class="no-js" lang=""> 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registro material</title>
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
                                    <li><a href="#">Materiales</a></li>
                                    <li class="active">Nuevo</li>
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
                                <strong class="card-title">Material</strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center">Registro material</h3>
                                        </div>
                                        <hr>
                                        <?php echo isset($alerta) ? $alerta :""; ?>

                                        <form action="" method="post" enctype="multipart/form-data">

                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="descripcion" class="control-label mb-1">Descripción</label>
                                                        <textarea name="descripcion" id="descripcion" rows="9" placeholder="Descripción del equipo" class="form-control" style="height: 80px;" required/></textarea>
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="observaciones" class="control-label mb-1">Observaciones</label>
                                                        <textarea name="observaciones" id="observaciones" rows="9" placeholder="Observaciones" class="form-control" style=" height: 80px;" required/></textarea>
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>


                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="unidad" class="control-label mb-1">Unidad</label>
                                                        <input id="unidad" name="unidad" type="text" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Unidad" required/>
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

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="area" class="control-label mb-1">Área</label>

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

                                                <div class="col-6">
                                                    <div class="form-group">

                                                        <div class="photo">
                                                        <label class="label" for="foto">Foto</label>
                                                        <div class="prevPhoto">
                                                        <span class="delPhoto notBlock">X</span>
                                                        <label for="foto"></label>
                                                        </div>
                                                        <div class="upimg">
                                                        <input type="file" name="foto" id="foto">
                                                        </div>
                                                        <div id="form_alert"></div>
                                                        </div>

                                                    <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>


                                            </div>
                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    <span id="payment-button-amount">Guardar Material</span>
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