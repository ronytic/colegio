<?php
include_once("bd.php");
class logusuario extends Bd{
	var $tabla="logusuario";
	function estadoTabla(){
		return $this->statusTable();
	}
	function mostrarUsoDocente($CodDocente){
		$this->campos=array('*');
		return $this->getRecords(" CodUsuario=$CodDocente and Nivel=3","FechaLog",0,0,0,1);
	}
	
}
?>