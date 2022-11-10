
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
    if (empty($_POST['descripcion']) || empty($_POST['cantidad']) || empty($_POST['marca']) || empty($_POST['modelo']) || empty($_POST['serie']) || empty($_POST['observaciones']) || empty($_POST['categoria']) || empty($_POST['foto_actual']) || empty($_POST['foto_remove']) || $_POST['cantidad'] <= 0) {
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

        $idEquipo = $_POST['id'];
        $cantidad_move = $_POST['cantidad'];

        $query_prestamo = mysqli_query($conexion,"SELECT SUM(cantidadprestado) FROM prestamo WHERE equipo = $idEquipo");

        $datos_prestamo = mysqli_fetch_array($query_prestamo);


        if ($cantidad_move>=$datos_prestamo['SUM(cantidadprestado)']) {

        // si no entoce si no estan vacio los campos guardar los dats en las siguientes variables 
        //lo que viene en el metodo post
        $descripcion = $_POST['descripcion'];
        $area = $_POST['area'];
        $cantidad = $_POST['cantidad'];
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $numeroserie = $_POST['serie'];
        $observaciones = $_POST['observaciones'];
        $categoria = $_POST['categoria']; 
        $usuario_id = $_SESSION['idUser'];

        $imgProducto = $_POST['foto_actual'];
        $imgRemove = $_POST['foto_remove'];
        

        $foto = $_FILES['foto'];
        $nombre_foto = $foto['name'];
        $type = $foto['type'];
        $url_temp = $foto['tmp_name'];

        $upd = '';

        if ($nombre_foto != '') {
            $destino = 'images/img_equipo/';
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
        

            $query_update = mysqli_query($conexion,"UPDATE equipo
                                                            SET descripcion = '$descripcion',
                                                                cantidad= $cantidad,
                                                                marca = '$marca',
                                                                modelo = '$modelo',
                                                                numeroserie = '$numeroserie',
                                                                observaciones = '$observaciones',
                                                                categoria = $categoria,
                                                                area = $area,
                                                                foto = '$imgProducto'
                                                                WHERE idequipo = $idEquipo"
                                                                );
            if ($query_update) {

                if (($nombre_foto != '' && ($_POST['foto_actual'] != 'img_producto.png')) || ($_POST['foto_actual'] != $_POST['foto_remove'])) {

                    unlink('images/img_equipo/'.$_POST['foto_actual']);
                }

                if ($nombre_foto != '') {
                    move_uploaded_file($url_temp, $src);
                    # code...
                }

                                    $alerta="<script>
                                    Swal.fire(
                                    '¡Actualizado!',
                                    'Equipo actualizado correctamente',
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
                            text: 'Error al actualizar'
                            })
                            </script>";
            

            }

            
        }else{

                        $alerta = "<script>
                            Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Hay equipos prestados'
                            })
                            </script>";

        }



    }


}









