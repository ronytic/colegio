<?php 
include_once 'bd.php';
class notascualitativabimestre extends bd{
	var $tabla="notascualitativabimestre";
	function mostrarDocenteMateriaCursoTrimestre($CodDocente,$CodMateria,$CodCurso,$Trimestre){
		$this->tabla="docentemateriacurso dmc, notascualitativa nc";
		$this->campos=array('dmc.CodDocente,dmc.CodMateria,dmc.CodCurso,dmc.SexoAlumno,dmc.CodDocenteMateriaCurso,nc.*');
		return $this->getRecords("dmc.CodDocente=$CodDocente and dmc.CodMateria=$CodMateria and dmc.CodCurso=$CodCurso and nc.Trimestre=$Trimestre and dmc.CodDocenteMateriaCurso=nc.CodDocenteMateriaCurso");
	}
	function eliminarNotaDefinitivo($where){
		return $this->deleteRecord($where);
	}
	function mostrarNota($CodCurso,$Periodo){
		$this->campos=array("*");	
		return $this->getRecords("CodCurso=$CodCurso and Periodo=$Periodo");
	}
}
 ?>