<?php
include_once("bd.php");
class logusuario extends Bd{
	var $tabla="logusuario";
	function estadoTabla(){
		return $this->statusTable();
	}
	function mostrarUsoDocente($CodDocente){
		$this->campos=array('*');
		return $this->getRecords(" CodUsuario=$CodDocente and Nivel=3","FechaLog",0,0,0,1);
	}
	function mostrarUsuariosCantidad($Cantidad,$Tipo){
		$this->campos=array('*');
		return $this->getRecords("Nivel!='$Tipo'","FechaLog DESC,HoraLog",0,$Cantidad,0,1);
	}
	function mostrarUsuariosNivel($Cantidad,$Nivel,$Fecha){
		global $_SESSION;
		$Nivel=$Nivel?"Nivel='$Nivel' and":($_SESSION['Nivel']==1?'':'Nivel!=1 and ');
		$this->campos=array('*');
		return $this->getRecords("$Nivel FechaLog='$Fecha'","FechaLog DESC,HoraLog",0,$Cantidad,0,1);
	}
	function mostrarCantidadUsuarioFecha($Fecha,$Nivel){
		$this->campos=array('count(*) as Cantidad');
		return $this->getRecords("Nivel=$Nivel and FechaLog='$Fecha'","",0,0,0,0);
	}
}
?>