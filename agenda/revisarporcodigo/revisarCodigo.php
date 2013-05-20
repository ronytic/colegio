<?php
include_once("../../login/check.php");
include_once("../../class/alumno.php");
if(!empty($_POST)){
	$alumno=new alumno;
	$Codigo=$_POST['Codigo'];
	$Codigo=$Codigo;
	$al=$alumno->mostrarDatosCodBarra("CodBarra='$Codigo'");
	if(count($al)==1){
		$al=array_shift($al);
		$CodAlumno=$al['CodAlumno'];
		echo json_encode(array("CodAlumno"=>"$CodAlumno","Msg"=>"OK"));
	}else{
		echo json_encode(array("Error"=>$idioma['NoSeEncontroCodigo'],"Msg"=>"NO"));	
	}
}
?>