<?php 
session_start(); 

if ($_SESSION['rol']!=1 and $_SESSION['rol']!=3) {
    
    header("location: ./");
}


include"../conexion.php";
 ?>
<!doctype html>
<html class="no-js" lang=""> 
<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Prestamo de equipo</title>
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
                                    <li><a href="#">Prestamo</a></li>
                                    <li class="active">Nuevo prestamo</li>
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
                                <strong class="card-title">PRESTAMO EQUIPOS</strong>
                            </div>
                            <div class="card-body">
                                
                                <table id="tabla" class="table table-striped table-bordered">
                                    
                                        

                                    <thead>
                                        <tr>
                                            
                                            <th><div id="div">DESCRIPCIÓN</div></th>
                                            <th><div id="div">STOCK</div></th>
                                            <th><div id="div">PRESTADOS</div></th>
                                            <th><div id="div">MARCA</div></th>
                                            <th><div id="div">MODELO</div></th>
                                            <th><div id="div">NºSERIE</div></th>
                                            <th><div id="div">OBSERVACIÓN</div></th>
                                            <th><div id="div">IMAGEN</div></th>
                                            <th><div id="div">ACCIÓN</div></th>
                                            
                                          
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                $query = mysqli_query($conexion, "SELECT equipo.idequipo,equipo.descripcion, equipo.cantidad, equipo.marca,equipo.modelo, equipo.numeroserie, equipo.observaciones, equipo.foto, SUM(prestamo.cantidadprestado) from equipo LEFT JOIN prestamo ON equipo.idequipo=prestamo.equipo GROUP by equipo.idequipo");

                mysqli_close($conexion);

                $result = mysqli_num_rows($query);

                $datos = mysqli_fetch_all($query, MYSQLI_ASSOC);

                                         if ($result > 0) {

                                            foreach ($datos as $datos) {

                                                if ($datos['foto'] != 'img_producto.png') {
                                                     $foto = 'images/img_equipo/'.$datos['foto'];
                        
                                                            }else{$foto = 'images/'.$datos['foto'];}
                                                    
                                                 ?>
                                                <tr>
                                    
                                    <td><div id="div"><?php echo nl2br($datos['descripcion'])  ?></div></td>
                                    <td><div id="div"><?php echo $datos['cantidad'] ?></div></td>
                                    <td><div id="div"><?php echo $datos['SUM(prestamo.cantidadprestado)'] ?></div></td>
                                    <td><div id="div"><?php echo $datos['marca'] ?></div></td>
                                    <td><div id="div"><?php echo $datos['modelo'] ?></div></td>
                                    <td><div id="div"><?php echo $datos['numeroserie'] ?></div></td>
                                    <td><div id="div"><?php echo nl2br($datos['observaciones'])  ?></div></td>
                                    <td><div id="div"><img class="img_producto" src="<?php echo $foto; ?>" alt="<?php echo $datos["descripcion"];?>"></div></td>

                                    <td><button class = "link_edit" > <a  href="confirmar_prestamo.php? id= <?php echo $datos["idequipo"];?>"><i class="fa  fa-share-square" style="color: white;"></i> </a></button></td>
                                                   
                                                
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
                               ¿Desea eliminar este usuario?
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
    <script src="js/function.js"></script>

  


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
  </script>
 

   
 
</body>
</html>
