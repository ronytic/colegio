<?php
include_once("bd.php");
class tmp_rude extends bd{
	var $tabla="tmp_rude";

	function estadoTabla(){
		return $this->statusTable();
	}
	function mostrarAlumnos($CodCurso){
		$this->campos=array('CodAlumno,LOWER(Paterno) as Paterno,LOWER(Materno) as Materno,LOWER(Nombres) as Nombres');
		return $this->getRecords(" CodCurso=$CodCurso","Paterno,Materno,Nombres");
	}
	function mostrarDatosAlumnos($CodCurso){
		$this->campos=array('*');
		return $this->getRecords(" NivelEstudiante=$CodCurso");
	}
	function mostrarDatos($CodAlumno){
		$this->campos=array('*');
		return $this->getRecords(" CodAlumno=$CodAlumno");
	}
	function insertarAlumno($Values){
		$this->insertRow($Values,1);
	}
	function actualizarAlumno($values,$CodAlumno){
		$this->updateRow($values,"CodAlumno=$CodAlumno");	
	}
}
?>