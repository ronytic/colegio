<?php
include_once("bd.php");
class cuota extends bd{
	var $tabla="cuota";
	
	function  mostrarCuotasWhere($tabla,$campos,$Where,$Order){
		if($tabla!=""){
			$this->tabla=$tabla;
		}
		$this->campos=array($campos);
		return $this->getRecords($Where,$Order);
	}
	function mostrarCuotas($CodAlumno){
		$this->campos=array('*');
		return $this->getRecords("CodAlumno=$CodAlumno","Numero");
	}
	function mostrarTodoCuota($CodCuota){
		$this->campos=array('*');
		return $this->getRecords("CodCuota=$CodCuota","Numero");
	}
	function mostrarCuota($CodAlumno,$NumeroCuota){
		$this->campos=array('*');
		return $this->getRecords("CodAlumno=$CodAlumno and Numero=$NumeroCuota","Numero");
	}
	function mostrarCuotasNoCanceladas($CodAlumno){
		$this->campos=array('*');
		return $this->getRecords("CodAlumno=$CodAlumno and Cancelado=0","Numero");
	}
	function mostrarCuotasNoCanceladasMenorMayor($CodAlumno,$Menor,$Mayor){
		$this->campos=array('*');
		return $this->getRecords("CodAlumno=$CodAlumno and Numero>=$Menor and Numero<=$Mayor","Numero");
	}
	function mostrarNumeroCuota($CodAlumno,$NumeroCuota,$Cancelado=1){
		$this->campos=array('*');
		return $this->getRecords("CodAlumno=$CodAlumno and Numero=$NumeroCuota and Cancelado=$Cancelado","Numero");
	}
	
	function mostrarCuotasArqueo(){
		
	}
	function actualizar($CodCuota,$Valor,$Factura,$Observaciones,$Fecha){
		$this->campos=array('Cancelado','Factura','Observaciones','Fecha');
		$this->updateRecord("CodCuota=$CodCuota",array($Valor,$Factura,$Observaciones,"$Fecha"))	;
	}
	function guardar($Values){
		$this->insertRow($Values,1);
	}
	function actualizarCuota($values,$where){
		$this->updateRow($values,$where);	
	}
	function porPagar(){
		$this->campos=array('a.Paterno,a.Materno,a.Nombres,cu.Nombre as Curso ,c.Numero  as Cuota,c.MontoPagar');
		$this->tabla="cuota c,alumno a,curso cu";
		return $this->getRecords("c.Cancelado=0  and c.CodAlumno=a.CodAlumno and a.Retirado=0 and cu.CodCurso=a.CodCurso","a.CodCurso,a.Paterno,a.Materno,a.Nombres,c.Numero");
	}
}
?>