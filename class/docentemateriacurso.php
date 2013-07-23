<?php 
include_once("bd.php");
class docentemateriacurso extends bd{
	var $tabla="docentemateriacurso";
	function mostrarTodo($where=''){
		$this->campos=array('*');
		return $this->getRecords($where);
	}
	function mostrarCodDocenteMateriaCurso($CodDocenteMateriaCurso){
		$this->campos=array('*');
		return $this->getRecords("CodDocenteMateriaCurso=$CodDocenteMateriaCurso and Activo=1");
	}
	function mostrarCursoSexo($CodCurso,$SexoAlumno){
		$this->tabla="docentemateriacurso dmc,docente d";
		$this->campos=array('dmc.*');
		return $this->getRecords("dmc.CodCurso=$CodCurso and (dmc.SexoAlumno=$SexoAlumno or dmc.SexoAlumno=2) and dmc.Activo=1 and dmc.CodDocente=d.CodDocente and d.Activo=1");
	}
	function mostrarCurso($CodCurso){
		$this->campos=array('*');
		return $this->getRecords("CodCurso=$CodCurso and Activo=1");
	}
	function mostrarDocenteCurso($CodDocente,$CodCurso){
		$this->campos=array('*');
		return $this->getRecords("CodDocente=$CodDocente and CodCurso=$CodCurso and Activo=1",0,"CodMateria");
	}
	function mostrarTodoDocente($CodDocente){
		$this->campos=array('*');
		return $this->getRecords("CodDocente=$CodDocente and Activo=1","CodCurso");
	}
	function mostrarDocenteOrdenCurso($CodDocente){
		$this->campos=array('*');
		return $this->getRecords("CodDocente=$CodDocente and Activo=1",0,"CodCurso");
	}
	function mostrarDocenteGrupo($CodDocente,$Grupo=""){
		$this->campos=array('*');
		return $this->getRecords("CodDocente=$CodDocente and Activo=1",0,"$Grupo");
	}
	function mostrarDocenteMateria($CodDocente){
		$this->campos=array("*");
		return $this->getRecords(" CodDocente=$CodDocente and Activo=1",0,"CodMateria");
	}
	function mostrarMateriaCurso($CodMateria,$CodCurso){
		$this->campos=array('*');
		return $this->getRecords("CodCurso=$CodCurso and CodMateria=$CodMateria and Activo=1");
	}
	function mostrarDocenteMateriaCurso($CodDocente,$CodMateria,$CodCurso){
		$this->campos=array('*');
		return $this->getRecords("CodDocente=$CodDocente and CodMateria=$CodMateria and CodCurso=$CodCurso and Activo=1");
	}
	function mostrarDocenteMateriaCursoSexo($CodDocente,$CodMateria,$CodCurso,$Sexo){
		$this->campos=array('*');
		return $this->getRecords("CodDocente=$CodDocente and CodMateria=$CodMateria and CodCurso=$CodCurso and SexoAlumno=$Sexo and Activo=1");
	}
	function mostrarMateriaCursoSexo($CodMateria,$CodCurso,$Sexo){
		$this->campos=array('*');
		return $this->getRecords("CodCurso=$CodCurso and CodMateria=$CodMateria and (SexoAlumno=$Sexo or SexoAlumno=2) and Activo=1");
	}
	function insertarDocenteRegistro($Values){
		$this->insertarRegistro($Values,1);
	}
	function actualizarDocenteRegistro($Values,$Where){
		$this->actualizarRegistro($Values,$Where);
	}
}
 ?>