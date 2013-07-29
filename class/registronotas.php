<?php
include_once("bd.php");
class registronotas extends bd{
	var $tabla="registronotas";
	function insertarRegistro($Values){
		$this->insertRow($Values,1);
	}
	function mostrarRegistroNotas($CodCasilleros,$CodAlumno,$Trimestre){
		$this->campos=array("*");
		return $this->getRecords("CodCasilleros=$CodCasilleros and CodAlumno=$CodAlumno and Trimestre=$Trimestre");
	}
	function notasBoletin($CodAlumno,$CodCasilleros){
		$this->campos=array("*");
		return $this->getRecords("CodCasilleros=$CodCasilleros and CodAlumno=$CodAlumno");
	}
	function notasCentralizadorAgenda($CodCasilleros,$Trimestre,$puntajeFinal=36){
		$this->campos=array("*");
		return $this->getRecords("CodCasilleros=$CodCasilleros and NotaFinal<$puntajeFinal and Trimestre=$Trimestre");
	}
	function mostrarPromedioCurso($CodCasilleros,$orden="DESC",$cantidad=false){
		if($orden!="DESC"){
			$orden="ASC";	
		}
		//if($cantidad)
		$this->campos=array("AVG(NotaFinal) as Promedio, CodAlumno");
		return $this->getRecords("CodCasilleros IN (".$CodCasilleros.") GROUP BY CodAlumno ORDER BY AVG(NotaFinal) ".$orden,0,0,$cantidad,0);	
	}
	function promedio($n1,$n2,$n3){
		return round(($n1+$n2+$n3)/3,0);
	}
	function promedioBimestre($n1,$n2,$n3,$n4){
		return round(($n1+$n2+$n3+$n4)/4,0);
	}
	function actualizarNota($values,$where){
		$this->updateRow($values,$where);		
	}
}
?>