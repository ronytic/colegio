<?php
include_once("../fpdf/fpdf.php");
class pdf extends FPDF{
	
}
if(!empty($_GET)){
	$borde=0;
	$aumento=58;
	
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
		$x=107-13-$tam;
		$nombre=$nombre."/".$NombresExtra;
	}else{
		$x=107-13;
		$nombre=$alumno['Nombres'];
	}
	
	if(@$CursoExtra!=""){
		$curs=explode("/",$CursoExtra);
		//$x=107-$tam;
		$Curso=$alumno['Nombre']."/".$curs[0];
	}else{
		$x=107-13;
		$Curso=$alumno['Nombre'];
	}
	//$pdf=new PDF("L","mm",array(101, 158));
	$pdf=new PDF("L","mm",array(217,330));
	$pdf->SetAutoPageBreak(true,0);  
	$pdf->SetCreator("Ronald Nina");
	$pdf->SetTitle("Tarjeta de Cuotas",1);
	$pdf->SetSubject("Sujeto");
	$pdf->AddPage();
	$pdf->SetFont('Times','B',13);
	
	$pdf->SetXY(105,43+$aumento);
	$pdf->Cell(0,0,utf8_decode(ucwords($alumno['Paterno']." ".$alumno['Materno'])),$borde);
	$pdf->SetXY($x,50.5+$aumento);
	$pdf->Cell(0,0,utf8_decode(ucwords($nombre)),$borde);
	
	$pdf->SetXY(97,58+$aumento);
	$pdf->Cell(0,0,utf8_decode(ucwords($Curso)),$borde);
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
	$pdf->SetXY(103-10,64+$aumento);
	$pdf->Cell(0,0,utf8_decode(ucwords($curso2)),$borde);
	
	$pdf->SetXY(119,82.1+$aumento);
	$pdf->SetFont('Times','B',15);
	$pdf->Cell(0,0,date("y"),$borde);
	
	$pdf->Output();
}
?>