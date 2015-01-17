<?php
include_once("bd.php");
class curso extends bd{
	var $tabla="curso";	
	function listar($ini=1,$fin=13){
		$this->campos=array('CodCurso','Nombre','MontoCuota');
		return $this->getRecords("CodCurso BETWEEN $ini and $fin");
	}
	function mostrar(){
		$this->tabla="curso c,cursoarea ca";
		$this->campos=array('c.*,ca.Nombre as caNombre,ca.Area as caArea,c.MontoCuota');
		return $this->getRecords("c.CodCursoArea=ca.CodCursoArea and c.Activo=1","c.Orden");	
	}
	function mostrarCurso($CodCurso){
		$this->campos=array('*');
		return $this->getRecords("CodCurso=$CodCurso");
	}
}
?>