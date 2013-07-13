<?php
include_once("bd.php");
class asistencia extends bd{
	var $tabla="asistencia";
	function mostrarCodAlumnoFecha($CodAlumno,$Fecha){
		return $this->getRecords("CodAlumno=$CodAlumno and FechaRegistro='$Fecha' and Activo=1");
	}
	function mostrarFecha($Fecha){
		return $this->getRecords("FechaRegistro='$Fecha' and Activo=1","HoraRegistro",0,0,0,1);
	}
	function mostrarFechaAsistencia($Fecha){
		$this->campos=array("count(*) as Cantidad");
		return $this->getRecords("FechaRegistro='$Fecha' and Tipo='C' and Activo=1","HoraRegistro",0,0,0,1);
	}
	function mostrarFechaAtraso($Fecha){
		$this->campos=array("count(*) as Cantidad");
		return $this->getRecords("FechaRegistro='$Fecha' and Tipo='A' and Activo=1","HoraRegistro",0,0,0,1);
	}
	function listadoFaltasHoy($Fecha){
		$this->tabla="alumno";
		$this->campos=array("*");
		return $this->getRecords("CodAlumno NOT IN(SELECT CodAlumno FROM `asistencia` WHERE FechaRegistro='$Fecha' and Activo=1) and Retirado=0","CodCurso");
		//SELECT * FROM alumno WHERE CodAlumno NOT IN(SELECT CodAlumno FROM `asistencia` WHERE FechaRegistro='2013-07-12' and Activo=1) and Retirado=0
	}
}
?>