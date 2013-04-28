<?php
include_once("../fpdf/fpdf.php");
class pdf extends FPDF{
	
}
if(!empty($_GET)){
	include_once("../../class/alumno.php");
	$al=new alumno;
	$CodAlumno=$_GET['CodAlumno'];
	if(!empty($_GET['NombresAdicional']) && $_GET['NombresAdicional']!=""){
		$NombresExtra=$_GET['NombresAdicional'];
		$CursoExtra=$_GET['CursosAdicional'];
	}
	$alumno=$al->mostrarDatosPersonales($CodAlumno);
	$alumno=$alumno[0];

	if(!empty($NombresExtra)){
		$n=explode(" ",$alumno['Nombres']);	
		$nombre=$n[0];
		$tam=(int)(strlen($NombresExtra)/2);
		$x=107-$tam;
		$nombre=$nombre."/".$NombresExtra;
	}else{
		$x=107;
		$nombre=$alumno['Nombres'];
	}
	
	if(@$CursoExtra!=""){
		$curs=explode("/",$CursoExtra);
		//$x=107-$tam;
		$Curso=$alumno['Nombre']."/".$curs[0];
	}else{
		$x=107;
		$Curso=$alumno['Nombre'];
	}
	$pdf=new PDF("L","mm",array(101, 158));
	$pdf->SetAutoPageBreak(true,0);  
	$pdf->SetCreator("Ronald Nina");
	$pdf->SetTitle("Tarjeta de Cuotas",1);
	$pdf->SetSubject("Sujeto");
	$pdf->AddPage();
	$pdf->SetFont('Times','B',13);
	$pdf->SetXY(113,44);
	$pdf->Cell(0,0,utf8_decode(ucwords($alumno['Paterno']." ".$alumno['Materno'])));
	$pdf->SetXY($x,50.5);
	$pdf->Cell(0,0,utf8_decode(ucwords($nombre)));
	
	$pdf->SetXY(103,58);
	$pdf->Cell(0,0,utf8_decode(ucwords($Curso)));
	if(@$curs[2]!=""){
		$curso2=$curs[1]."/";
	}else{
		@$curso2=$curs[1];
	}
	if(@$curs[3]!=""){
		$curso2.=$curs[2]."/";
	}else{
		@	$curso2.=$curs[2];
	}
	$pdf->SetXY(103,64);
	$pdf->Cell(0,0,utf8_decode(ucwords($curso2)));
	
	$pdf->SetXY(119,84.3);
	$pdf->SetFont('Times','B',15);
	$pdf->Cell(0,0,date("y"));
	
	$pdf->Output();
}
?>