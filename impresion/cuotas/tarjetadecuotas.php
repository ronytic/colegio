<?php
include_once("../../login/check.php");
include_once("../pdfs.php");
class pdf extends PPDF{
	
}
if(!empty($_GET)){
	$borde=0; 
	$aumento=61;//estaba en 58 
	
	include_once("../../class/alumno.php");
	include_once("../../class/curso.php");
	$al=new alumno;
	$curso=new curso;
	$CodAlumno=$_GET['CodAlumno'];
	
	if(!empty($_GET['NombresAdicional']) && $_GET['NombresAdicional']!=""){
		$NombresExtra=$_GET['NombresAdicional'];
		$CursoExtra=$_GET['CursosAdicional'];
	}
	
	$divido=explode("/",$CodAlumno);
	if(count($divido)>=1){
		$CodAlumno=$divido[0];
		for($i=1;$i<count($divido);$i++){
			$alumno=$al->mostrarDatosPersonales($divido[$i]);
			$alumno=array_shift($alumno);	
			$NombresExtra.="/".capitalizar(acortarPalabra($alumno['Nombres']));
			$cur=$curso->mostrarCurso($alumno['CodCurso']);
			$cur=array_shift($cur);
			$CursoExtra.=$cur['Abreviado']."/";
		}	
	}
	
	
	$alumno=$al->mostrarDatosPersonales($CodAlumno);
	$alumno=$alumno[0];

	if(!empty($NombresExtra)){
		$nombre=acortarPalabra($alumno['Nombres']);	
		$tam=(int)(strlen($NombresExtra)/2);
		$x=107-13-$tam;
		$nombre=$nombre.$NombresExtra;
	}else{
		$x=107-13;
		$nombre=$alumno['Nombres'];
	}
	
	if(@$CursoExtra!=""){
		$curs=explode("/",$CursoExtra);
		//$x=107-$tam;
		$Curso1=$alumno['Nombre']."/".$curs[0];
	}else{
		$x=107-13;
		
		$Curso1=$alumno['Nombre'];
	}
	
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
	//$pdf=new PDF("L","mm",array(101, 158));
	$pdf=new PDF("L","mm",array(217,330));
	$pdf->SetAutoPageBreak(true,0);  
	$pdf->SetCreator("Ronald Nina");
	$pdf->SetTitle("Tarjeta de Cuotas",1);
	$pdf->SetSubject("Sujeto");
	$pdf->AddPage();
	$pdf->SetFont('Times','B',13);
	
	$pdf->SetXY(106,43.6+$aumento);
	$pdf->Cell(0,0,utf8_decode(ucwords($alumno['Paterno']." ".$alumno['Materno'])),$borde);
	$pdf->SetXY($x,50.5+$aumento);
	$pdf->Cell(0,0,utf8_decode(ucwords($nombre)),$borde);
	$pdf->SetXY(99,57.5+$aumento);
	$pdf->Cell(0,0,utf8_decode(ucwords($Curso1)),$borde);
	$pdf->SetXY(104-10,64+$aumento);
	$pdf->Cell(0,0,utf8_decode(ucwords($curso2)),$borde);
	$pdf->SetXY(119,83.8+$aumento);
	$pdf->SetFont('Times','B',15);
	$pdf->Cell(0,0,date("y"),$borde);
	
	$pdf->Output("Tarjeta de Cuotas","I");
}
?>