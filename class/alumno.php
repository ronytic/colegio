<?php
include_once("bd.php");
class alumno extends bd{
	var $tabla="alumno";

	function mostrarDatosAlumnos($CodCurso,$Retirado=0){
		$this->campos=array('CodAlumno,LOWER(Paterno) as Paterno,LOWER(Materno) as Materno,LOWER(Nombres) as Nombres, Sexo');
		if($Retirado==2){
			$Retiro="Retirado=0 OR Retirado=1";
		}else{
			$Retiro="Retirado=$Retirado";	
		}
		return $this->getRecords(" CodCurso=$CodCurso and $Retiro","Paterno,Materno,Nombres");
	}
	/*Estadisticas*/
	function contarInscritosTotal(){
		$this->campos=array('count(*) as CantidadTotal');
		return $this->getRecords("Retirado=0");
	}
	function contarInscritoFechas(){
		$this->campos=array('count(*) as CantidadFecha,FechaIns');
		return $this->getRecords(" Retirado=0",false,"FechaIns");
	}
	function contarInscritoCurso(){
		$this->campos=array('count(*) as CantidadCurso,CodCurso');
		return $this->getRecords(" Retirado=0",false,"CodCurso");
	}
	function cantidadAlumno($where){
		$this->campos=array(' Count(*) as Cantidad');
		return $this->getRecords($where);
	}
	function mostrarTodoDatos($CodAlumno,$Retirado=0){
		$this->campos=array('*');
		if($Retirado==2){
			$Retiro="(Retirado=0 OR Retirado=1)";
		}else{
			$Retiro="Retirado=$Retirado";	
		}
		return $this->getRecords(" CodAlumno=$CodAlumno and $Retiro","Paterno,Materno,Nombres");
	}
	function contarInscritoNuevoCurso($CodCurso){
		$this->tabla="alumno a,rude r";
		//$this->tabla="alumno a,tmp_alumno tmp";
		$this->campos=array('count(*) as CantidadNuevo');
		return $this->getRecords("a.CodAlumno=r.CodAlumno and r.CodigoSie!='' and CodCurso=$CodCurso and Retirado=0",false,"CodCurso");
		//return $this->getRecords("tmp.Paterno=a.Paterno and tmp.Materno=a.Materno  and tmp.Nombres=a.Nombres and a.CodCurso=$CodCurso and a.Retirado=0",false,"a.CodCurso");
	}
	function verInscritosNuevosCurso($CodCurso,$Retirado=0){
		$this->tabla="alumno a,rude r";
		$this->campos=array('*');
		if($Retirado==2){
			$Retiro="(Retirado=0 OR Retirado=1)";
		}else{
			$Retiro="Retirado=$Retirado";	
		}
		return $this->getRecords("a.CodAlumno=r.CodAlumno and r.CodigoSie!='' and CodCurso=$CodCurso and $Retiro","Paterno,Materno,Nombres");
	}
	function mostrarDatosPersonales($CodAlumno,$Retirado=0,$tipo=false){
		$this->tabla="alumno a, curso c";
		if($Retirado==2){
			$Retiro="(Retirado=0 OR Retirado=1)";
		}else{
			$Retiro="Retirado=$Retirado";	
		}
		if(!$tipo){
			$this->campos=array("a.CodAlumno, LOWER(a.Paterno) as Paterno, LOWER(a.Materno) as Materno, LOWER(a.Nombres) as Nombres, LOWER(c.Nombre) as Nombre,c.CodCurso");
		}else{
			$this->campos=array("a.CodAlumno, UPPER(a.Paterno) as Paterno, UPPER(a.Materno) as Materno, UPPER(a.Nombres) as Nombres, UPPER(c.Nombre) as Nombre");
		}
		return $this->getRecords(" a.CodAlumno=$CodAlumno and a.CodCurso=c.CodCurso  and $Retiro","Paterno,Materno,Nombres");
	}
	
