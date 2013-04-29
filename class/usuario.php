<?php
include_once("bd.php");
class usuario extends bd{
	var $tabla="usuario";
	function mostrarDatos($CodUsuario){
		$this->campos=array("*");
		return $this->getRecords("CodUsuario=$CodUsuario");
	}
	function loginUsuarios($Usuario,$Password){
		$this->campos=array("count(*) as Can,CodUsuario,Nivel,Idioma");	
		return $this->getRecords("Usuario='$Usuario' and Pass='$Password' and Activo=1");
	}
}
?>