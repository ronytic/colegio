<?php
include_once("../../login/check.php");
if(!empty($_GET) && isset($_GET['mf']) && $_GET['mf']==md5("lock")){
	$CodCurso=$_GET['CodCurso'];
	$Periodo=$_GET['Periodo'];	
	include_once("../../class/alumno.php");
	include_once("../../class/curso.php");
	include_once("../../class/cursomateria.php");
	include_once("../../class/materias.php");
	include_once("../../class/casilleros.php");
	include_once("../../class/registronotas.php");
	include_once("../pdf.php");
	$titulo=$idioma["CentralizadorNotas"];
	class PDF extends PPDF{
		var $ancho=255;
		function Cabecera(){
			global $cur;
			
			global $Periodo,$idioma;
			global $nombresMateriasBoletin;
			$this->CuadroCabecera(30,$idioma["Curso"].":",30,$cur['Nombre']);
			$this->Pagina();
			$this->CuadroCabecera(1,"",30,sacarIniciales($idioma["Reprobados"])."=".$idioma["Reprobados"].", ".sacarIniciales($idioma["PromedioAlumno"])."=".$idioma["PromedioAlumno"]);
			$this->ln();
			$this->TituloCabecera(8,"Nº");
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
	$cnf=array_shift($config->mostrarConfig("NotaReprobacion"));
	$notareprobado=$cur['NotaAprobacion'];
	$nombresMateriasBoletin=array();
	foreach($cursomateria->mostrarMaterias($CodCurso) as $materiasbol){
		//echo $materiasbol['CodMateria'];
		$nombremateria=$materias->mostrarMateria($materiasbol['CodMateria']);
		$nombremateria=array_shift($nombremateria);
		array_push($nombresMateriasBoletin,$nombremateria['Abreviado']);
		//print_r( $nombresMateriasBoletin);
	}
	$pdf=new PDF("L","mm","letter");//612,792
	$pdf->AddPage();
	
	//Sacar el Codigo del del trimestre desde ahi	
	$bordeC=0;
	$i=0;
	$relleno=0;
	
	$reprobadomaterias=array();
	$reprobadototalcurso=0;
	$promediototalcurso=0;
	$j=0;
	foreach($cursomateria->mostrarMaterias($CodCurso) as $materiasbol){$j++;
		$reprobadomaterias[$j]=0;
	}
	foreach($alumno->mostrarDatosAlumnos($CodCurso) as $al){
		$i++;
		$j=0;
		if($i%2==0){
			$relleno=1;	
		}else{
			$relleno=0;
		}
		$reprobado=0;
		$sumanotas=0;
		$cantidadnotas=0;
		$pdf->CuadroCuerpo(8,$i,$relleno,"R");
		$pdf->CuadroNombreSeparado(25,$al['Paterno'],25,$al['Materno'],35,$al['Nombres'],1,$relleno);
		foreach($cursomateria->mostrarMaterias($CodCurso) as $materiasbol){$j++;
			
			$casillas=array_shift($casilleros->mostrarMateriaCursoSexoTrimestre($materiasbol['CodMateria'],$CodCurso,$al['Sexo'],$Periodo));
			$regNotas=$registronotas->mostrarRegistroNotas($casillas['CodCasilleros'],$al['CodAlumno'],$Periodo);
			$regNotas=array_shift($regNotas);
			
			if($regNotas['NotaFinal']<$notareprobado){
				$reprobado++;
				$pdf->CuadroCuerpoResaltar(10,$regNotas['NotaFinal'],1,"C",1,1);
				$reprobadomaterias[$j]++;
			}else{
				$pdf->CuadroCuerpo(10,$regNotas['NotaFinal'],$relleno,"C");
			}
			$sumanotas+=$regNotas['NotaFinal'];
			$cantidadnotas++;
		}
		$reprobadototalcurso+=$reprobado;
		$promediototalcurso+=$promedio;
		@$promedio=round($sumanotas/$cantidadnotas);// or die("No se tiene asignado materia para ese curso");
		$pdf->CuadroCuerpo(5,$reprobado,$relleno,"C");
		$pdf->CuadroCuerpo(5,$promedio,$relleno,"C");
		$pdf->ln();
	}
	$promediototalcurso=$promediototalcurso/$i;
	$pdf->CuadroCuerpo(93,"",0,"C",0);
	$j=0;
	foreach($cursomateria->mostrarMaterias($CodCurso) as $materiasbol){$j++;
		$pdf->CuadroCuerpo(10,$reprobadomaterias[$j],0,"C",1);
	}
	$pdf->CuadroCuerpo(5,$reprobadototalcurso,0,"C",1);
	$pdf->CuadroCuerpoPersonalizado(5,number_format($promediototalcurso,0),0,"C",1);
	//print_r($reprobadomaterias);
	$pdf->Output();
	////
	
}




?>