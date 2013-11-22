<?php
session_start();
include_once("../../login/check.php");
include_once("../../class/alumno.php");
include_once("../../class/casilleros.php");
include_once("../../class/docentemateriacurso.php");
include_once("../../class/registronotas.php");
include_once("../../class/curso.php");
include_once("../../class/materias.php");
include_once("../../class/config.php");
if(!empty($_GET) && md5("lock")==$_GET['lock']){
	$Cantidad=$_GET['Cantidad'];
	//echo $Cantidad;

	$Orden=$_GET['Orden'];
	$titulo=$idioma["ReportePromedioNotasAnual"];
	include_once("../pdf.php");
	class PDF extends PPDF{
		function Cabecera(){
			global $CodTrimestre,$idioma;
			$this->Pagina();
			$this->ln();
			$this->TituloCabecera(8,"Nº");
			$this->TituloCabecera(24,$idioma["Paterno"]);
			$this->TituloCabecera(24,$idioma["Materno"]);
			$this->TituloCabecera(35,$idioma["Nombres"]);
			$this->TituloCabecera(30,$idioma["Promedio"]);
		}
	}
	$alumnos=new alumno;
	$docenteMateriaCurso=new docentemateriacurso;
	$casilleros=new casilleros;
	$registroNotas=new registronotas;
	$cur=new curso;
	$materia=new materias;
	$conf=new config;

	//$cnf=($conf->mostrarConfig("TotalPeriodo"));
	
	
	$pdf=new PDF("P","mm","letter");//612,792
	$pdf->AddPage();
	
	$relleno=0;
	
	$Orden=$Orden=="1"?$Orden="DESC":$Orden="ASC";

	foreach($cur->mostrar() as $curso){//cambiar para los diferentes Cursos
	$TotalPeriodo=$curso['CantidadEtapas'];
	$na=0;
		$pdf->CuadroCuerpoPersonalizado(30,$curso['Nombre'],0,"L",0,"UB");
		$pdf->Ln(5);
		$codigosmateria=array();
		foreach($docenteMateriaCurso->mostrarCurso($curso['CodCurso']) as $docMateriaCurso){
			
			for($i=1;$i<=$TotalPeriodo;$i++){
				foreach($casilleros->mostrarTrimestre($docMateriaCurso['CodDocenteMateriaCurso'],$i) as $casillas){
					array_push($codigosmateria,$casillas['CodCasilleros']);
				}
			}
		}
		$codmateria=implode(",",$codigosmateria);
		//echo $codmateria."<br>";
		$Sexo=$docMat['SexoAlumno'];
			foreach($registroNotas->mostrarPromedioCurso($codmateria,$Orden,$Cantidad) as $regNota){
			
			$al=array_shift($alumnos->mostrarDatosPersonales($regNota['CodAlumno']));
			if(count($al)!=0){
				$na++;
				if($na%2==1)
					$relleno=1;
				else
					$relleno=0;
					$pdf->CuadroCuerpo(8,$na,$relleno,"R");
					$pdf->CuadroNombreSeparado(24,$al['Paterno'],24,$al['Materno'],35,$al['Nombres'],1,$relleno);
					$pdf->CuadroCuerpo(30,number_format(round($regNota['Promedio'],2),2),$relleno,"C");
					$pdf->Ln(5);
			}
		}
	}
	@$pdf->Output();
}
?>