<?php
include_once("../../login/check.php");
if(isset($_POST)){
	include_once("../../class/docentemateriacurso.php");
	$docentemateriacurso=new docentemateriacurso;
	extract($_POST);
	if(count($docentemateriacurso->mostrarDocenteMateriaCurso($CodDocente,$CodMateria,$CodCurso))){
		echo $idioma["YaAsignadoLosDatosADocente"];
	}else{
		$valores=array("CodDocente"=>"'$CodDocente'",
						"CodCurso"=>"'$CodCurso'",
						"CodMateria"=>"'$CodMateria'",
						"SexoAlumno"=>"'$SexoAlumno'"
		);
		$docentemateriacurso->actualizarDocenteRegistro($valores,"CodDocenteMateriaCurso=".$CodModificar);
	}
}
?>