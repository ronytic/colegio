<?php 
include_once("../../login/check.php");
$PuertoUsb=$_POST['PuertoUsb'];
if($PuertoUsb!="0"){
	include_once("../../sms/funciones.php");
	if(!comprobarConexion("COM".$PuertoUsb)){
		?><div class="alert alert-error"><?php echo $idioma['ErrorConectarUsb']?></div><?php	
	}else{
		?><div class="alert alert-success"><?php echo $idioma['CorrectoConectarUsb']?></div><?php	
	}
}else{
	?><div class="alert alert-info"><?php echo $idioma['UsbDeshabilitado']?></div><?php
}
?>