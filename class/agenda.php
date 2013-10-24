<?php
include_once("bd.php");
class agenda extends bd{
	var $tabla="agenda";
	function insertarRegistro($Values){
		return $this->insertRow($Values,1);
	}
	function mostrarRegistroCurso($CodDocente,$CodCurso){
		$this->campos=array("*");	
		return $this->getRecords("CodUsuario=$CodDocente and CodCurso=$CodCurso and Activo=1"," FechaRegistro,HoraRegistro",0,0,0,1);
	}
	function mostrarRegistroFecha($Fecha){
		$this->campos=array("*");	//CodUsuario=$CodDocente and 
		return $this->getRecords("Fecha='$Fecha' and Activo=1"," Fecha DESC,HoraRegistro",0,0,0,1);
	}
	function mostrarRegistroMateria($CodDocente,$CodCurso,$Materia){
		$this->campos=array("*");	//CodUsuario=$CodDocente and 
		return $this->getRecords("CodCurso=$CodCurso and CodMateria=$Materia and Activo=1"," Fecha DESC,HoraRegistro",0,0,0,1);
	}
	function mostrarRegistroMateriaAlumno($CodDocente,$CodCurso,$Materia,$CodAlumno){
		$this->campos=array("*");	//CodUsuario=$CodDocente and 
		return $this->getRecords("CodCurso=$CodCurso and CodMateria=$Materia and CodAlumno=$CodAlumno and Activo=1"," FechaRegistro DESC,HoraRegistro",0,0,0,1);
	}
	function mostrarRegistroAlumno($CodDocente,$CodCurso,$Materia,$CodAlumno){
		$this->campos=array("*");	
		return $this->getRecords("CodUsuario=$CodDocente and CodCurso=$CodCurso and CodMateria=$Materia and CodAlumno=$CodAlumno and Activo=1"," FechaRegistro DESC,HoraRegistro",0,0,0,1);
	}
	function mostrarCodMateriaCodAlumno($CodMateria,$CodAlumno){
		$this->campos=array("*");	
		return $this->getRecords("CodMateria=$CodMateria and CodAlumno=$CodAlumno and Activo=1"," FechaRegistro DESC,HoraRegistro",0,0,0,1);
	}
	function mostrarCodMateriaCodAlumnoRango($CodMateria,$CodAlumno,$Inicio,$Fin){
		$this->campos=array("*");	
		return $this->getRecords("CodMateria=$CodMateria and CodAlumno=$CodAlumno and Activo=1 and Fecha BETWEEN '$Inicio' and  '$Fin'"," FechaRegistro DESC,HoraRegistro",0,0,0,1);
	}
	function mostrarCodCursoCodObservacionCodAlumnoRango($CodCurso,$CodObservacion,$CodAlumno,$Inicio,$Fin){
		$this->campos=array("count(*) as Cantidad");	
		return $this->getRecords("CodCurso=$CodCurso and CodObservacion=$CodObservacion and CodAlumno=$CodAlumno and Activo=1 and Fecha BETWEEN '$Inicio' and  '$Fin'"," FechaRegistro DESC,HoraRegistro",0,0,0,1);
	}
	function mostrarRegistros($CodAlumno){
		$this->campos=array("*");
		return $this->getRecords("CodAlumno=$CodAlumno and Activo=1","Fecha DESC,CodAgenda",0,0,0,1);
	}
	function CantidadObservaciones($CodAlumno="",$CodObservaciones,$CodMateria="",$Fecha=""){
		$this->campos=array("count(*) as Cantidad");
		if($CodMateria==""){
			$Materia="";
		}else{
			$Materia="and CodMateria=$CodMateria";
		}
		if($CodAlumno==""){
			$CodAl="";
		}else{
			$CodAl="and CodAlumno=$CodAlumno";
		}
		if($Fecha==""){
			$fech="";
		}else{
			$fech="and Fecha='$Fecha'";
		}
		
		return $this->getRecords("CodObservacion IN($CodObservaciones) and Activo=1 $CodAl $Materia $fech");
	}
	function MostrarAgenda($CodAgenda){
		$this->campos=array("*");
		return $this->getRecords("CodAgenda=$CodAgenda and Activo=1");
	}
	function CantidadObservacionesTotal($CodCurso="",$CodAlumno="",$CodObservaciones="",$CodMateria="",$Fecha=""){
		$this->campos=array("count(*) as Cantidad");
		
		if($CodMateria==""){
			$Materia="";
		}else{
			$Materia="and CodMateria=$CodMateria";
		}
		if($CodCurso==""){
			$Curso="";
		}else{
			$Curso="and CodCurso=$CodCurso";
		}
		if($CodAlumno==""){
			$CodAl="";
		}else{
			$CodAl="and CodAlumno=$CodAlumno";
		}
		if($Fecha==""){
			$fech="";
		}else{
			$fech="and Fecha='$Fecha'";
		}
		
		return $this->getRecords("CodObservacion IN($CodObservaciones) and Activo=1 $Curso $CodAl $Materia $fech");
	}
	function actualizarAgendaE($values,$where){
		$this->updateRow($values,$where);	
	}
}
?>