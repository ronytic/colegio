<?php
include_once("bd.php");
class materias extends bd{
	var $tabla="materias";

	function estadoTabla(){
		return $this->statusTable();
	}
	function mostrarMaterias($sw='all'){
		$this->campos=array("*");
		if($sw=='all')
			return $this->getRecords();
		else
			return $this->getRecords("Valido=1","Nombre");
	}
	function mostrarMateria($CodMateria){
			$this->campos=array("*");
			return $this->getRecords(" CodMateria=$CodMateria");
	}
	
}
?>