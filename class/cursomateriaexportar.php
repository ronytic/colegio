<?php
include_once("bd.php");
class cursomateriaexportar extends bd{
	var $tabla="cursomateriaexportar";
	function insertarMateria($data){
		$this->insertRow($data,1);
	}
	function mostrarMaterias($CodCurso){
		$this->campos=array("*");
		return $this->getRecords("CodCurso=".$CodCurso." and Activo=1","CodCursoMateriaExportar");
	}
	function cambiarNombre($Numero,$where){
		$this->updateRow(array("Alterno"=>$Numero),$where);
	}
    function cambiarCombinada($Numero,$where){
		$this->updateRow(array("Combinada"=>$Numero),$where);
	}
	function actualizar($where){
		$this->updateRow(array("Activo"=>0),$where);
	}
}
?>