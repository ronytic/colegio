<?php
define("Config",1);
include_once("bd.php");
class config extends bd{
	var $tabla="config";	
	function mostrarConfig($Nombre,$Valor=0){
		$this->campos=array('*');
		$v=$this->getRecords("Nombre='$Nombre'");
		$v=array_shift($v);
		if($Valor){
			return $v['Valor'];
		}else{
			return $v;
		}
	}
	function actualizarConfig($datos,$Nombre=""){
		$this->updateRow($datos,"Nombre='$Nombre'");		
	}
}
?>