<?php 
include_once 'bd.php';
class notascualitativa extends bd{
	var $tabla="notasCualitativa";
	function mostrarDocenteMateriaCursoTrimestre($CodDocente,$CodMateria,$CodCurso,$Trimestre){
		$this->tabla="docentemateriacurso dmc, notascualitativa nc";
		$this->campos=array('dmc.CodDocente,dmc.CodMateria,dmc.CodCurso,dmc.SexoAlumno,dmc.CodDocenteMateriaCurso,nc.*');
		return $this->getRecords("dmc.CodDocente=$CodDocente and dmc.CodMateria=$CodMateria and dmc.CodCurso=$CodCurso and nc.Trimestre=$Trimestre and dmc.CodDocenteMateriaCurso=nc.CodDocenteMateriaCurso");
	}
	function eliminarNotaDefinitivo($where){
		return $this->deleteRecord($where);
	}
	function mostrarNota($CodDocenteMateriaCurso,$Trimestre){
		$this->campos=array("*");	
		return $this->getRecords("CodDocenteMateriaCurso=$CodDocenteMateriaCurso and Trimestre=$Trimestre");
	}
}
 ?>