	function buscarHermanoApellidos($Paterno="",$Materno="",$Fecha="",$Retirado=0){
		$this->campos=array('CodAlumno');
		if($Fecha!=""){
			$Fecha=" and FechaIns='$Fecha'";	
		}
		if($Retirado==2){
			$Retiro="(Retirado=0 OR Retirado=1)";
		}else{
			$Retiro="Retirado=$Retirado";	
		}
		return $this->getRecords("Paterno='$Paterno' and Materno='$Materno' $Fecha"." and $Retiro","Paterno,Materno,Nombres");
	}
	/*Fin Estadisticas*/
	function mostrarDatosAlumnosWhere($Where,$Retirado=0){
		$this->campos=array('*');
		if($Retirado==2){
			$Retiro="(Retirado=0 OR Retirado=1)";
		}else{
			$Retiro="Retirado=$Retirado";	
		}
		return $this->getRecords($Where." and $Retiro","Paterno,Materno,Nombres");
	}
	function mostrarDatosAlumnosCursoWhere($Where,$Retirado=0){
		$this->campos=array('*');
		if($Retirado==2){
			$Retiro="(Retirado=0 OR Retirado=1)";
		}else{
			$Retiro="Retirado=$Retirado";	
		}
		if($Where!=""){
			$Retiro=" and $Retiro";
		}
		return $this->getRecords($Where." $Retiro","Paterno,Materno,Nombres,CodCurso");
	}
	
	function mostrarAlumnosCurso($CodCurso,$Sexo=2,$Retirado=0){
		$this->campos=array('*');
		if($Retirado==2){
			$Retiro="Retirado=0 OR Retirado=1";
		}else{
			$Retiro="Retirado=$Retirado";	
		}
		if($Sexo=="2"){
			$CodSexo=" (Sexo=0 OR Sexo=1)";
		}else{
			$CodSexo="Sexo=$Sexo";
		}
		return $this->getRecords(" CodCurso=$CodCurso AND $CodSexo and $Retiro","Paterno,Materno,Nombres");
	}
	function mostrarDatosCursoTotalBecado($Retirado=0){
		if($Retirado==2){
			$Retiro="Retirado=0 OR Retirado=1";
		}else{
			$Retiro="Retirado=$Retirado";	
		}
		$this->campos=array('*');
		return $this->getRecords("MontoBeca!=0 and $Retiro","CodCurso,Paterno,Materno,Nombres");
	}
	function mostrarDatosPorNombreOrden($Nombres="",$Orden='CodCurso',$Retirado=0){
		if($Retirado==2){
			$Retiro="Retirado=0 OR Retirado=1";
		}else{
			$Retiro="Retirado=$Retirado";	
		}
		$palabras=explode(' ',$Nombres); 
		$Condicion=''; 
		foreach ($palabras as $palabra) { 
		if (''!=$Condicion) $Condicion.=' AND '; 
		$Condicion.="(Nombres LIKE '%$palabra%' OR Paterno LIKE '%$palabra%' OR Materno LIKE '%$palabra%')"; 
		} 
		
		$this->campos=array('CodAlumno,Nombres,Paterno,Materno,CodCurso');
		return $this->getRecords("$Condicion and $Retiro","Paterno ASC,Materno ASC,Nombres ASC,$Orden ");
	}
	function mostrarDatosCodBarra($Where,$Retirado=0){
		$this->campos=array('*');
		if($Retirado==2){
			$Retiro="Retirado=0 OR Retirado=1";
		}else{
			$Retiro="Retirado=$Retirado";	
		}
		return $this->getRecords($Where." and $Retiro");
	}
	function actualizarDatosAlumno($values,$CodAlumno){
		return $this->updateRow($values,"CodAlumno=$CodAlumno");	
	}
	/*function mostrarDatosAlumnos($CodCurso, $Retirado=0){
		if($Retirado==2){
			$Retiro="Retirado=0 and Retirado=1";
		}else{
			$Retiro="Retirado=$Retirado";	
		}
		$this->campos=array('CodAlumno,LOWER(Paterno) as Paterno,LOWER(Materno) as Materno,LOWER(Nombres) as Nombres,Sexo');
		return $this->getRecords(" CodCurso=$CodCurso and $Retiro","Paterno,Materno,Nombres");
	}
	
	
	
	function mostrarDatosCuota($CodAlumno){
		$this->campos=array('*');
		return $this->getRecords(" CodAlumno=$CodAlumno");
	}
	
	
	
	function contarInscritosCurso($CodAlumno){
		$this->campos=array('count(*) as CantidadTotal');
		return $this->getRecords("Retirado=0 and CodCurso=(SELECT CodCurso FROM alumno WHERE CodAlumno=$CodAlumno)");
	}
	*/
	function loginPadre($Usuario,$Password){
		$this->campos=array("count(*) as Can,CodAlumno as CodUsuario");	
		return $this->getRecords("UsuarioPadre='$Usuario' and PasswordP='$Password'");
	}
	function loginAlumno($Usuario,$Password){
		$this->campos=array("count(*) as Can,CodAlumno as CodUsuario");	
		return $this->getRecords("UsuarioAlumno='$Usuario' and Password='$Password'");
	}
	function insertarAlumno($Values){
		$this->insertRow($Values,1);
	}
}
?>