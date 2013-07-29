<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	include_once("../../basededatos.php");
	$salida=$_POST['salida'];
	$nombre="BaseDeDatos".date("d-m-Y").".sql";
	header("Content-disposition: attachment; filename=$nombre");
//header("Content-Type: application/force-download");
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: ".strlen($salida));
	header("Pragma: no-cache");
	header("Expires: 0");
//	print($dump);
	echo $salida;

}
?>