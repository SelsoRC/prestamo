<?php 
 session_start(); 
 

if ($_SESSION['rol']!=3 and $_SESSION['rol'] !=1) {
    
    header('location: ../');
}

    require 'conexion2.php';

    $sql = "SELECT * FROM reporte ";

    $query_encargado = $mysqli->query($sql);
    $datos = $query_encargado->fetch_array();


include('pdf_mc_equipo.php');

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




    $sql = sprintf("SELECT @i := @i + 1 as contador,idequipo,descripcion,cantidad,marca,modelo,numeroserie,observaciones 
    FROM equipo
    CROSS JOIN (SELECT @i := 0) equipo WHERE area = $area");

    $query = $mysqli->query($sql);
    mysqli_close($mysqli);
    
    $arreglo = array();
    $json ='';
    
    while($rows = $query->fetch_array()) {
        
        $arreglo []= array(
                    'Nº' => $rows['contador'],
                    'Descripcion' => $rows['descripcion'],
                    'Cantidad' => $rows['cantidad'],
                    'Marca' => $rows['marca'],
                    'Modelo' => $rows['modelo'],
                    'Nº serie' => $rows['numeroserie'],
                    'Observaciones' => $rows['observaciones'],
                    );
    }
    

    $json = json_encode($arreglo);
    
//make new object
$pdf = new PDF_MC_Table();

//add page, set font
$pdf->AddPage();
$pdf->AliasNbPages();


//set width for each column (6 columns)
$pdf->SetWidths(Array(8,50,20,30,25,28,32));

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
$pdf->Cell(200,6, utf8_decode('ÁREA DE '.$lugar),0,0,'C' );
$pdf->Ln(10);
$pdf->SetFont('Arial','',12);
$pdf->Cell(50,6, utf8_decode('Nombre del responsable: '),0,0,'C' );
$pdf->SetFont('Arial','U',12);
$pdf->Cell(65,6,utf8_decode($datos['encargado']),0,0,'L' );
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,6, utf8_decode('Periodo:'),0,0,'R' );
$pdf->SetFont('Arial','U',12);
$pdf->Cell(20,6,utf8_decode($datos['periodo']),0,0,'L' );
$pdf->Ln(10);



//add table heading using standard cells
//set font to boldg

$pdf->SetFont('Arial','B',10);
$pdf->Cell(8,5,utf8_decode("Nº"),1,0);
$pdf->Cell(50,5,utf8_decode("DESCRIPCIÓN"),1,0);
$pdf->Cell(20,5,"CANTIDAD",1,0);
$pdf->Cell(30,5,"MARCA",1,0);
$pdf->Cell(25,5,"MODELO",1,0);
$pdf->Cell(28,5,utf8_decode("Nº SERIE"),1,0);
$pdf->Cell(32,5,"OBSERVACIONES",1,0);

$pdf->Ln();

//reset font
$pdf->SetFont('Arial','',8);
//loop the data
$item = 2;
foreach($data as $item){
    //write data using Row() method containing array of values.
    $pdf->Row(Array(
        $item['Nº'],
        utf8_decode($item['Descripcion']),
        $item['Cantidad'],
        utf8_decode($item['Marca']),
        utf8_decode($item['Modelo']),
        utf8_decode($item['Nº serie']),
        utf8_decode($item['Observaciones']),
    ));
    
}


//output the pdf
$pdf->Output();



 


 ?>