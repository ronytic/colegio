<?php
include_once("bd.php");
class cursoarea extends bd{
	var $tabla="cursoarea";	
	function mostrarArea($CodCursoArea){
		$this->campos=array('*');
		return $this->getRecords("CodCursoArea=$CodCursoArea");
	}
}
?>