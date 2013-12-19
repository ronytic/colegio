<?php
include_once("bd.php");
class facturadetalle extends bd{
	var $tabla="facturadetalle";	
	function mostrarFacturaDetalles($Condicion){
		$this->campos=array('*');
		$Condicion=$Condicion!=""?"$Condicion and ":"";
		return $this->getRecords("$Condicion Activo=1");
	}
	function mostrarFacturaDetalle($CodFacturaDetalle){
		$this->campos=array('*');
		return $this->getRecords("CodFacturaDetalle=$CodFacturaDetalle and Activo=1");
	}
}
?>