<?php 
include_once("../../login/check.php");
if(!empty($_GET) && $_GET['lock']==md5('lock')){
	$titulo=$idioma['ReporteIndependienteAgenda'];
	
	$CodAlumno=$_SESSION['CodAl'];
	include_once("../../class/alumno.php");
	include_once("../../class/curso.php");
	include_once("../../class/agenda.php");
	include_once("../../class/observaciones.php");
	include_once("../../class/materias.php");
	include_once("../../class/config.php");
	
	$agenda=new agenda;
	$materia=new materias;
	$observaciones=new observaciones;
	$alumno=new alumno;
	$curso=new curso;
	$config=new config;
	
	$al=array_shift($alumno->mostrarTodoDatos($CodAlumno));
	$cur=array_shift($curso->mostrarCurso($al['CodCurso']));
	//Cantidad de Observaciones
	$CodObser=$observaciones->CodObservaciones(1);
	foreach($CodObser as $CodO){$Obser[]=$CodO['CodObservacion'];}
	$CodigosObservaciones=implode(",",$Obser);
	$CantObser=$agenda->CantidadObservaciones($CodAlumno,$CodigosObservaciones,$_GET['CodMateria']);
	$CantObser=array_shift($CantObser);
	//Cantidad de Faltas
	$Obser=array();
	$CodObser=$observaciones->CodObservaciones(2);
	foreach($CodObser as $CodO){$Obser[]=$CodO['CodObservacion'];}
	$CodigosObservaciones=implode(",",$Obser);
	$CantFaltas=$agenda->CantidadObservaciones($CodAlumno,$CodigosObservaciones,$_GET['CodMateria']);
	$CantFaltas=array_shift($CantFaltas);
	//Cantidad de Atrasos
	$Obser=array();
	$CodObser=$observaciones->CodObservaciones(3);
	foreach($CodObser as $CodO){$Obser[]=$CodO['CodObservacion'];}
	$CodigosObservaciones=implode(",",$Obser);
	$CantAtrasos=$agenda->CantidadObservaciones($CodAlumno,$CodigosObservaciones,$_GET['CodMateria']);
	$CantAtrasos=array_shift($CantAtrasos);
	//Cantidad de Licencias
	$Obser=array();
	$CodObser=$observaciones->CodObservaciones(4);
	foreach($CodObser as $CodO){$Obser[]=$CodO['CodObservacion'];}
	$CodigosObservaciones=implode(",",$Obser);
	$CantLicencias=$agenda->CantidadObservaciones($CodAlumno,$CodigosObservaciones,$_GET['CodMateria']);
	$CantLicencias=array_shift($CantLicencias);
	//Cantidad de Felicitaciones
	$Obser=array();
	$CodObser=$observaciones->CodObservaciones(5);
	foreach($CodObser as $CodO){$Obser[]=$CodO['CodObservacion'];}
	$CodigosObservaciones=implode(",",$Obser);
	$CantNotificacion=$agenda->CantidadObservaciones($CodAlumno,$CodigosObservaciones,$_GET['CodMateria']);
	$CantNotificacion=array_shift($CantNotificacion);
	//Cantidad de No contestan
	$Obser=array();
	$CodObser=$observaciones->CodObservaciones(6);
	foreach($CodObser as $CodO){$Obser[]=$CodO['CodObservacion'];}
	$CodigosObservaciones=implode(",",$Obser);
	$CantNoContestan=$agenda->CantidadObservaciones($CodAlumno,$CodigosObservaciones,$_GET['CodMateria']);
	$CantNoContestan=array_shift($CantNoContestan);
	//Cantidad de Felicitaciones
	$Obser=array();
	$CodObser=$observaciones->CodObservaciones(7);
	foreach($CodObser as $CodO){$Obser[]=$CodO['CodObservacion'];}
	$CodigosObservaciones=implode(",",$Obser);
	$CantFelicitacion=$agenda->CantidadObservaciones($CodAlumno,$CodigosObservaciones,$_GET['CodMateria']);
	$CantFelicitacion=array_shift($CantFelicitacion);
	$Total=$CantObser['Cantidad']+$CantFaltas['Cantidad']+$CantAtrasos['Cantidad']+$CantLicencias['Cantidad']+$CantNotificacion['Cantidad']+$CantNoContestan['Cantidad']+$CantFelicitacion['Cantidad'];
	
	/*Sacando Fecha de Trimestre*/
	if($cur['Bimestre']){
		$cnf=$config->mostrarConfig("InicioBimestre1");
		$fechaInicioBimestre1=$cnf['Valor'];
		$cnf=$config->mostrarConfig("FinBimestre1");
		$fechaFinBimestre1=$cnf['Valor'];
		$cnf=$config->mostrarConfig("InicioBimestre2");
		$fechaInicioBimestre2=$cnf['Valor'];
		$cnf=$config->mostrarConfig("FinBimestre2");
		$fechaFinBimestre2=$cnf['Valor'];
		$cnf=$config->mostrarConfig("InicioBimestre3");
		$fechaInicioBimestre3=$cnf['Valor'];
		$cnf=$config->mostrarConfig("FinBimestre3");
		$fechaFinBimestre3=$cnf['Valor'];
		$cnf=$config->mostrarConfig("InicioBimestre4");
		$fechaInicioBimestre4=$cnf['Valor'];
		$cnf=$config->mostrarConfig("FinBimestre4");
		$fechaFinBimestre4=$cnf['Valor'];
	}else{
		$cnf=$config->mostrarConfig("InicioTrimestre1");
		$fechaInicioTrimestre1=$cnf['Valor'];
		$cnf=$config->mostrarConfig("FinTrimestre1");
		$fechaFinTrimestre1=$cnf['Valor'];
		$cnf=$config->mostrarConfig("InicioTrimestre2");
		$fechaInicioTrimestre2=$cnf['Valor'];
		$cnf=$config->mostrarConfig("FinTrimestre2");
		$fechaFinTrimestre2=$cnf['Valor'];
		$cnf=$config->mostrarConfig("InicioTrimestre3");
		$fechaInicioTrimestre3=$cnf['Valor'];
		$cnf=$config->mostrarConfig("FinTrimestre3");
		$fechaFinTrimestre3=$cnf['Valor'];
	}
	/*Fin de Sacando Información de Trimestre*/
	
	if(isset($_GET['CodMateria'])){
		$CodMateria=$_GET['CodMateria'];
		$mat=$materia->mostrarMateria($CodMateria);
		$mat=array_shift($mat);
		$ag=$agenda->mostrarRegistroMateriaAlumno(0,$al['CodCurso'],$CodMateria,$CodAlumno);
	}else{
		$ag=$agenda->mostrarRegistros($CodAlumno);
	}
	
	$ima="../../imagenes/alumnos/".$al['Foto'];
	if(!file_exists($ima) || empty($al['Foto'])){
		 $ima="../../imagenes/alumnos/0.jpg";	
	}
	include_once("../pdf.php");
	class PDF extends PPDF{
		function Cabecera(){
			$this->Pagina();
			$this->ln();
		}
	}
	$pdf=new PDF("P","mm","letter");//612,792
	$pdf->AddPage();
	$borde=0;
	$pdf->Image($ima,164,60,30,30);
	$pdf->CuadroCuerpoPersonalizado(176,$idioma["DatosPersonales"],1,"",0,"B");
	$pdf->Ln();$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Nombre"].": ",0,"L",$borde,"B");
	$pdf->CuadroNombre(100,$al['Paterno'],$al['Materno'],$al['Nombres'],1,$relleno);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Sexo"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,$al['Sexo']?$idioma['Masculino']:$idioma['Femenino'],0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Curso"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,$cur['Nombre'],0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Direccion"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($al['Zona']." ".$al['Calle']." ".$al['Numero']),0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["TelefonoCasa"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,$al['TelefonoCasa'],0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Celular"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,$al['Celular'],0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["CelularPadre"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,$al['CelularP'],0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["CelularMadre"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,$al['CelularM'],0,"",$borde);
	if(isset($mat)){
		$pdf->ln();
		$pdf->CuadroCuerpoPersonalizado(40,$idioma["SoloMateria"].": ",0,"L",$borde,"B");
		$pdf->CuadroCuerpo(100,$mat['Nombre'],0,"",$borde);
	}
	
	$pdf->Ln();$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(176,$idioma["Estadistica"],1,"",0,"B");
	$pdf->ln();$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Observaciones"]." ",0,"C",1,"B");
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Felicitaciones"]." ",0,"C",1,"B");
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Faltas"]." ",0,"C",1,"B");
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Atrasos"]." ",0,"C",1,"B");
	$pdf->ln();
	$pdf->CuadroCuerpo(40,$CantObser['Cantidad'],0,"C",$borde);
	$pdf->CuadroCuerpo(40,$CantFelicitacion['Cantidad'],0,"C",$borde);
	$pdf->CuadroCuerpo(40,$CantFaltas['Cantidad'],0,"C",$borde);
	$pdf->CuadroCuerpo(40,$CantAtrasos['Cantidad'],0,"C",$borde);
	
	$pdf->ln();
	
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Licencias"]." ",0,"C",1,"B");
	$pdf->CuadroCuerpoPersonalizado(50,$idioma["NotificacionPadres"]." ",0,"C",1,"B");
	$pdf->CuadroCuerpoPersonalizado(50,$idioma["NoRespondeTelf"]." ",0,"C",1,"B");
	$pdf->CuadroCuerpoPersonalizado(35,$idioma["Total"]." ",0,"C",1,"B");
	$pdf->ln();
	
	$pdf->CuadroCuerpo(40,$CantLicencias['Cantidad'],0,"C",$borde);
	$pdf->CuadroCuerpo(50,$CantNotificacion['Cantidad'],0,"C",$borde);
	$pdf->CuadroCuerpo(50,$CantNoContestan['Cantidad'],0,"C",$borde);
	$pdf->CuadroCuerpo(35,$Total,0,"C",$borde);
	
	$pdf->Ln();$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(176,$idioma["RegistroAgenda"],1,"",0,"B");
	$pdf->ln();$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(8,"N",1,"C",1,"B");
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Materia"],1,"C",1,"B");
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Observacion"],1,"C",1,"B");
	$pdf->CuadroCuerpoPersonalizado(60,$idioma["Detalle"],1,"C",1,"B");
	$pdf->CuadroCuerpoPersonalizado(20,$idioma["Fecha"],1,"C",1,"B");
	$pdf->CuadroCuerpoPersonalizado(10,recortartexto($idioma["Periodo"],5,""),1,"C",1,"B");
	$pdf->Ln();
	$i=0;
	foreach($ag as $a){$i++;
		$tipo=0;
		$mensaje="";
			if($cur['Bimestre']){
				
				if(strtotime($a['Fecha'])>=strtotime($fechaInicioBimestre1) and strtotime($a['Fecha'])<=strtotime($fechaFinBimestre1)){$tipo=1;}
				if(strtotime($a['Fecha'])>=strtotime($fechaInicioBimestre2) and strtotime($a['Fecha'])<=strtotime($fechaFinBimestre2)){$tipo=2;}
				if(strtotime($a['Fecha'])>=strtotime($fechaInicioBimestre3) and strtotime($a['Fecha'])<=strtotime($fechaFinBimestre3)){$tipo=3;}
				if(strtotime($a['Fecha'])>=strtotime($fechaInicioBimestre4) and strtotime($a['Fecha'])<=strtotime($fechaFinBimestre4)){$tipo=4;}
				$mensaje=$tipo." ".$idioma['Bimestre'];
			}else{
				if(strtotime($a['Fecha'])>=strtotime($fechaInicioTrimestre1) and strtotime($a['Fecha'])<=strtotime($fechaFinTrimestre1)){$tipo=1;}
				if(strtotime($a['Fecha'])>=strtotime($fechaInicioTrimestre2) and strtotime($a['Fecha'])<=strtotime($fechaFinTrimestre2)){$tipo=2;}
				if(strtotime($a['Fecha'])>=strtotime($fechaInicioTrimestre3) and strtotime($a['Fecha'])<=strtotime($fechaFinTrimestre3)){$tipo=3;}
				$mensaje=$tipo." ".$idioma['Trimestre'];
			}
			$importante="";
			if($a['Resaltar']){$importante="-I";}
			$m=$materia->mostrarMateria($a['CodMateria']);
			$m=array_shift($m);
			$o=$observaciones->mostrarObser($a['CodObservacion']);
			$o=array_shift($o);
			$pdf->CuadroCuerpo(8,$i,0,"R",1,"B");
			$pdf->CuadroCuerpo(40,$m["Nombre"],0,"L",1,"B");
			$pdf->CuadroCuerpo(40,recortartexto($o["Nombre"],23),0,"L",1,"B");
			$pdf->CuadroCuerpo(60,recortartexto(minuscula($a["Detalle"]),33),0,"L",1,"B");
			$pdf->CuadroCuerpo(20,fecha2Str($a["Fecha"]),0,"C",1,"B");
			$pdf->CuadroCuerpo(10,sacariniciales($mensaje).$importante,0,"L",1,"B");
			$pdf->Ln();
	}
	$pdf->Output($titulo." ".capitalizar($al['Paterno']." ".$al['Materno']." ".$al['Nombres']),"I");
}
?>