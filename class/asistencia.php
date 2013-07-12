<?php
include_once("bd.php");
class asistencia extends bd{
	var $tabla="asistencia";
	function mostrarCodAlumnoFecha($CodAlumno,$Fecha){
		return $this->getRecords("CodAlumno=$CodAlumno and FechaRegistro='$Fecha' and Activo=1");
	}
	function mostrarFecha($Fecha){
		return $this->getRecords("FechaRegistro='$Fecha' and Activo=1","FechaRegistro",0,0,0,1);
	}
}
?>