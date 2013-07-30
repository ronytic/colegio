<?php
include_once("bd.php");
class cursomateria extends bd{
	var $tabla="cursomateria";
	function insertarMateria($data){
		$this->insertRow($data,1);
	}
	function mostrarMaterias($CodCurso){
		$this->campos=array("*");
		return $this->getRecords("CodCurso=".$CodCurso." and Activo=1 ","CodCursoMateria");
	}
	function mostrarMateriasOrden($CodCurso){
		$this->tabla="cursomateria cm,materias m";
		$this->campos=array("*");
		return $this->getRecords("cm.CodCurso=".$CodCurso." and cm.Activo=1 and cm.CodMateria=m.CodMateria","m.Nombre");
	}
	function cambiarNombre($Numero,$where){
		$this->updateRow(array("Alterno"=>$Numero),$where);
	}
	function actualizar($where){
		$this->updateRow(array("Activo"=>0),$where);
	}
}
?>