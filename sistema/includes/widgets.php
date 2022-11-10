<?php
if (empty($_SESSION['active'])) {

    header('location: ../');
}


?>
                <div class="row">

                     <div class="col-lg-3 col-md-6">
                        <a href="lista_practica.php">
                        <div class="card">
                            <div class="card-body" style="background: #27a9e3; border-radius: 5px;">
                                <div class="stat-widget-five">
                                    <div class="stat-icon" style="color:white;">
                                        <i class="menu-icon fa fa-flask"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span></span></div>
                                            <div class="stat-heading" style="color: white; "> <i class="menu-icon fa fa-list"></i> LISTA DE PRÁCTICAS</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <a href="lista_usuario.php">
                        <div class="card">
                            <div class="card-body" style="background: #66cdaa; border-radius: 5px;">
                                <div class="stat-widget-five">
                                    <div class="stat-icon" style="color: white; ">
                                        <i class="menu-icon fa fa-group "></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span></span></div>
                                            <div class="stat-heading" style="color: white; "> <i class="menu-icon fa fa-list"></i> LISTA DE USUARIOS</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>


                    <div class="col-lg-3 col-md-6">
                        <a href="lista_material.php">
                        <div class="card">
                            <div class="card-body" style="background: #20b2aa; border-radius: 5px;">
                                <div class="stat-widget-five">
                                    <div class="stat-icon" style="color: white;">
                                        <i class="menu-icon fa fa-briefcase"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span></span></div>
                                            <div class="stat-heading" style="color: white; "> <i class="menu-icon fa fa-list"></i> LISTA DE MATERIALES</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <a href="lista_equipo.php">
                        <div class="card">
                            <div class="card-body" style="background: #4682b4; border-radius: 5px;">
                                <div class="stat-widget-five">
                                    <div class="stat-icon" style="color: white;">
                                        <i class="menu-icon fa fa-desktop"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span></span></div>
                                            <div class="stat-heading" style="color: white; "> <i class="menu-icon fa fa-list"></i> LISTA DE EQUIPOS</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>


                    <div class="col-lg-3 col-md-6">
                        <a href="lista_estudiante.php">
                        <div class="card">
                            <div class="card-body" style="background: #6a5acd; border-radius: 5px;">
                                <div class="stat-widget-five">
                                    <div class="stat-icon" style="color: white;">
                                        <i class="menu-icon fa fa-user"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span></span></div>
                                            <div class="stat-heading" style="color: white;"> <i class="menu-icon fa fa-list"></i> LISTA DE ALUMNOS</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>




                    <div class="col-lg-3 col-md-6">
                        <a href="prestamo_equipo.php">
                        <div class="card">
                            <div class="card-body" style="background: #00ced1; border-radius: 5px;">
                                <div class="stat-widget-five">
                                    <div class="stat-icon" style="color: white;">
                                        <i class="menu-icon fa  fa-tags"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span></span></div>
                                            <div class="stat-heading" style="color: white;"> <i class="menu-icon fa fa-plus-square"></i> REALIZAR PRÉSTAMO</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <a href="registro_estudiante.php">
                        <div class="card">
                            <div class="card-body" style="background: #6a5acd; border-radius: 5px;">
                                <div class="stat-widget-five">
                                    <div class="stat-icon" style="color: white;">
                                        <i class="menu-icon fa fa-user"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span></span></div>
                                            <div class="stat-heading" style="color: white;"> <i class="menu-icon fa fa-plus-square"></i> AGREGAR ALUMNOS</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>





                <div class="col-lg-3 col-md-6">
                        <a href="registro_usuario.php">
                        <div class="card">
                            <div class="card-body" style="background: #66cdaa; border-radius: 5px;">
                                <div class="stat-widget-five">
                                    <div class="stat-icon" style="color: white;">
                                        <i class="menu-icon fa fa-group"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span></span></div>
                                            <div class="stat-heading" style="color:white ;"> <i class="menu-icon fa fa-plus-square"></i> AGREGAR USUARIOS</div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>


                    <div class="col-lg-3 col-md-6" >
                        <a href="registro_practica.php">
                        <div class="card">
                            <div class="card-body" style="background: #27a9e3; border-radius: 5px;">
                                <div class="stat-widget-five">
                                    <div class="stat-icon " style="color:white;">
                                        <i class="menu-icon fa fa-flask"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span></span></div>
                                            <div class="stat-heading" style="color:white;"> <i class="menu-icon fa fa-plus-square"></i> NUEVA PRÁCTICA</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <a href="registro_material.php">
                        <div class="card">
                            <div class="card-body" style="background: #20b2aa; border-radius: 5px;">
                                <div class="stat-widget-five">
                                    <div class="stat-icon" style="color: white;">
                                        <i class="menu-icon fa fa-briefcase"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span></span></div>
                                            <div class="stat-heading" style="color: white;"> <i class="menu-icon fa fa-plus-square"></i> AGREGAR MATERIALES</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>

                    
                <div class="col-lg-3 col-md-6">
                    <a href="registro_equipo.php">
                        <div class="card card-hover">
                            <div class="card-body" style="background: #4682b4; border-radius: 5px;">
                                <div class="stat-widget-five">
                                    <div class="stat-icon" style="color: white;">
                                        <i class="menu-icon fa fa-desktop"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span></span></div>
                                            <div class="stat-heading" style="color: white;"> <i class="menu-icon fa fa-plus-square"></i> AGREGAR EQUIPOS</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </a>
                    </div>


                        
                </div>

