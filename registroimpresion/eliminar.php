<?php
include_once("../login/check.php");
if(!empty($_POST)){
	include_once("../class/documentosimpresos.php");
	$documentosimpresos=new documentosimpresos;
	$CodDocImpreso=$_POST['codigo'];	
	$documentosimpresos->actualizar("CodDocumentosImpresos=$CodDocImpreso");
}
?>