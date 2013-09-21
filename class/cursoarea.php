<?php
include_once("bd.php");
class cursoarea extends bd{
	var $tabla="cursoarea";	
	function mostrarArea($CodCursoArea){
		$this->campos=array('*');
		return $this->getRecords("CodCursoArea=$CodCursoArea and Activo=1");
	}
	function mostrarAreas(){
		$this->campos=array('*');
		return $this->getRecords("Activo=1","CodCursoArea");
	}
}
?>