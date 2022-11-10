<?php 

if (empty($_SESSION['active'])) {
    
    header('location: ../');
}



 ?>

 <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="index.php"><i class="menu-icon fa  fa-home"></i>Inicio </a>
                    </li>

                    <li class="menu-title">Herramientas</li><!-- /.menu-title -->

                    <li class="menu-item-has-children dropdown">

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-group "></i>Usuarios</a>
                        <ul class="sub-menu children dropdown-menu">                            
                            <li><i class="fa fa-plus-square"></i><a href="registro_usuario.php">Nuevo Usuario</a></li>
                            <li><i class="fa fa-list"></i><a href="lista_usuario.php">Lista de Usuarios</a></li>

                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user"></i>Alumnos</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus-square"></i><a href="registro_estudiante.php">Nuevo Alumno</a></li>
                            <li><i class="fa fa-list"></i><a href="lista_estudiante.php">Lista de Alumnos</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-briefcase"></i>Materiales</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-plus-square"></i><a href="registro_material.php">Nuevo</a></li>
                            <li><i class="menu-icon fa fa-list"></i><a href="lista_material.php">Lista de materiales</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-desktop"></i>Equipos</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-plus-square"></i><a href="registro_equipo.php">Nuevo</a></li>
                            <li><i class="menu-icon fa fa-list"></i><a href="lista_equipo.php">Lista de Equipos</a></li>
                        </ul>
                    </li>

                     <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-calendar"></i>Préstamo</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-plus"></i><a href="prestamo_equipo.php"> Nuevo prestamo</a></li>
                            <li><i class="menu-icon fa  fa-list"></i><a href="lista_prestamo.php">Equipos prestados</a></li>
                            <li><i class="menu-icon fa  fa-list"></i><a href="lista_historial.php">Historial</a></li>
                        </ul>
                    </li>


                     <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-flask"></i>Prácticas</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-plus"></i><a href="registro_practica.php">Nueva Practica</a></li>
                            <li><i class="menu-icon fa fa-list"></i><a href="lista_practica.php">Lista de practicas</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-gears"></i>Configuración</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-refresh"></i><a href="datos_reporte.php">Datos Reporte</a></li>
                        
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>