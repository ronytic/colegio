<?php
include_once("bd.php");
class observacionesfrecuentes extends bd{
	var $tabla="observacionesfrecuentes";
	function mostrarObservacionesFrecuentes(){
		$this->campos=array("*");
		return $this->mostrarTodoRegistro("");
	}
	function mostrarObservaciones(){
		$this->campos=array('*');
		return $this->getRecords("Activo=1");
	}
	function mostrarObservacion($CodObservacionesFrecuentes){
		$this->campos=array('*');
		return $this->getRecords("CodObservacionesFrecuentes=$CodObservacionesFrecuentes and Activo=1");
	}
}
?>