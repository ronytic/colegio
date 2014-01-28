<?php 
include_once("../../login/check.php");
	include_once("../pdf.php");
	$titulo=$idioma['TodoBecados'];
	class PDF extends PPDF{
		function Cabecera(){
			global $idioma;
			$this->Pagina();
			$this->ln();
			$this->TituloCabecera(15,"N");
			$this->TituloCabecera(30,$idioma["Paterno"]);
			$this->TituloCabecera(30,$idioma["Materno"]);
			$this->TituloCabecera(40,$idioma["Nombres"]);
			$this->TituloCabecera(30,$idioma["Curso"]);
			$this->TituloCabecera(30,$idioma["MontoBeca"]);
		}
		
	}
	include_once("../../class/alumno.php");
	include_once("../../class/curso.php");
	$curso=new curso;
	$alumno=new alumno;
	
	$pdf=new PDF("P","mm","letter");//612,792
	$pdf->AddPage();
	$i=0;
	foreach($alumno->mostrarDatosCursoTotalBecado() as $al){
		$i++;
		$CursoTexto=array_shift($curso->mostrarCurso($al['CodCurso']));
		if($i%2==0){$relleno=1;}else{$relleno=0;}
		$pdf->CuadroCuerpo(15,$i,$relleno,"R");
		$pdf->CuadroNombreSeparado(30,$al['Paterno'],30,$al['Materno'],40,$al['Nombres'],1,$relleno);
		$pdf->CuadroCuerpo(30,$CursoTexto['Nombre'],$relleno);
		$pdf->CuadroCuerpo(30,number_format($al['MontoBeca'],2),$relleno,"R");
		$pdf->ln();
	}
	$pdf->Output($titulo,"I");
?>