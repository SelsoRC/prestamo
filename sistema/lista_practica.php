<?php session_start(); 
$idUsuario = $_SESSION['idUser'];

include"../conexion.php";


 ?>
<!doctype html>
<html class="no-js" lang=""> 
<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lista de practicas</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link rel="stylesheet" type="text/css" href="css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <script src="sweetalert2/jquery.min.js"></script>
    <script src="sweetalert2/sweetalert2.all.min.js"></script>
       
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
                                    <li><a href="#">Practicas</a></li>
                                    <li class="active">Lista de Practicas</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
           
            <div class="animated fadeIn">

               <!--  INCIA LA TABLA ------------------------------------------------------------------------------- -->

                 <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">PR??CTICAS</strong>
                            </div>
                            <div > 
                                <?php if ($_SESSION['rol']==1 or $_SESSION['rol'] ==3) {
                                    // code...
                                ?>
                             <form action="pdf2/reporte_practicas.php" method="POST" target="_blank">
                                <label>Fecha</label>
                                <input class="fecha" type="date" name="fecha1">
                                <label>a</label>
                                <input class="fecha" type="date" name="fecha2" >
                                                   <?php 
                    
                    $query_area = mysqli_query($conexion,"SELECT * FROM area");
                    $resultado_area = mysqli_num_rows($query_area);


                     ?>

                    <select name="area" id="area" class="fecha">
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


                                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-print" style="color: white;"></i> Generar reporte</button>

                                <a href="registro_practica.php"><button type="button" class="btn btn-success btn-sm"><i class="fa fa-plus-circle" style="color: white;"></i></button></a>
                            </form>   

                            <?php } ?> 
                            </div>
                          
                          
                            <div class="card-body">

                                <table id="tabla" class="table table-striped table-bordered">

                                    <thead>
                                        <tr>
                                            <th><div id="div">FECHA</div></th>
                                            <th><div id="div">HORA ENTRADA</div></th>
                                            <th><div id="div">HORA SALIDA</div></th>
                                            <th><div id="div">MATERIA</div></th>
                                            <th><div id="div">RESPONSABLE</div></th>
                                            <th><div id="div">GRUPO</div></th>
                                            <th><div id="div">CARRERA</div></th>
                                            <th><div id="div">N??</div></th>
                                            <th><div id="div">NOMBRE PRACTICA</div></th>
                                            <th><div id="div">ACCIONES</div></th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        if(isset($_SESSION['msj_practica'])){
                                        echo "<script>
                                                Swal.fire(
                                                '??Eliminado!',
                                                'Pr??ctica eliminada',
                                                'success' 
                                                         )
                                            </script>";
                                            unset($_SESSION['msj_practica']);
                                                }

                                        if(isset($_SESSION['registro_practica'])){
                                        echo "<script>
                                                Swal.fire(
                                                '??Registrada!',
                                                'Pr??ctica registrada correctamente',
                                                'success' 
                                                         )
                                            </script>";
                                            unset($_SESSION['registro_practica']);
                                                }


                                        if ($_SESSION['rol'] == 2) {

                                            $query = mysqli_query($conexion, "SELECT p.idpractica, p.fecha, p.horaentrada, p.horasalida, p.materia, u.nombre, p.grupo, p.carrera, p.numeropractica, p.nombrepractica FROM practica p INNER JOIN usuario u ON p.usuario = u.idusuario WHERE p.usuario = $idUsuario");
                                            
                                        }else{

                                            $query = mysqli_query($conexion, "SELECT p.idpractica, p.fecha, p.horaentrada, p.horasalida, p.materia, u.nombre, p.grupo, p.carrera, p.numeropractica, p.nombrepractica 
                                                FROM practica p 
                                                INNER JOIN usuario u ON p.usuario = u.idusuario");

                                        }


                mysqli_close($conexion);

                $result = mysqli_num_rows($query);

                $datos = mysqli_fetch_all($query, MYSQLI_ASSOC);

                                         if ($result > 0) {

                                            foreach ($datos as $datos) {
                                                    
                                                 ?>
                                                <tr>
                                                    <td><div id="div"><?php echo $datos['fecha'] ?></div></td>
                                                    <td><div id="div"><?php echo $datos['horaentrada'] ?></div></td>     
                                                    <td><div id="div"><?php echo $datos['horasalida'] ?></div></td>
                                                    <td><div id="div"><?php echo $datos['materia'] ?></div></td>
                                                    <td><div id="div"><?php echo $datos['nombre'] ?></div></td>
                                                    <td><div id="div"><?php echo $datos['grupo'] ?></div></td>
                                                    <td><div id="div"><?php echo $datos['carrera'] ?></div></td>
                                                    <td><div id="div"><?php echo $datos['numeropractica'] ?></div></td>
                                                    <td><div id="div"><?php echo $datos['nombrepractica'] ?></div></td>

                                                    <td> 
                                                        <?php if ($datos['horasalida']!='00:00:00') {  ?>
                                                        <p>
                                                            <button type="button" class="btn btn-danger"><a  href="eliminar_practica.php? id= <?php echo $datos["idpractica"];?>" class="delete" style="color: white;">Eliminar</a></button>
                                                        </p>

                                                    <?php } ?>
                                                        

                                                        <?php if ($datos['horasalida']=='00:00:00') { ?>
                                                            <button type="button" class="btn btn-success"><a  href="editar_practica.php? id= <?php echo $datos["idpractica"];?>" style="color: white;">Terminar</a></button>

                                                        
                                                    <?php } ?>
                                                        
                                                    </td>                              

                                                </tr>
                                            <?php } 

                                        }?>
                                        </tbody>


                                </table>
                            </div>
                        </div>
                    </div>


                </div>

<!-------------------------------------------------------------------------------------------------------->

            </div>
            
        </div>

        <div class="clearfix"></div>
        <?php include "includes/footer.php"; ?>


    </div>

<!-- ---------------------------------------------Eliminar modal  ---------------->
<!--         <form>
            <div class="modal fade" id="eliminar" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content"> 

                        <div class="modal-header">
                            <h5 class="modal-title" id="staticModalLabel">Eliminar usuario</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <p>
                               ??Desea eliminar este usuario?
                            </p>
                            <input type="text" name="id" id="delete_id">
                        </div>
                       
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary">Confirm</button>
                        </div>    
                    </div>
                </div>
            </div>
        </form> -->
        <!-- ---------------------------------------------Eliminar modal  ---------------->






    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="assets/js/lib/data-table/datatables.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/jszip.min.js"></script>
    <script src="assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="assets/js/init/datatables-init.js"></script>


  


    <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
          
      } ); 

      $(document).ready(function() {

    $('#tabla').DataTable( {

        "language": {
            "lengthMenu": "Mostrar "+
            '<select class = custom-select custom-select-sm form-control form-control-sm>'+ 
            '<option value = 10>10</option>'+
            '<option value = 25>25</option>'+
            '<option value = 50>50</option>'+
            '<option value = 100>100</option>'+
            '<option value = -1>todo</option>'+
            '</select>'+" Registros",

            "zeroRecords": "No encontrado - Disculpa",
            "info": "Mostrando la pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(Filtrado de _MAX_ registros totales)",
            "search": "Buscar:",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    } );
} ); 

    $('.delete').on('click', function(e) {
      e.preventDefault(); 
      const href = $(this).attr('href')

      Swal.fire({
      title: '!Eliminar??',
      text: '??Desea eliminar esta pr??ctica?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Eliminar',
      cancelButtonText: 'Cancelar'
    }).then((result)=> {
      if (result.isConfirmed) {
        document.location.href = href;
        
      }
    })

    })


  </script>
 

   
 
</body>
</html>
