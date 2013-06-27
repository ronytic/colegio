<?php 
include_once("bd.php");
class docentemateriacurso extends bd{
	var $tabla="docentemateriacurso";
	function mostrarTodo($where='')
	{
		$this->campos=array('*');
		return $this->getRecords($where);
	}
	function mostrarCursoSexo($CodCurso,$SexoAlumno){
		$this->campos=array('*');
		return $this->getRecords("CodCurso=$CodCurso and (SexoAlumno=$SexoAlumno or SexoAlumno=2) and Activo=1");
	}
	function mostrarCurso($CodCurso){
		$this->campos=array('*');
		return $this->getRecords("CodCurso=$CodCurso");
	}
	function mostrarDocenteCurso($CodDocente,$CodCurso){
		$this->campos=array('*');
		return $this->getRecords("CodDocente=$CodDocente and CodCurso=$CodCurso",0,"CodMateria");
	}
	function mostrarDocenteOrdenCurso($CodDocente){
		$this->campos=array('*');
		return $this->getRecords("CodDocente=$CodDocente and Activo=1",0,"CodCurso");
	}
	function mostrarDocenteGrupo($CodDocente,$Grupo=""){
		$this->campos=array('*');
		return $this->getRecords("CodDocente=$CodDocente",0,"$Grupo");
	}
	function mostrarDocenteMateria($CodDocente){
		$this->campos=array("*");
		return $this->getRecords(" CodDocente=$CodDocente",0,"CodMateria");
	}
	function mostrarMateriaCurso($CodMateria,$CodCurso){
		$this->campos=array('*');
		return $this->getRecords("CodCurso=$CodCurso and CodMateria=$CodMateria");
	}
	function mostrarDocenteMateriaCurso($CodDocente,$CodMateria,$CodCurso){
		$this->campos=array('*');
		return $this->getRecords("CodDocente=$CodDocente and CodMateria=$CodMateria and CodCurso=$CodCurso");
	}
	function mostrarDocenteMateriaCursoSexo($CodDocente,$CodMateria,$CodCurso,$Sexo){
		$this->campos=array('*');
		return $this->getRecords("CodDocente=$CodDocente and CodMateria=$CodMateria and CodCurso=$CodCurso and SexoAlumno=$Sexo");
	}
	function mostrarMateriaCursoSexo($CodMateria,$CodCurso,$Sexo){
		$this->campos=array('*');
		return $this->getRecords("CodCurso=$CodCurso and CodMateria=$CodMateria and (SexoAlumno=$Sexo or SexoAlumno=2)");
	}
	function insertarDocenteRegistro($Values){
		$this->insertRow($Values,1);
	}
}
 ?>