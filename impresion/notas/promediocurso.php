<?php
session_start();
include_once("../../login/check.php");
include_once("../../class/alumno.php");
include_once("../../class/casilleros.php");
include_once("../../class/docentemateriacurso.php");
include_once("../../class/registronotas.php");
include_once("../../class/curso.php");
include_once("../../class/materias.php");
if(!empty($_GET) && md5("lock")==$_GET['lock']){
	$CodCurso=$_GET['CodCurso'];
	$Periodo=$_GET['Periodo'];
	$Orden=$_GET['Orden'];
	$titulo=$idioma["ReportePromedioNotaCurso"];
	include_once("../pdf.php");

	class PDF extends PPDF{
		
		function Cabecera(){
			global $curso,$idioma;
			global $mat,$Periodo;
			$this->CuadroCabecera(13,$idioma["Curso"],40,$curso['Nombre']);
			$this->CuadroCabecera(20,$curso['Bimestre']?$idioma["Bimestre"].":":$idioma["Trimestre"].":",35,$Periodo);
			$this->Pagina();
			$this->ln();
			$this->TituloCabecera(8,"Nº");
			$this->TituloCabecera(25,$idioma["Paterno"]);
			$this->TituloCabecera(25,$idioma["Materno"]);
			$this->TituloCabecera(35,$idioma["Nombres"]);
			$this->TituloCabecera(30,$idioma["Promedio"]);
		}
	}
	$alumnos=new alumno;
	$docenteMateriaCurso=new docentemateriacurso;
	$registroNotas=new registronotas;
	$cur=new curso;
	$materia=new materias;
	$casilleros=new casilleros;
	$curso=$cur->mostrarCurso($CodCurso);
	$curso=array_shift($curso);
	$codigosmateria=array();
	foreach($docenteMateriaCurso->mostrarCurso($CodCurso) as $docMateriaCurso){
		foreach($casilleros->mostrarTrimestre($docMateriaCurso['CodDocenteMateriaCurso'],$Periodo) as $casillas){
			array_push($codigosmateria,$casillas['CodCasilleros']);
		}
	}
	$codmateria=implode(",",$codigosmateria);
	//echo $codmateria;
	$Sexo=$docMat['SexoAlumno'];
	
	
	$pdf=new PDF("P","mm","letter");//612,792
	$pdf->AddPage();
	$relleno=0;
	$i=0;
	$Orden=$Orden=="1"?$Orden="DESC":$Orden="ASC";
	$tPromedio=0;
	foreach($registroNotas->mostrarPromedioCurso($codmateria,$Orden) as $regNota){
		
		$al=array_shift($alumnos->mostrarDatosPersonales($regNota['CodAlumno']));
		if(count($al)!=0){
			$tPromedio+=$regNota['Promedio'];
			$i++;
			if($i%2==0)
				$relleno=1;
			else
				$relleno=0;
				$pdf->CuadroCuerpo(8,$i,$relleno,"R");
				$pdf->CuadroNombreSeparado(25,$al['Paterno'],25,$al['Materno'],35,$al['Nombres'],1,$relleno);
				$pdf->CuadroCuerpo(30,number_format(round($regNota['Promedio'],2),2),$relleno,"C");
				$pdf->Ln(5);
		}
	}
	@$totalpromedio=$tPromedio/$i;
	$pdf->CuadroCuerpo(93,$idioma['PromedioTotalCurso'].":",0,"R",1);
	$pdf->CuadroCuerpo(30,number_format(round($totalpromedio,2),2),0,"C",1);
	@$pdf->Output($titulo,"I");
}
?>