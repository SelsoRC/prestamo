<?php 
session_start();
if ($_SESSION['rol']!=3 and $_SESSION['rol'] !=1) {
    
    header('location: ../');
}

include('pdf_mc_prestamo.php');
require 'conexion2.php';

    $sql = "SELECT * FROM reporte ";

    $query_encargado = $mysqli->query($sql);
    $datos = $query_encargado->fetch_array();




    $sql = sprintf("SELECT prestamo.idprestamo, equipo.descripcion, equipo.marca,equipo.modelo,equipo.numeroserie, estudiante.nombre, estudiante.numerocontrol, usuario.usuario,prestamo.fecha, prestamo.cantidadprestado 
                    FROM prestamo 
                    INNER JOIN estudiante ON prestamo.estudiante = estudiante.idestudiante 
                    INNER JOIN equipo ON prestamo.equipo = equipo.idequipo 
                    INNER JOIN usuario ON prestamo.usuario = usuario.idusuario");

    $query = $mysqli->query($sql);
    mysqli_close($mysqli);
    
    $arreglo = array();
    $json ='';
    
    while($rows = $query->fetch_array()) {
        
        $arreglo []= array(
                    'Descripcion' => $rows['descripcion'],
                    'Marca' => $rows['marca'],
                    'Nombre' => $rows['nombre'],
                    'Nº control' => $rows['numerocontrol'],
                    'Usuario' => $rows['usuario'],
                    'Fecha' => $rows['fecha'],
                    'Cantidad' => $rows['cantidadprestado']
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
$pdf->SetWidths(Array(50,20,40,20,20,20,20));

//set alignment
//$pdf->SetAligns(Array('','R','C','','',''));

//set line height. This is the height of each lines, not rows.
$pdf->SetLineHeight(5);

//load json data
$data = json_decode($json,true);


$pdf->SetFont('Arial','B',16);
$pdf->Cell(200,1, utf8_decode('INSTITUTO TECNOLÓGICO DE TECOMATLÁN'),0,0,'C' );
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(200,6, utf8_decode('ÁREA DE SISTEMAS PROGRAMABLES'),0,0,'C' );
$pdf->Ln(10);
$pdf->SetFont('Arial','',12);
$pdf->Cell(50,6, utf8_decode('Nombre del responsable: '),0,0,'C' );
$pdf->SetFont('Arial','U',12);
$pdf->Cell(65,6, utf8_decode($datos['encargado']),0,0,'L' );
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,6, utf8_decode('Periodo:'),0,0,'R' );
$pdf->SetFont('Arial','U',12);
$pdf->Cell(20,6, utf8_decode($datos['periodo']),0,0,'L' );
$pdf->Ln(10);

//add table heading using standard cells
//set font to bold
$pdf->SetFont('Arial','B',10);
$pdf->Cell(50,5,utf8_decode("Descripción"),1,0);
$pdf->Cell(20,5,utf8_decode("Marca"),1,0);
$pdf->Cell(40,5,"Estudiante",1,0);
$pdf->Cell(20,5,utf8_decode("Nº control"),1,0);
$pdf->Cell(20,5,"Usuario",1,0);
$pdf->Cell(20,5,"Fecha",1,0);
$pdf->Cell(20,5,"Cantidad",1,0);

$pdf->Ln();

//reset font
$pdf->SetFont('Arial','',8);
//loop the data
$item = 2;
foreach($data as $item){
    //write data using Row() method containing array of values.
    $pdf->Row(Array(
        utf8_decode($item['Descripcion']),
        utf8_decode($item['Marca']),
        utf8_decode($item['Nombre']),
        $item['Nº control'],
        utf8_decode($item['Usuario']),
        $item['Fecha'],
        $item['Cantidad'],
    ));
    
}


//output the pdf
$pdf->Output();



 ?>