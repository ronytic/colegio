<?php
include_once("../../login/check.php");
if(!empty($_GET) && isset($_GET['mf']) && $_GET['mf']==md5("lock")){
	$CodCurso=$_GET['CodCurso'];
	$Trimestre=$_GET['Periodo'];	
	include_once("../../class/alumno.php");
	include_once("../../class/curso.php");
	include_once("../../class/cursomateria.php");
	include_once("../../class/materias.php");
	include_once("../../class/casilleros.php");
	include_once("../../class/registronotas.php");
	include_once("../pdf.php");
	$titulo=$idioma['PromedioFinalCiencias'];
	class PDF extends PPDF{
		var $ancho=255;
		function Cabecera(){
			global $cur,$idioma;
			
			global $Trimestre;
			global $nombresMateriasBoletin;
			$this->CuadroCabecera(30,$idioma['Curso'].": ",30,$cur['Nombre']);
			$this->Pagina();
			$this->CuadroCabecera(1,"",30,sacarIniciales($idioma["Reprobados"])."=".$idioma["Reprobados"].", ".sacarIniciales($idioma["PromedioAlumno"])."=".$idioma["PromedioAnualAlumno"]);
			$this->ln();
			$this->TituloCabecera(10,"N");
			$this->TituloCabecera(25,$idioma["Paterno"]);
			$this->TituloCabecera(25,$idioma["Materno"]);
			$this->TituloCabecera(35,$idioma["Nombres"]);

			foreach($nombresMateriasBoletin as $nombresmateria){
				$this->TituloCabecera(10,$nombresmateria,9);
			}
			$this->TituloCabecera(5,sacarIniciales($idioma["Reprobados"]));
			$this->TituloCabecera(5,sacarIniciales($idioma["PromedioAlumno"]));			
		}
	}
	
	
	$alumno=new alumno;
	$curso=new curso;
	$cursomateria=new cursomateria;
	$materias=new materias;
	$casilleros=new casilleros;
	$registronotas=new registronotas;
	$cur=$curso->mostrarCurso($CodCurso);
	$cur=array_shift($cur);
	//$cnf=array_shift($config->mostrarConfig("NotaReprobacion"));
	$notareprobado=$cur['NotaAprobacion'];
	$nombresMateriasBoletin=array();
	$valoresMateriasBoletin=array();
	foreach($cursomateria->mostrarMateriasOrden($CodCurso) as $materiasbol){
		//echo $materiasbol['CodMateria'];
		if($materiasbol['PromedioCiencias']==1){
		array_push($nombresMateriasBoletin,$materiasbol['Abreviado']);
		array_push($valoresMateriasBoletin,array("CodMateria"=>$materiasbol['CodMateria']));
		}
		//print_r( $nombresMateriasBoletin);
	}
	//print_r($valoresMateriasBoletin);
	$pdf=new PDF("L","mm","letter");//612,792
	$pdf->AddPage();
	
	//Sacar el Codigo del del trimestre desde ahi	
	$bordeC=0;
	$i=0;
	$relleno=0;
	
	
	foreach($alumno->mostrarDatosAlumnos($CodCurso) as $al){
		$i++;
		if($i%2==0){
			$relleno=1;	
		}else{
			$relleno=0;
		}
		$reprobado=0;
		$sumanotas=0;
		$cantidadnotas=0;
		$pdf->CuadroCuerpo(10,$i,$relleno,"R");
		$pdf->CuadroNombreSeparado(25,$al['Paterno'],25,$al['Materno'],35,$al['Nombres'],1,$relleno);
		//print_r($valoresMateriasBoletin);
		foreach($valoresMateriasBoletin as $materiasbol){
			
			$casillas1=array_shift($casilleros->mostrarMateriaCursoSexoTrimestre($materiasbol['CodMateria'],$CodCurso,$al['Sexo'],1));
			$regNotas1=array_shift($registronotas->mostrarRegistroNotas($casillas1['CodCasilleros'],$al['CodAlumno'],1));
			$casillas2=array_shift($casilleros->mostrarMateriaCursoSexoTrimestre($materiasbol['CodMateria'],$CodCurso,$al['Sexo'],2));
			$regNotas2=array_shift($registronotas->mostrarRegistroNotas($casillas2['CodCasilleros'],$al['CodAlumno'],2));
			$casillas3=array_shift($casilleros->mostrarMateriaCursoSexoTrimestre($materiasbol['CodMateria'],$CodCurso,$al['Sexo'],3));
			$regNotas3=array_shift($registronotas->mostrarRegistroNotas($casillas3['CodCasilleros'],$al['CodAlumno'],3));
			
			$regNotasFinal=round(($regNotas1['NotaFinal']+$regNotas2['NotaFinal']+$regNotas3['NotaFinal'])/3);
			
			/*Nota reforzamiento*/
			$casillas4=array_shift($casilleros->mostrarMateriaCursoSexoTrimestre($materiasbol['CodMateria'],$CodCurso,$al['Sexo'],4));
			$regNotas4=array_shift($registronotas->mostrarRegistroNotas($casillas4['CodCasilleros'],$al['CodAlumno'],4));
			/*Fin nota reforzamiento*/
						
			/*if($regNotas4['Nota2']!="" || $regNotas4['Nota2']!=0){
				$promedioanual=round(($regNotasFinal+$regNotas4['Nota2'])/2);
			}else{*/
				$promedioanual=$regNotasFinal;
			//}
			
			if($promedioanual<$notareprobado){
				$reprobado++;
				$pdf->CuadroCuerpoResaltar(10,$promedioanual,1,"C",1,1);
			}else{
				$pdf->CuadroCuerpo(10,$promedioanual,$relleno,"C");
			}
			/*
			if($regNotasFinal<$notareprobado){
				$reprobado++;
				$pdf->CuadroCuerpoResaltar(10,$regNotasFinal,1,"C",1,1);
			}else{
				$pdf->CuadroCuerpo(10,$regNotasFinal,$relleno,"C");
			}
			*/
			
			//$sumanotas+=$regNotasFinal;
			$sumanotas+=$promedioanual;
			$cantidadnotas++;
			
		}
		
		@$promedio=round($sumanotas/$cantidadnotas);// or die("No se tiene asignado materia para ese curso");
		
		
		
		$pdf->CuadroCuerpo(5,$reprobado,$relleno,"C");
		$pdf->CuadroCuerpo(5,$promedio,$relleno,"C");
		$pdf->ln();
	}
	
	$pdf->Output();
	////
	
}




?>