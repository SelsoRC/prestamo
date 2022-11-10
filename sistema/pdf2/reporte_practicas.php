<?php 
include('pdf_mc_practicas.php');
require 'conexion2.php';

$fecha1 = $_POST['fecha1'];
$fecha2 = $_POST['fecha2'];
$area=$_POST['area'];
$lugar = '';


if ($area== 1) {
    $lugar = 'LABORATORIO DE SISTEMAS PROGRAMABLES';
    
}

if ($area== 2) {
    $lugar = 'LABORATORIO DE IDIOMAS';
    
}

if ($area== 3) {
    $lugar = 'LABORATORIO DE ARQUITECTURA DE COMPUTADORAS';
    
}

if ($area== 4) {
    $lugar = 'LABORATORIO DE REDES DE COMPUTADORAS';
    
}


    if (empty($_REQUEST['fecha1']) || empty($_REQUEST['fecha2'])) {
        header("location: ../lista_practica.php");

    }



    $sql = sprintf("SELECT p.idpractica, p.fecha, p.horaentrada, p.horasalida,p.materia, u.nombre, p.grupo, p.carrera, p.numeropractica, p.nombrepractica  
                  FROM practica p
                  INNER JOIN usuario u ON p.usuario = u.idusuario
                  WHERE (fecha BETWEEN '$fecha1' AND '$fecha2') AND p.area = $area");

    $query = $mysqli->query($sql);
    
    $arreglo = array();
    $json ='';
    
    while($rows = $query->fetch_array()) {
        
        $arreglo []= array(
                    'Fecha' => $rows['fecha'],
                    'Horaentrada' => $rows['horaentrada'],
                    'Horasalida' => $rows['horasalida'],
                    'Materia' => $rows['materia'],
                    'Nombre' => $rows['nombre'],
                    'Grupo' => $rows['grupo'],
                    'Carrera' => $rows['carrera'],
                    'Numeropractica' => $rows['numeropractica'],
                    'Nombrepractica' => $rows['nombrepractica'],
                    
                    );
    }
    

    $json = json_encode($arreglo);
    
//make new object
$pdf = new PDF_MC_Table();

//add page, set font
$pdf->AddPage('LANDSCAPE','A4');
$pdf->AliasNbPages();
$pdf->SetFont('Arial','',14);

//set width for each column (6 columns)
$pdf->SetWidths(Array(25,28,25,40,40,14,20,25,50));

//set alignment
//$pdf->SetAligns(Array('','R','C','','',''));

//set line height. This is the height of each lines, not rows.
$pdf->SetLineHeight(5);

//load json data
$data = json_decode($json,true);

$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,1, utf8_decode('INSTITUTO TECNOLÓGICO DE TECOMATLÁN'),0,0,'C' );
$pdf->Ln(5);
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(130,6, utf8_decode('LUGAR DE REALIZACIÓN DE LA PRÁCTICA: '),0,0,'R' );
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(130,6, utf8_decode($lugar),0,0,'L' );
$pdf->Ln(10);


//add table heading using standard cells
//set font to bold
$pdf->SetFont('Arial','B',9);
$pdf->Cell(25,5,utf8_decode("FECHA"),1,0);
$pdf->Cell(28,5,utf8_decode("H.ENTRADA"),1,0);
$pdf->Cell(25,5,"H.SALIDA",1,0);
$pdf->Cell(40,5,utf8_decode("MATERIA"),1,0);
$pdf->Cell(40,5,"RESPONSABLE",1,0);
$pdf->Cell(14,5,"GRUPO",1,0);
$pdf->Cell(20,5,"CARRERA",1,0);
$pdf->Cell(25,5,utf8_decode("Nº PRACTICA"),1,0);
$pdf->Cell(50,5,"NOMBRE DE LA PRACTICA",1,0);

$pdf->Ln();

//reset font
$pdf->SetFont('Arial','',8);
//loop the data
$item = 2;
foreach($data as $item){
    //write data using Row() method containing array of values.
    $pdf->Row(Array(
        $item['Fecha'],
        $item['Horaentrada'],
        $item['Horasalida'],
        utf8_decode($item['Materia']),
        utf8_decode($item['Nombre']),
        $item['Grupo'],
        utf8_decode($item['Carrera']),
        $item['Numeropractica'],
        utf8_decode($item['Nombrepractica']),
    ));
    
}


//output the pdf
$pdf->Output();



 ?>   