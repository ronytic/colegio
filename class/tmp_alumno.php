<?php
include_once("bd.php");
class tmp_alumno extends bd{
	var $tabla="tmp_alumno";

	function estadoTabla(){
		return $this->statusTable();
	}
	function iniciar(){
		return $this->actualizarRegistro(array("Valido"=>"1"),"Retirado=0");
	}
	function mostrarDatosAlumnos($CodCurso){
		$this->campos=array('CodAlumno,LOWER(Paterno) as Paterno,LOWER(Materno) as Materno,LOWER(Nombres) as Nombres');
		return $this->getRecords(" CodCurso=$CodCurso and Activo=1","Paterno,Materno,Nombres");
	}
	function mostrarTodoDatos($CodAlumno,$Retirado=0){
		$this->campos=array('*');
		if($Retirado==2){
			$Retiro="(Retirado=0 OR Retirado=1)";
		}else{
			$Retiro="Retirado=$Retirado";	
		}
		return $this->getRecords(" CodAlumno=$CodAlumno and $Retiro");
	}
	function mostrarDatosPersonales($CodAlumno,$Retirado=0,$tipo=false){
		$this->tabla="tmp_alumno a";
		if($Retirado==2){
			$Retiro="(a.Retirado=0 OR a.Retirado=1)";
		}else{
			$Retiro="a.Retirado=$Retirado";	
		}
		if(!$tipo){
			$this->campos=array("a.CodAlumno, LOWER(a.Paterno) as Paterno, LOWER(a.Materno) as Materno, LOWER(a.Nombres) as Nombres");
		}else{
			$this->campos=array("a.CodAlumno, UPPER(a.Paterno) as Paterno, UPPER(a.Materno) as Materno, UPPER(a.Nombres) as Nombres");
		}
		return $this->getRecords(" a.CodAlumno=$CodAlumno and $Retiro");
	}
	function mostrarDatos($CodAlumno){
		$this->campos=array('*');
		return $this->getRecords("CodAlumno=$CodAlumno");	
	}	
	function actualizarVisor($CodAlumno){
		$this->campos=array("Activo");
		$this->updateRow(array("Activo"=>0),"CodAlumno=$CodAlumno");
	}
}
?>