<?php
include_once("bd.php");
class tmpcola extends bd{
	var $tabla="tmpcola";
	function mostrarEspera($Where){
		$this->campos=array("*");
		return $this->getRecords($Where." and Activo=1","Estado","",0,0,0);
	}
}
?>