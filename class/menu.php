<?php
include_once("bd.php");
class menu extends bd{
	var $tabla="menu";
	function mostrar($Nivel,$Posicion=""){
		$this->campos=array('CodMenu','Nombre','Url','SubMenu','Imagen');
		$Posicion=(!empty($Posicion))?" and Posicion='$Posicion'":"";
		switch($Nivel){
			case "1":{return $this->getRecords(" Admin=1 and Activo=1 $Posicion","Orden");}break;
			case "2":{return $this->getRecords(" Director=1 and Activo=1 $Posicion","Orden");}break;
			case "3":{return $this->getRecords(" Profesor=1 and Activo=1 $Posicion","Orden");}break;
			case "4":{return $this->getRecords(" Secretaria=1 and Activo=1 $Posicion","Orden");}break;
			case "5":{return $this->getRecords(" Regente=1 and Activo=1 $Posicion","Orden");}break;
			case "6":{return $this->getRecords(" Padre=1 and Activo=1 $Posicion","Orden");}break;
			case "7":{return $this->getRecords(" Alumno=1 and Activo=1 $Posicion","Orden");}break;
		}
	}
	function verificar($Directorio,$Nivel){
		switch($Nivel){
			case "1":{return $this->getRecords("Url='$Directorio' and Admin=1 and Activo=1","Orden");}break;
			case "2":{return $this->getRecords("Url='$Directorio' and  Director=1 and Activo=1","Orden");}break;
			case "3":{return $this->getRecords("Url='$Directorio' and  Profesor=1 and Activo=1","Orden");}break;
			case "4":{return $this->getRecords("Url='$Directorio' and  Secretaria=1 and Activo=1","Orden");}break;
			case "5":{return $this->getRecords("Url='$Directorio' and  Regente=1 and Activo=1","Orden");}break;
			case "6":{return $this->getRecords("Url='$Directorio' and  Padre=1 and Activo=1","Orden");}break;
			case "7":{return $this->getRecords("Url='$Directorio' and  Alumno=1 and Activo=1","Orden");}break;
		}
	}
	function mostrarMenuUrl($Url=""){
		$this->campos=array('CodMenu','Nombre','Url','SubMenu','Imagen');
		$Posicion=(!empty($Posicion))?" and Posicion='$Posicion'":"";
		return $this->getRecords(" Url='$Url' and Activo=1 $Posicion","Orden");
	}
}
?>