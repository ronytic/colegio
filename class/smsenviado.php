<?php
include_once("bd.php");
class smsenviado extends bd{
	var $tabla="smsenviado";
	function mostrarUsuariosNivel($Cantidad,$Nivel,$Fecha){
		global $_SESSION;
		$Nivel=$Nivel?"Nivel='$Nivel' and":($_SESSION['Nivel']==1?'':'Nivel!=1 and ');
		$this->campos=array('*');
		return $this->getRecords("$Nivel FechaRegistro='$Fecha'","FechaRegistro DESC,HoraRegistro",0,$Cantidad,0,1);
	}
}
?>