<?php
include_once("bd.php");
class agendaactividades extends bd{
	var $tabla="agendaactividades";
	function insertarActividad($Values){
		return $this->insertarRegistro($Values,1);
	}
	function cantidadActividades(){
		
		$this->campos=array("count(*) as Cantidad");
		$Nivel=$_SESSION['Nivel'];
		$Fecha=date("Y-m-d");
		$CodUsuario=$_SESSION['CodUsuarioLog'];// and CodUsuario='$CodUsuario'
		return $this->mostrarTodoRegistro("( (Usuarios=0 and CodUsuario=$CodUsuario and Nivel=$Nivel) or Usuarios LIKE '%$Nivel%') and Nivel='$Nivel' and FechaActividad='$Fecha'");
			
	}
	function mostrarActividades($where){
		$this->campos=array("*");
		return $this->getRecords($where." and Activo=1","FechaActividad ASC, HoraInicio");
		//return $this->mostrarTodoRegistro($where);
	}
	function actualizarActividad($Values,$CodAgendaActividades){
		return $this->actualizarRegistro($Values,"CodAgendaActividades=$CodAgendaActividades");
	}
	function eliminarActividad($CodAgendaActividades){
		return $this->eliminarRegistro("CodAgendaActividades=$CodAgendaActividades");	
	}
	
}
?>