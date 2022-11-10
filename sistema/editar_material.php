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
    if (empty($_POST['descripcion']) || empty($_POST['unidad']) || empty($_POST['cantidad']) || empty($_POST['observaciones']) || empty($_POST['area']) ||  empty($_POST['foto_actual']) || empty($_POST['foto_remove']) || $_POST['cantidad'] <= 0) {
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

        $idMaterila = $_POST['id'];

        // si no entoce si no estan vacio los campos guardar los dats en las siguientes variables 
        //lo que viene en el metodo post
        $descripcion = $_POST['descripcion'];
        $cantidad = $_POST['cantidad'];
        $unidad = $_POST['unidad'];
        $observaciones = $_POST['observaciones'];
        $area = $_POST['area'];
        $usuario_id = $_SESSION['idUser'];

        $imgProducto = $_POST['foto_actual'];
        $imgRemove = $_POST['foto_remove'];
        

        $foto = $_FILES['foto'];
        $nombre_foto = $foto['name'];
        $type = $foto['type'];
        $url_temp = $foto['tmp_name'];

        $upd = '';

        if ($nombre_foto != '') {
            $destino = 'images/img_material/';
            $img_nombre = 'img_'.md5(date('d-m-Y H:m:s'));
            $imgProducto = $img_nombre.'.jpg';
            $src = $destino.$imgProducto;
        }
        else{

            if ($_POST['foto_actual'] != $_POST['foto_remove']) {
                $imgProducto = 'img_producto.png';
            }
        }
    // hacer una consulta que se guarda en la variable query checa si no se repiten los siguientyes datos en la db
        

            $query_update = mysqli_query($conexion,"UPDATE material
                                                            SET area = '$area',
                                                                descripcion= '$descripcion',
                                                                unidad = '$unidad',
                                                                cantidad = $cantidad,
                                                                observaciones = '$observaciones',
                                                                foto = '$imgProducto'
                                                                WHERE idmaterial = $idMaterila"
                                                                );
            if ($query_update) {

                if (($nombre_foto != '' && ($_POST['foto_actual'] != 'img_producto.png')) || ($_POST['foto_actual'] != $_POST['foto_remove'])) {

                    unlink('images/img_material/'.$_POST['foto_actual']);
                }

                if ($nombre_foto != '') {
                    move_uploaded_file($url_temp, $src);
                    # code...
                }
                    $alerta="<script>
                                    Swal.fire(
                                    '¡Actualizado!',
                                    'Material actualizado correctamente',
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
                            text: 'Error al actualizar el material'
                            })
                            </script>";
            }

            
    



    }


}









/**********************************MOSTRAR  LA INFORMACION************************************************/
if (empty($_REQUEST['id'])) {

    header("location: lista_material.php");
}else{

    $id_material = $_REQUEST['id'];

    if (!is_numeric($id_material)) {
        header("location: lista_material.php");
    }

    $query_material = mysqli_query($conexion,"SELECT material.idmaterial,material.area, area.area AS nombrearea, material.descripcion, material.cantidad, material.unidad, material.observaciones, material.foto
                    FROM material
                    INNER JOIN area ON material.area = area.idarea WHERE material.idmaterial = $id_material");

    $result_material = mysqli_num_rows($query_material);

    $foto = '';
    $classRemove = 'notBlock';

    if ($result_material > 0) {
        // TOMAR LOS DATOS QUE TRAE LA QUERY PARA PONERLOS EN LA VARIABLE $data_producto//
        $data_material = mysqli_fetch_assoc($query_material);


        if ($data_material['foto'] != 'img_producto.png') {
            $classRemove = '';
            $foto = '<img id="img"src ="images/img_material/'.$data_material['foto'].'" alt = "Producto">';
        }

        
    }
    else{
        header("location: lista_material.php");
    }
}


 ?>

<html class="no-js" lang=""> 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Editar material</title>
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
                                    <li><a href="#">Material</a></li>
                                    <li class="active">Editar material</li>
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
                                            <h3 class="text-center">Actualizar material</h3>
                                        </div>
                                        <hr>
                                        <?php echo isset($alerta) ? $alerta :""; ?>

                                        <form action="" method="post" enctype="multipart/form-data">

                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                <input type="hidden" name="id" value="<?php echo $data_material['idmaterial']; ?>">

                <input type="hidden" id="foto_actual" name="foto_actual" value="<?php echo $data_material['foto']; ?>">
                <input type="hidden" id="foto_remove" name="foto_remove" value="<?php echo $data_material['foto']; ?>">

                                                        <label for="descripcion" class="control-label mb-1">Descripción</label>
                                                        <textarea name="descripcion" id="descripcion" rows="9" placeholder="Descripción del equipo" class="form-control" style="height: 80px;" required/><?php echo $data_material['descripcion']; ?></textarea>
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="observaciones" class="control-label mb-1">Observaciones</label>
                                                        <textarea name="observaciones" id="observaciones" rows="9" placeholder="Observaciones" class="form-control" style=" height: 80px;" required/><?php echo $data_material['observaciones']; ?></textarea>
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>


                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="unidad" class="control-label mb-1">Unidad</label>
                                                        <input id="unidad" name="unidad" type="text" class="form-control cc-exp" value="<?php echo $data_material['unidad']; ?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Unidad" required/>
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cantidad" class="control-label mb-1">Cantidad</label>
                                                        <input id="cantidad" name="cantidad" type="number" class="form-control cc-exp" value="<?php echo $data_material['cantidad']; ?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Cantidad" required/>
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="area" class="control-label mb-1">Área</label>

                <?php 
                
                $query_area = mysqli_query($conexion, "SELECT * FROM area"); 
                $result_area = mysqli_num_rows($query_area);
                mysqli_close($conexion);
                ?>
                                                <select name="area" id="area" class="notItemOne">
                                                    <option value="<?php echo $data_material['area']; ?>" selected><?php echo $data_material['nombrearea'];?></option>
                    <?php 

                        if ($result_area > 0) {
                            while ($area = mysqli_fetch_array($query_area)) {

                    ?>

                    <option value="<?php echo $area['idarea']; ?>"><?php echo $area['area']; ?></option>
                    
                    <?php 
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
                                                        <span class="delPhoto <?php echo $classRemove; ?>">X</span>
                                                        <label for="foto"></label>
                                                        <?php echo $foto; ?>
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
                                                    <span id="payment-button-amount">Actualizar Material</span>
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
