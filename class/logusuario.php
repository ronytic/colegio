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
	function mostrarUsuariosCantidad($Cantidad){
		$this->campos=array('*');
		return $this->getRecords("","FechaLog DESC,HoraLog",0,$Cantidad,0,1);
	}
	
}
?>