<?php
include_once("bd.php");
class tmp_documento extends bd{
	var $tabla="tmp_documento";
	function mostrarDocumento($CodAlumno){
		$this->campos=array('*');
		return $this->getRecords("CodAlumno=$CodAlumno");
	}
	//No funciona
	function actualizar($CodCuota,$Valor,$Observaciones){
		$this->campos=array('Cancelado','Observaciones');
		$this->updateRecord("CodCuota=$CodCuota",array($Valor,$Observaciones))	;
	}
	function guardarDocumento($Values){
			$this->insertRow($Values,1);
	}
	function actualizarDocumento($values,$CodAlumno){
		$this->updateRow($values,"CodAlumno=$CodAlumno");	
	}
}
?>