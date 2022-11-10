<?php
//include pdf_mc_table.php, not fpdf17/fpdf.php
include('pdf_mc_table.php');
require 'conexion2.php';


    $id = $_GET['id'];

    if (empty($_REQUEST['id'])) {
        header("location: ../");

    }


    $sql_estudiante = "SELECT u.idestudiante,u.nombre,u.numerocontrol, u.semestre,u.carrera,u.telefono,r.carrera FROM estudiante u INNER JOIN carrera r ON u.carrera = r.idcarrera WHERE u.idestudiante =$id";

    $query_estudiante = $mysqli->query($sql_estudiante);

    $datos = $query_estudiante->fetch_array();


    $sql = sprintf("SELECT equipo.descripcion,prestamo.fecha, prestamo.cantidadprestado,categoria.categoria,equipo.observaciones FROM prestamo INNER JOIN estudiante ON prestamo.estudiante = estudiante.idestudiante INNER JOIN equipo ON prestamo.equipo = equipo.idequipo INNER JOIN categoria ON equipo.categoria = categoria.idcategoria WHERE prestamo.estudiante = $id");

    $query = $mysqli->query($sql);
    
    $arreglo = array();
    $json ='';
    
    while($rows = $query->fetch_array()) {
        
        $arreglo []= array(
                    'descripcion' => $rows['descripcion'],
                    'fecha' => $rows['fecha'],
                    'cantidadprestado' => $rows['cantidadprestado'],
                    'categoria' => $rows['categoria'],
                    'observaciones' => $rows['observaciones']
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
$pdf->SetWidths(Array(70,20,20,30,50));

//set alignment
//$pdf->SetAligns(Array('','R','C','','',''));

//set line height. This is the height of each lines, not rows.
$pdf->SetLineHeight(5);

//load json data
$data = json_decode($json,true);


 $pdf->SetFont('Arial','',9);
 $pdf->Cell(30,5,'Nombre del Alumno:');
 $pdf->SetFont('Arial','U',9);
 $pdf->Cell(70,5,$datos['nombre']);
 $pdf->SetFont('Arial','',9);
 $pdf->Cell(13,5,'Carrera: ');
 $pdf->SetFont('Arial','U',9);
 $pdf->Cell(10,5,$datos['carrera']);
 $pdf->Ln(5);
 $pdf->SetFont('Arial','',9);
 $pdf->Cell(15,5,'Matricula:');
 $pdf->SetFont('Arial','U',9);
 $pdf->Cell(85,5,$datos['numerocontrol']);
 $pdf->SetFont('Arial','',9);
 $pdf->Cell(15,5,'Semestre');
 $pdf->SetFont('Arial','U',9);
 $pdf->Cell(12,5,$datos['semestre']);
 $pdf->Ln(10);

//add table heading using standard cells
//set font to bold
$pdf->SetFont('Arial','B',10);
$pdf->Cell(70,5,"Descripcion",1,0);
$pdf->Cell(20,5,"Fecha",1,0);
$pdf->Cell(20,5,"Cantidad",1,0);
$pdf->Cell(30,5,"Clasificacion",1,0);
$pdf->Cell(50,5,"Observaciones",1,0);

$pdf->Ln();

//reset font
$pdf->SetFont('Arial','',8);
//loop the data
$item = 2;
foreach($data as $item){
	//write data using Row() method containing array of values.
	$pdf->Row(Array(
		utf8_decode($item['descripcion']),
		$item['fecha'],
		$item['cantidadprestado'],
		$item['categoria'],
		utf8_decode($item['observaciones']),
	));
	
}

$pdf->Ln();

$pdf->Multicell(190,6,utf8_decode('Todo el material consumible y reutilizable, así como el equipo prestado por el solicitante, para que realice sus prácticas tecnológicas "NO TIENE NINGUN COSTO PARA EL ALUMNO".'));
$pdf->Ln();
$pdf->Multicell(50,5,'Notas:');

$pdf->Multicell(190,6,utf8_decode('Con excepción del material consumible, el material reutilizable, herramienta y equipo en préstamo, deberán ser devueltos al término de la práctica. En caso de extravío o daño por mal uso que haga el solicitante del material y equipo será responsabilidad del mismo y deberá ser repuesto en un máximo de 5 días hábiles.'));

$pdf->Ln(20);

$pdf->Cell(90,5,"Nombre y Firma",0,0,'C');
$pdf->Cell(90,5,"Nombre y Firma",0,1,'C');
$pdf->Cell(90,5,"de quien recibe",0,0,'C');
$pdf->Cell(90,5,"Responsable de Laboratorios",0,1,'C');
$pdf->Cell(90,5,"__________________________",0,0,'C');
$pdf->Cell(90,5,"__________________________",0,1,'C');

//output the pdf
$pdf->Output();






