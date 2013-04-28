<?php
include_once("bd.php");
class anuncioslogin extends bd{
	var $tabla="anuncioslogin";	
	function mostrarAnuncios(){
		$this->campos=array('*');
		return $this->getRecords("Activo=1");
	}
}
?>