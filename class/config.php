<?php
define("Config",1);
include_once("bd.php");
class config extends bd{
	var $tabla="config";	
	function mostrarConfig($Nombre){
		$this->campos=array('*');
		return array_shift($this->getRecords("Nombre='$Nombre'"));	
	}
	/*function actualizarConfig($campos,$values){
		$this->campos=$campos;		
		$this->updateRecord("CodConfig=1",$values);
	}*/
	function actualizarConfig($datos,$where=""){
		foreach($datos as $k=>$v){
			$val=array("Valor"=>"'$v'");
			$this->updateRow($val,"Nombre='$k'");		
		}
	}
}
?>