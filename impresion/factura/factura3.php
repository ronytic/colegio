<?php
include_once("../../login/check.php");
include_once("../../class/config.php");
$config=new config;
$data=array();
foreach($_GET as $k=>$v){
	array_push($data,$k."=".$v);
	
}
$url=implode("&",$data);

$SistemaFacturacion=$config->mostrarConfig("SistemaFacturacion",1);

switch($SistemaFacturacion){
	case 'NuevoQR':{header("Location:facturasinqr.php?".$url);}break;	
	case 'Antiguo':{header("Location:facturasinv7.php?".$url);}break;	
}
?>