<?php
include_once("bd.php");
class clasesarchivos extends bd{
	var $tabla="clasesarchivos";
	function mostrarClases($CodClases){
		$this->campos=array("*");
		return $this->mostrarTodoRegistro("CodClases=$CodClases");
	}
	function mostrarCodClasesArchivos($CodClasesArchivos){
		$this->campos=array("*");
		return $this->mostrarTodoRegistro("CodClasesArchivos=$CodClasesArchivos");
	}
}
?>