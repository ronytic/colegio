<?php
include_once("../../login/check.php");
include_once("../../class/tmp_alumno.php");
include_once("../../class/curso.php");
$tmp_alumno=new tmp_alumno;
$curso=new curso;
$titulo=$idioma['AlumnosNoReinscritos'];
include_once("../pdf.php");
class PDF extends PPDF{
	function Cabecera(){
		global $idioma;
		$this->TituloCabecera(10,"N");
		$this->TituloCabecera(30,"Paterno");
		$this->TituloCabecera(30,"Materno");
		$this->TituloCabecera(40,"Nombres");
		$this->TituloCabecera(30,"Curso");
		$this->TituloCabecera(40,"Telefono");
		$this->TituloCabecera(35,"CelularP");
		$this->TituloCabecera(30,"CelularM");
	}
}
$pdf=new PDF("L","mm","letter");
$pdf->AddPage();
$i=0;
foreach($tmp_alumno->mostrarTodoRegistro("",1,"CodCurso") as $tmpal){$i++;
	$cur=$curso->mostrarCurso($tmpal['CodCurso']);
	$cur=array_shift($cur);
	$relleno=$i%2==0?1:0;
	$pdf->CuadroCuerpo(10,$i,$relleno,"R");
	$pdf->CuadroNombreSeparado(30,$tmpal['Paterno'],30,$tmpal['Materno'],40,$tmpal['Nombres'],1,$relleno);
	$pdf->CuadroCuerpo(30,$cur['Nombre'],$relleno,"");
	$pdf->CuadroCuerpo(40,$tmpal['Celular'],$relleno,"");
	$pdf->CuadroCuerpo(35,$tmpal['CelularP'],$relleno,"");
	$pdf->CuadroCuerpo(30,$tmpal['CelularM'],$relleno,"");
	$pdf->Ln();
}
$pdf->Output($titulo,"I");
?>