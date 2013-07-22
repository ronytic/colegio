<?php
include_once("bd.php");
class clases extends bd{
	var $tabla="clases";
	function mostrarClasesMateriaCurso($CodMateria,$CodCurso){
		$this->campos=array("*");
		return $this->getRecords("CodCurso=$CodCurso and CodMateria=$CodMateria and Activo=1","FechaRegistro DESC,HoraRegistro",0,0,0,1);
	}
}
?>