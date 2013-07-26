<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	include_once("../../class/cursomateriaexportar.php");	
	//include_once("../../class/casilleros.php");
	$cursomateriaexportar=new cursomateriaexportar;
	//$docentemateria=new docentemateria;
	$CodMateria=$_POST['CodMateria'];
	$CodCurso=$_POST['CodCurso'];
	$CodUsuario=$_SESSION['CodUsuarioLog'];
	$Fecha=date("Y-m-d");
	$Hora=date("H:i:s");
	
	//if(count($docentemateria->mostrarDocenteMateriaAnio($CodCurso,$CodMateria))>0){
	$values=array("CodCurso"=>$CodCurso, 
					"CodMateria"=>$CodMateria,
					"Alterno"=>1,
					"CodUsuario"=>$CodUsuario,
					"FechaRegistro"=>"'$Fecha'",
					"HoraRegistro"=>"'$Hora'",
					"Activo"=>1
					);
	$cursomateriaexportar->insertarMateria($values);
	//}else{
		//echo "No se ha asignado la Materia ni el docente en este Curso.";	
	//}
}
?>