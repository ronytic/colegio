<?php
include_once("bd.php");
class observaciones extends bd{
	var $tabla="observaciones";
	function mostrarObservacionDoc(){
		$this->campos=array("*");	
		return $this->getRecords("Docente=1 and Activo=1");
	}
	function mostrarObservaciones($Orden="Posicion"){
		$this->campos=array("*");	
		return $this->getRecords("Activo=1",$Orden);
	}
	function CodObservaciones($Nivel){
		$this->campos=array("CodObservacion");
		return $this->getRecords("NivelObservacion=$Nivel and Activo=1");
	}
	function mostrarObser($CodObser){
			$this->campos=array("*");
			return $this->getRecords(" CodObservacion=$CodObser and Activo=1");
	}
	
}
?>