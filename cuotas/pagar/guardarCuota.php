<?php
include_once("../../login/check.php");
include_once("../../class/cuota.php");
if(!empty($_POST)){
	$CodCuota=$_POST['CodCuota'];	
	$Valor=$_POST['Valor'];
	$Factura=$_POST['Factura'];
	$Observaciones=$_POST['Observaciones'];
	$Fecha=date("Y-m-d",strtotime($_POST['Fecha']));
	$Hora= date("H:i:s");
	$Fecha=$Fecha." ".$Hora;
	$cuota=new cuota;
	if($Valor){
		$cuota->actualizar($CodCuota,$Valor,$Factura,$Observaciones,$Fecha);
		echo json_encode(array("CodCuota"=>"$CodCuota","Valor"=>"1"));
	}else{
		$cuota->actualizar($CodCuota,$Valor,$Factura,$Observaciones,$Fecha);
		echo json_encode(array("CodCuota"=>"$CodCuota","Valor"=>"0"));
	}
}
?>