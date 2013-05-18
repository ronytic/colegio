<?php
include_once("bd.php");
class documentosimpresos extends bd{
	var $tabla="documentosimpresos";	
	function insertarDocumentoImpreso($data){
		$this->insertRow($data,1);
	}
	function mostrarDocumentosImpresos($Documento,$CodAlumno){
		$this->campos=array("*");
		return $this->getRecords("TipoDocumento='".$Documento."' and CodAlumno=".$CodAlumno." and Activo=1","FechaRegistro");
	}
	function actualizar($where){
		$this->updateRow(array("Activo"=>0),$where);
	}
}
?>