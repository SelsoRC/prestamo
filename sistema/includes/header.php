   <?php 
   
$num_rol = $_SESSION['rol'];
$rol;

if ($num_rol==2) {
    $rol = "Docente";    
}elseif ($num_rol == 1) {
    $rol = "Administrador";
}
elseif ($num_rol == 3) {
    $rol = "Residente";
}

 ?>
   <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="letra" href="./"><img src="images/sistemas.png" style="width: 50px; height: auto;">ISC-INVENTARIO</a>
                    <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">

                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/admin.png" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa-user"></i> <?php echo $_SESSION['user']; ?> </a>

                            <a class="nav-link" href="#"><i class="fa  fa-tag"></i><?php echo $rol; ?></a>

                            <a class="nav-link" href="salir.php"><i class="fa fa-power-off"></i>Salir</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>