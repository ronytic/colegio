<?php
include_once("bd.php");
class observacionesfrecuentes extends bd{
	var $tabla="observacionesfrecuentes";
	function mostrarObservacionesFrecuentes(){
		$this->campos=array("*");
		return $this->mostrarTodoRegistro("");
	}
}
?>