/**********************************MOSTRAR  LA INFORMACION************************************************/
if (empty($_REQUEST['id'])) {

    header("location: lista_equipo.php");
}else{

    $id_equipo = $_REQUEST['id'];

    if (!is_numeric($id_equipo)) {
        header("location: lista_equipo.php");
    }

    $query_equipo = mysqli_query($conexion,"SELECT p.idequipo,p.descripcion,p.cantidad,p.marca,p.modelo,p.numeroserie,p.observaciones,p.foto,pr.idcategoria,pr.categoria,a.idarea,a.area 
FROM equipo p 
INNER JOIn categoria pr ON p.categoria = pr.idcategoria
INNER JOIN area a ON p.area = a.idarea
WHERE p.idequipo = $id_equipo;");

    $result_equipo = mysqli_num_rows($query_equipo);

    $foto = '';
    $classRemove = 'notBlock';

    if ($result_equipo > 0) {
        // TOMAR LOS DATOS QUE TRAE LA QUERY PARA PONERLOS EN LA VARIABLE $data_producto//
        $data_equipo = mysqli_fetch_assoc($query_equipo);


        if ($data_equipo['foto'] != 'img_producto.png') {
            $classRemove = '';
            $foto = '<img id="img"src ="images/img_equipo/'.$data_equipo['foto'].'" alt = "Producto">';
        }

        
    }
    else{
        header("location: lista_equipo.php");
    }
}


 ?>

<html class="no-js" lang=""> 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Editar Equipo</title>
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
                                    <li><a href="#">Equipos</a></li>
                                    <li class="active">Editar Equipo</li>
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
                                <strong class="card-title">Equipo</strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center">Actualizar equipo</h3>
                                        </div>
                                        <hr>
                                        <?php echo isset($alerta) ? $alerta :""; ?>

                                        <form action="" method="post" enctype="multipart/form-data">

                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">

                <input type="hidden" name="id" value="<?php echo $data_equipo['idequipo']; ?>">

                <input type="hidden" id="foto_actual" name="foto_actual" value="<?php echo $data_equipo['foto']; ?>">
                <input type="hidden" id="foto_remove" name="foto_remove" value="<?php echo $data_equipo['foto']; ?>">

                                                        <label for="descripcion" class="control-label mb-1">Descripción</label>
                                                        <textarea name="descripcion" id="descripcion" rows="9" placeholder="Descripción del equipo" class="form-control" style="height: 80px;" required/><?php echo $data_equipo['descripcion']; ?></textarea>
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="observaciones" class="control-label mb-1">Observaciones</label>
                                                        <textarea name="observaciones" id="observaciones" rows="9" placeholder="Observaciones" class="form-control" style=" height: 80px;" required/><?php echo $data_equipo['observaciones']; ?></textarea>
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>


                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cantidad" class="control-label mb-1">Cantidad</label>
                                                        <input id="cantidad" name="cantidad" type="number" class="form-control cc-exp" value="<?php echo $data_equipo['cantidad']; ?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Cantidad" required/>
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="marca" class="control-label mb-1">Marca</label>
                                                        <input id="marca" name="marca" type="text" class="form-control cc-exp" value="<?php echo $data_equipo['marca']; ?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Marca" required/>
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="modelo" class="control-label mb-1">Modelo</label>
                                                        <input id="modelo" name="modelo" type="text" class="form-control cc-exp" value="<?php echo $data_equipo['modelo']; ?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Modelo" required/>
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>


                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="serie" class="control-label mb-1">Nº Serie</label>
                                                        <input id="serie" name="serie" type="text" class="form-control cc-exp" value="<?php echo $data_equipo['numeroserie']; ?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="serie" required/>
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>


                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="area" class="control-label mb-1">Área</label>



                <?php 
                
                $query_area = mysqli_query($conexion, "SELECT * FROM area"); 
                $result_area = mysqli_num_rows($query_area);
                
                ?>

                                                <select name="area" id="area" class="notItemOne" >
                    <option value="<?php echo $data_equipo['idarea']; ?>" selected><?php echo $data_equipo['area'];?></option>
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
                            <label for="categoria" class="control-label mb-1">Categoría</label>

                <?php 
                
                $query_categoria = mysqli_query($conexion, "SELECT idcategoria, categoria FROM categoria"); 
                $result_categoria = mysqli_num_rows($query_categoria);
                
                ?>
                                                <select name="categoria" id="categoria" class="notItemOne">
                    <option value="<?php echo $data_equipo['idcategoria']; ?>" selected><?php echo $data_equipo['categoria']; ?></option>
                    <?php 

                        if ($result_categoria > 0) {
                            while ($categoria = mysqli_fetch_array($query_categoria)) {

                    ?>

                    <option value="<?php echo $categoria['idcategoria']; ?>"><?php echo $categoria['categoria']; ?></option>
                    
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
                                                    <span id="payment-button-amount">Actualizar Equipo</span>
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
