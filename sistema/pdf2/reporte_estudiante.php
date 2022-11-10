<?php 
 session_start();

if ($_SESSION['rol']!=3 and $_SESSION['rol'] !=1) {
    
    header('location: ../');
}

include('pdf_mc_estudiante.php');
require 'conexion2.php';


    $sql = sprintf("SELECT @i := @i + 1 as contador, u.idestudiante,u.nombre,u.numerocontrol, u.semestre,u.carrera,u.telefono,r.carrera 
        FROM estudiante u 
        INNER JOIN carrera r ON u.carrera = r.idcarrera
        CROSS JOIN (SELECT @i := 0) r");

    $query = $mysqli->query($sql);
    
    $arreglo = array();
    $json ='';
    
    while($rows = $query->fetch_array()) {
        
        $arreglo []= array(
                    'Nº' => $rows['contador'],
                    'Nº control' => $rows['numerocontrol'],
                    'Nombre' => $rows['nombre'],
                    'Semestre' => $rows['semestre'],
                    'Carrera' => $rows['carrera'],
                    'Telefono' => $rows['telefono']
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
$pdf->SetWidths(Array(10,30,50,30,30,30));

//set alignment
//$pdf->SetAligns(Array('','R','C','','',''));

//set line height. This is the height of each lines, not rows.
$pdf->SetLineHeight(5);

//load json data
$data = json_decode($json,true);


//add table heading using standard cells
//set font to bold
$pdf->Ln();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,5,utf8_decode("Nº"),1,0);
$pdf->Cell(30,5,utf8_decode("Nº CONTROL"),1,0);
$pdf->Cell(50,5,"NOMBRE",1,0);
$pdf->Cell(30,5,"SEMESTRE",1,0);
$pdf->Cell(30,5,"CARRERA",1,0);
$pdf->Cell(30,5,utf8_decode("TELÉFONO"),1,0);

$pdf->Ln();

//reset font
$pdf->SetFont('Arial','',9);
//loop the data
$item = 2;
foreach($data as $item){
    //write data using Row() method containing array of values.
    $pdf->Row(Array(
        $item['Nº'],
        $item['Nº control'],
        utf8_decode($item['Nombre']),
        utf8_decode($item['Semestre']),
        utf8_decode($item['Carrera']),
        $item['Telefono'],
    ));
    
}


//output the pdf
$pdf->Output();



 ?>