<?php
include_once("../../login/check.php");
if(!empty($_POST['CodAlumno'])){
	include_once("../../class/alumno.php");
	include_once("../../class/curso.php");
	include_once("../../class/cuota.php");
	$alumno=new alumno;
	$curso=new curso;
	$cuota=new cuota;
	$CodAlumno=$_POST['CodAlumno'];
	$Registro=$_POST['Registro'];
	$al=$alumno->mostrarTodoDatos($CodAlumno);
	$al=array_shift($al);
	$cuo=$cuota->mostrarCuotasNoCanceladas($CodAlumno);
	$cuo=array_shift($cuo);
	if(!count($cuo)){
		$cuo['Numero']="SinDeuda";	
	}
	$nombres=capitalizar($al['Paterno'])." ".capitalizar($al['Materno'])." ".capitalizar($al['Nombres'])." ";
	$valores=array("Alumno"=>$nombres,
					"Cuota"=>$cuo['Numero'],
					//"MontoCuota"=>$al['FacturaA']
					"Registro"=>$Registro,
					"CodAlumno"=>$CodAlumno
					);
	
	echo json_encode($valores);
}
?>