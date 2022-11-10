<?php 
 session_start(); 

if ($_SESSION['rol']!=3 and $_SESSION['rol'] !=1) {
    
    header('location: ../');
}


include('pdf_mc_historial.php');
require 'conexion2.php';

    $sql = sprintf("SELECT historial.idhistorial, equipo.descripcion, equipo.foto, estudiante.nombre, estudiante.numerocontrol, usuario.usuario,historial.fecha, historial.cantidadprestado 
                    FROM historial 
                    INNER JOIN estudiante ON historial.estudiante = estudiante.idestudiante 
                    INNER JOIN equipo ON historial.equipo = equipo.idequipo 
                    INNER JOIN usuario ON historial.usuario = usuario.idusuario");

    $query = $mysqli->query($sql);
    
    $arreglo = array();
    $json ='';
    
    while($rows = $query->fetch_array()) {
        
        $arreglo []= array(
                    'Descripcion' => $rows['descripcion'],
                    'Usuario' => $rows['usuario'],
                    'Fecha' => $rows['fecha'],
                    'Cantidad' => $rows['cantidadprestado'],
                    'Nombre' => $rows['nombre'],
                    'Matricula' => $rows['numerocontrol'],
                    );
    }
    

    $json = json_encode($arreglo);
    
//make new object
$pdf = new PDF_MC_Table();

//add page, set font
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetFont('Arial','',14);

//set width for each column (6 columns)
$pdf->SetWidths(Array(50,20,20,30,40,30));

//set alignment
//$pdf->SetAligns(Array('','R','C','','',''));

//set line height. This is the height of each lines, not rows.
$pdf->SetLineHeight(5);

//load json data
$data = json_decode($json,true);


//add table heading using standard cells
//set font to bold
$pdf->SetFont('Arial','B',10);
$pdf->Cell(50,5,utf8_decode("EQUIPO"),1,0);
$pdf->Cell(20,5,utf8_decode("USUARIO"),1,0);
$pdf->Cell(20,5,"FECHA",1,0);
$pdf->Cell(30,5,"CANTIDAD",1,0);
$pdf->Cell(40,5,"ESTUDIANTE",1,0);
$pdf->Cell(30,5,utf8_decode("MATRICULA"),1,0);

$pdf->Ln();

//reset font
$pdf->SetFont('Arial','',8);
//loop the data
$item = 2;
foreach($data as $item){
    //write data using Row() method containing array of values.
    $pdf->Row(Array(
        utf8_decode($item['Descripcion']),
        utf8_decode($item['Usuario']),
        $item['Fecha'],
        utf8_decode($item['Cantidad']),
        utf8_decode($item['Nombre']),
        utf8_decode($item['Matricula']),

    ));
    
}


//output the pdf
$pdf->Output();



 


 ?>