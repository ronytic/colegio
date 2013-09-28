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
			return $this->getRecords("Activo=1","Nombre");
		else
			return $this->getRecords("Valido=1 and Activo=1","Nombre");
	}
	function mostrarMateria($CodMateria){
			$this->campos=array("*");
			return $this->getRecords(" CodMateria=$CodMateria and Activo=1");
	}
	function mostrarMateriaCiencias(){
			$this->campos=array("*");
			return $this->getRecords(" PromedioCiencias=1 and Activo=1");
	}
	
}
?>