<?php
include_once("bd.php");
class factura extends bd{
	var $tabla="factura";	
	function mostrarFacturas($Condicion){
		$this->campos=array('*');
		$Condicion=$Condicion!=""?"$Condicion and ":"";
		return $this->getRecords("$Condicion Activo=1","NFactura,FechaFactura,Nit,Factura");
	}
	function mostrarNumeroFactura($Condicion){
		$this->campos=array('max(NFactura) as NFactura');
		$Condicicion=$Condicicion!=""?"$Condicicion and ":"";
		return $this->getRecords("$Condicicion Activo=1");
	}
	function mostrarFactura($CodFactura){
		$this->campos=array('*');
		return $this->getRecords("CodFactura=$CodFactura and Activo=1");
	}
}
?>