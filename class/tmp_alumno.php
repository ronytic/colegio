<?php
include_once("bd.php");
class tmp_alumno extends bd{
	var $tabla="tmp_alumno";

	function estadoTabla(){
		return $this->statusTable();
	}
	function mostrarAlumnos($CodCurso){
		$this->campos=array('CodAlumno,LOWER(Paterno) as Paterno,LOWER(Materno) as Materno,LOWER(Nombres) as Nombres');
		return $this->getRecords(" CodCurso=$CodCurso and Activo=1","Paterno,Materno,Nombres");
	}
	function mostrarDatos($CodAlumno){
		$this->campos=array('*');
		return $this->getRecords("CodAlumno=$CodAlumno");	
	}	
	function actualizarVisor($CodAlumno){
		$this->campos=array("Activo");
		$this->updateRecord("CodAlumno=$CodAlumno",array("0"));
	}
}
?>