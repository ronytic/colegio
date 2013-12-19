<?php
include_once("bd.php");
class facturadetalle extends bd{
	var $tabla="facturadetalle.php";	
	function mostrarFacturaDetalles($Condicion){
		$this->campos=array('*');
		$Condicicion=$Condicicion!=""?"$Condicicion and ":"";
		return $this->getRecords("$Condicicion Activo=1");
	}
	function mostrarFacturaDetalle($CodFacturaDetalle){
		$this->campos=array('*');
		return $this->getRecords("CodFacturaDetalle=$CodFacturaDetalle and Activo=1");
	}
}
?>