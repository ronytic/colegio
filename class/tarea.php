<?php
include_once("bd.php");
class tarea extends bd{
	var $tabla="tarea";
	function insertarTarea($Values){
		$this->insertRow($Values,1);
	}
	function mostrarTareas($CodDocente,$CodCurso,$CodMateria){
		$this->campos=array("*");	
		return $this->getRecords("CodDocente=$CodDocente and CodCurso=$CodCurso and CodMateria=$CodMateria and Visible=1","  FechaPresentacion",0,0,0,1);
	}
	function mostrarTareasCursoMateria($CodCurso,$CodMateria){
		$this->campos=array("*");	
		return $this->getRecords("CodCurso=$CodCurso and CodMateria=$CodMateria and Visible=1","  FechaPresentacion",0,0,0,1);
	}
	function mostrarTareaCursoPendiente($CodCurso,$Fecha){
		$this->campos=array("*");	
		return $this->getRecords(" CodCurso=$CodCurso  and FechaPresentacion>CURDATE() and Visible=1","  FechaPresentacion",0,0,0,1);
	}
	function mostrarTareaCursoRevisadas($CodCurso,$Fecha){
		$this->campos=array("*");	
		return $this->getRecords(" CodCurso=$CodCurso  and FechaPresentacion<=CURDATE() and Visible=1","  FechaPresentacion",0,0,0,1);
	}
	function actualizarTarea($values,$where){
		$this->updateRow($values,$where);	
	}
}
?>