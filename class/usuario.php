<?php
include_once("bd.php");
class usuario extends bd{
	var $tabla="usuario";
	function mostrarDatos($CodUsuario){
		$this->campos=array("*");
		return $this->getRecords("CodUsuario=$CodUsuario and Activo=1");
	}
	function mostrarUsuarios($menos=""){
		$menos=$menos?"$menos and ":'';
		$this->campos=array("*");
		return $this->getRecords("$menos Activo=1","Paterno,Materno,Nombres");
	}
	function actualizarDatos($valores,$CodUsuario){
		//print_r($valores);
		return $this->updateRow($valores,"CodUsuario=$CodUsuario");
	}
	
	function loginUsuarios($Usuario,$Password){
		$this->campos=array("count(*) as Can,CodUsuario,Nivel,Idioma");	
		return $this->getRecords("Usuario='$Usuario' and Pass='$Password' and Activo=1");
	}
}
?>