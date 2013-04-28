<?php
include_once("bd.php");
class lograstreo extends bd{
	var $tabla="lograstreo";

	function mostrar($CodLogRastreo){
		$this->campos=array('*');
		return $this->getRecords(" CodLogRastreo=$CodLogRastreo","",0,0,0,1);
	}
	
}
?>