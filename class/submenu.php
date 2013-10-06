<?php
include_once("bd.php");
class submenu extends bd{
	var $tabla="submenu";
	function mostrar($Nivel,$Menu){
		$this->campos=array('Nombre','Url','Imagen',"Internet");
		switch($Nivel){
			case "1":{return $this->getRecords(" Admin=1 and CodMenu=$Menu and Activo=1","Orden");}break;
			case "2":{return $this->getRecords(" Director=1 and CodMenu=$Menu and Activo=1","Orden");}break;
			case "3":{return $this->getRecords(" Profesor=1 and CodMenu=$Menu and Activo=1","Orden");}break;
			case "4":{return $this->getRecords(" Secretaria=1 and CodMenu=$Menu and Activo=1","Orden");}break;
			case "5":{return $this->getRecords(" Regente=1 and CodMenu=$Menu and Activo=1","Orden");}break;
			case "6":{return $this->getRecords(" Padre=1 and CodMenu=$Menu and Activo=1","Orden");}break;
			case "7":{return $this->getRecords(" Alumno=1 and CodMenu=$Menu and Activo=1","Orden");}break;
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
}
?>