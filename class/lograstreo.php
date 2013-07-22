<?php
include_once("bd.php");
class lograstreo extends bd{
	var $tabla="lograstreo";

	function mostrar($CodLogRastreo){
		$this->campos=array('*');
		return $this->getRecords(" CodLogRastreo=$CodLogRastreo and Activo=1","",0,0,0,1);
	}
	function mostrarNivelFecha($Nivel,$Fecha){
		$this->campos=array('*');
		return $this->getRecords(" Nivel LIKE '%$Nivel' and FechaRegistro LIKE '%$Fecha%' and Activo=1","FechaRegistro DESC,HoraRegistro",0,0,0,1);
	}
	
}
?>