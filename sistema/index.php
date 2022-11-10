<?php session_start(); 
if ($_SESSION['rol'] == 2) {
    header('location: registro_practica.php');
}
?>



<!doctype html>
<html class="no-js" lang=""> 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Inicio</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include "includes/script.php"; ?>
</head>  
<body>

 <!-- /#left-panel -->
    <?php include "includes/left-panel.php"; ?>
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">

        <?php include "includes/header.php"; ?>

        <div class="content">
           
            <div class="animated fadeIn">
                <?php include "includes/widgets.php"; ?>
               
            </div>
            
        </div>

        <div class="clearfix"></div>

        

     <?php include "includes/footer.php"; ?>

    </div>


   
 
</body>
</html>
