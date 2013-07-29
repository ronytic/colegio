<?php
include_once("bd.php");
class notificaciones extends bd{
		var $tabla="notificaciones";
		function listarmensajes($CodUsuario,$Tipo){
			$this->campos=array("*");
			return $this->getRecords("Usuarios LIKE '%$CodUsuario%' and Tipo=$Tipo and Activo=1","Tipo");
		}
}
?>