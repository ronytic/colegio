<?php
$nombrearchivo="archivos/16.xls";
	
	set_time_limit(0);
	ini_set('memory_limit', '-1');
	
	
	
	
	//error_reporting(E_ALL);
	//ini_set('display_errors', TRUE);
	//ini_set('display_startup_errors', TRUE);
	

	
	
	/** Incluir PHPExcel */
	require_once 'Classes/PHPExcel.php';
	require_once 'funciones/funciones.php';
	$objPHPExcel = PHPExcel_IOFactory::load($nombrearchivo);
	/*
	$objReader = new PHPExcel_Reader_Excel2007();
	$objPHPExcel = $objReader->load("simple.xlsx");
	*/

	$dact=$objPHPExcel->getActiveSheet();
	
	$periodo=$dact->getCell('C2')->getValue();
	$codigodocente=$dact->getCell('E3')->getValue();
	$codigomateria=$dact->getCell('E4')->getValue();
	$codigocurso=$dact->getCell('E5')->getValue();
	$codigocasilleros=$dact->getCell('F3')->getValue();
	$codigodocentemateriacurso=$dact->getCell('G3')->getValue();
	$cantidadalumnos=$dact->getCell('E6')->getValue();
	$cantidadcasilleros=$dact->getCell('E7')->getValue();
	$notas=array();
	$totalalto=$cantidadalumnos+10;
	$columnacodigo=adicionar("D",$cantidadcasilleros+4);
	$columnanr=adicionar("D",$cantidadcasilleros+1);
	$columnandps=adicionar("D",$cantidadcasilleros+2);
	$columnanf=adicionar("D",$cantidadcasilleros+3);
	$creditosy=($cantidadalumnos+10+1+1);
	$codigo=$dact->getCell('A'.$creditosy)->getValue();
	
	$CantidadAprobados=$dact->getCell('C7')->getCalculatedValue();
	$CantidadReprobados=$dact->getCell('C8')->getCalculatedValue();
	/**/
	
	//echo $NombreArchivoSubido;
	//copy($nombrearchivo,"archivos/".$NombreArchivoSubido);
	$valores=array("NombreArchivo"=>"'".$NombreArchivoSubido."'",
				"Codigo"=>"'".$codigo."'",
				"CodDocenteMateriaCurso"=>"'$codigodocentemateriacurso'",
				"CodCasilleros"=>"'$codigocasilleros'",
				"CodDocente"=>"'$codigodocente'",
				"CodMateria"=>"'$codigomateria'",
				"CodCurso"=>"'$codigocurso'",
				"Direccion"=>"'$direccion'",
				"Ubicacion"=>"'Subida'",
	);
	
	echo"<pre>";
	print_r($valores);
	echo"</pre>";
	
	
	
	for($i=11;$i<=$totalalto;$i++){
		$cod=$dact->getCell($columnacodigo.$i)->getValue();
		$n=array();
		$poscol="D";
		for($j=1;$j<=$cantidadcasilleros;$j++){
			$poscol=adicionar($poscol,1);
			$vn=$dact->getCell($poscol.$i)->getValue();
			$n[$j]=$vn;
		}
		$notaresultado=$dact->getCell($columnanr.$i)->getCalculatedValue();
		$notadps=$dact->getCell($columnandps.$i)->getCalculatedValue();
		$notanotafinal=$dact->getCell($columnanf.$i)->getCalculatedValue();
		$notas[$cod]=array("notas"=>$n,
							"resultado"=>$notaresultado,
							"dps"=>$notadps,
							"notafinal"=>$notanotafinal
						);
	}
	echo"<pre>";
	print_r($notas);
	echo"</pre>";

	unset($dact);
  