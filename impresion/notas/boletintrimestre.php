<?php
include_once("../../login/check.php");
if(!empty($_GET) && isset($_GET['mf']) && $_GET['mf']==md5("lock")){
	$CodCurso=$_GET['CodCurso'];
	$CodAlumno=$_GET['CodAlumno'];	
	include_once("../../class/config.php");
	include_once("../../class/alumno.php");
	include_once("../../class/curso.php");
	include_once("../../class/cursomateria.php");
	include_once("../../class/materias.php");
	include_once("../../class/casilleros.php");
	include_once("../../class/registronotas.php");
	
	include_once("../../class/observaciones.php");
	include_once("../../class/agenda.php");
	
	$observaciones=new observaciones;
	$agenda=new agenda;
	
	include_once("../fpdf/fpdf.php");
	$alumno=new alumno;
	$curso=new curso;
	$cursomateria=new cursomateria;
	$materias=new materias;
	$casilleros=new casilleros;
	$registronotas=new registronotas;
	$config=new config;
	$pdf=new FPDF("P","mm","letter");//612,792
	$pdf->SetAutoPageBreak(true,15);
	//$pdf->SetMargins(0,0,0);
	$pdf->AddPage();
	$pdf->SetFont("Arial","",11);
	$al=array_shift($alumno->mostrarTodoDatos($CodAlumno));
	$cur=array_shift($curso->mostrarCurso($CodCurso));
	if($cur['Bimestre']){
		$PeriodoActualConfig="PeriodoActualBimestre";
	}else{
		$PeriodoActualConfig="PeriodoActualTrimestre";	
	}
	$cnf=($config->mostrarConfig($PeriodoActualConfig));
	$PeriodoActual=$cnf['Valor'];
	$cnf=$config->mostrarConfig("Anio");
	$anio=$cnf['Valor'];
	//Sacar el Codigo del del trimestre desde ahi
	
	//Boletin
	$cnf=($config->mostrarConfig("BoletinPosicion1X"));
	$boletin1x=$cnf['Valor'];
	$cnf=($config->mostrarConfig("BoletinPosicion1Y"));
	$boletin1y=$cnf['Valor'];
	$cnf=($config->mostrarConfig("BoletinPosicion2X"));
	$boletin2x=$cnf['Valor'];
	$cnf=($config->mostrarConfig("BoletinPosicion2Y"));
	$boletin2y=$cnf['Valor'];
	$cnf=($config->mostrarConfig("BoletinPosicion3X"));
	$boletin3x=$cnf['Valor'];
	$cnf=($config->mostrarConfig("BoletinPosicion3Y"));
	$boletin3y=$cnf['Valor'];
	$cnf=($config->mostrarConfig("BoletinPosicion4X"));
	$boletin4x=$cnf['Valor'];
	$cnf=($config->mostrarConfig("BoletinPosicion4Y"));
	$boletin4y=$cnf['Valor'];

	$bordeC=0;
	
	$pdf->SetXY($boletin1x+25,$boletin1y+48);
	$pdf->Cell(120,5,$idioma["Nombre"].": ".mb_strtoupper(utf8_decode($al['Paterno']." ".$al['Materno']." ".$al['Nombres'])),$bordeC);
	$pdf->SetXY($boletin1x+25,$boletin1y+53);
	$pdf->Cell(120,5,utf8_decode($idioma["Curso"].": ".$cur['Nombre']),$bordeC);
	$pdf->SetXY($boletin2x+130,$boletin2y+48);
	$pdf->Cell(30,5,utf8_decode($idioma["Gestion"].": ".$anio),$bordeC);
	$pdf->SetXY($boletin2x+130,$boletin2y+53);
	$pdf->Cell(50,5,utf8_decode($idioma["Fecha"].": ".strftime("%A, %d de %B de %Y")),$bordeC);
	$i=0;
	$pdf->SetFillColor(210,210,210);
	foreach($cursomateria->mostrarMaterias($CodCurso) as $matbol){
		$mat=$materias->mostrarMateria($matbol['CodMateria']);
		$mat=array_shift($mat);
		$pdf->SetXY($boletin3x+15,$boletin3y+80+$i);
		if($matbol['Alterno']==1)
			$pdf->Cell(45,4,utf8_decode($mat['Nombre']),$bordeC);
		if($matbol['Alterno']==2)
			$pdf->Cell(45,4,utf8_decode($mat['NombreAlterno1']),$bordeC);
		if($matbol['Alterno']==3)
			$pdf->Cell(45,4,utf8_decode($mat['NombreAlterno2']),$bordeC);
		
		$cont=0;
		$sumanotas=0;
		
		$casillas=array_shift($casilleros->mostrarMateriaCursoSexoTrimestre($mat['CodMateria'],$CodCurso,$al['Sexo'],1));
		$regNotas=$registronotas->notasBoletin($CodAlumno,$casillas['CodCasilleros']);
		$regNotas=array_shift($regNotas);
		$sumanotas+=$regNotas['NotaFinal'];
		///Primer Trimestre
		if($PeriodoActual>=1){
			if($cur['NotaAprobacion']>$regNotas['NotaFinal']){
				$bordeN=1;
			}else{
				$bordeN=0;
			}
			$pdf->SetXY($boletin4x+63,$boletin4y+80+$i);
			$pdf->Cell(6,4,$regNotas['Resultado'],$bordeC,0,"R");//Nota
			$pdf->SetXY($boletin4x+75,$boletin4y+80+$i);
			if($casillas['Dps']==1)
			$pdf->Cell(6,4,$regNotas['Dps'],$bordeC,0,"R");//DPS
			$pdf->SetXY($boletin4x+86,$boletin4y+80+$i);
			$pdf->Cell(6,4,$regNotas['NotaFinal'],$bordeN,0,"R",$bordeN);//Puntaje Trimestral
			$cont++;
		}
			
		$casillas=array_shift($casilleros->mostrarMateriaCursoSexoTrimestre($mat['CodMateria'],$CodCurso,$al['Sexo'],2));
		$regNotas=$registronotas->notasBoletin($CodAlumno,$casillas['CodCasilleros']);
		$regNotas=array_shift($regNotas);
		$sumanotas+=$regNotas['NotaFinal'];
		//Segundo Trimestre
		if($PeriodoActual>=2){
			if($cur['NotaAprobacion']>$regNotas['NotaFinal']){
				$bordeN=1;
			}else{
				$bordeN=0;
			}
			$pdf->SetXY($boletin4x+95,$boletin4y+80+$i);
			$pdf->Cell(6,4,$regNotas['Resultado'],$bordeC,0,"R");//Nota
			//$pdf->Cell(6,4,"00",$bordeC,0,"R");
			$pdf->SetXY($boletin4x+106,$boletin4y+80+$i);
			if($casillas['Dps']==1)
			$pdf->Cell(6,4,$regNotas['Dps'],$bordeC,0,"R");//DPS
			//$pdf->Cell(6,4,"00",$bordeC,0,"R");
			$pdf->SetXY($boletin4x+116,$boletin4y+80+$i);
			$pdf->Cell(6,4,$regNotas['NotaFinal'],$bordeN,0,"R",$bordeN);//Puntaje Trimestral
			//$pdf->Cell(6,4,"00",$bordeC,0,"R");
			$cont++;
		}
		
		$casillas=array_shift($casilleros->mostrarMateriaCursoSexoTrimestre($mat['CodMateria'],$CodCurso,$al['Sexo'],3));
		$regNotas=$registronotas->notasBoletin($CodAlumno,$casillas['CodCasilleros']);
		$regNotas=array_shift($regNotas);
		$sumanotas+=$regNotas['NotaFinal'];
		///Tercer Trimestre
		if($PeriodoActual>=3){
			if($cur['NotaAprobacion']>$regNotas['NotaFinal']){
				$bordeN=1;
			}else{
				$bordeN=0;
			}
			$pdf->SetXY($boletin4x+127,$boletin4y+80+$i);
			$pdf->Cell(6,4,$regNotas['Resultado'],$bordeC,0,"R");//Nota
			//$pdf->Cell(6,4,"00",$bordeC,0,"R");
			$pdf->SetXY($boletin4x+138,$boletin4y+80+$i);
			if($casillas['Dps']==1)
			$pdf->Cell(6,4,$regNotas['Dps'],$bordeC,0,"R");//DPS
			//$pdf->Cell(6,4,"00",$bordeC,0,"R");
			$pdf->SetXY($boletin4x+148,$boletin4y+80+$i);
			$pdf->Cell(6,4,$regNotas['NotaFinal'],$bordeN,0,"R",$bordeN);//Puntaje Trimestral
			//$pdf->Cell(6,4,"00",$bordeC,0,"R");
			$cont++;
		}
		
		
		
		$casillas=array_shift($casilleros->mostrarMateriaCursoSexoTrimestre($mat['CodMateria'],$CodCurso,$al['Sexo'],4));
		
		$regNotas=array_shift($registronotas->notasBoletin($CodAlumno,$casillas['CodCasilleros']));
		
		//$sumanotas+=$regNotas['NotaFinal'];
		$promediofinal=round($sumanotas/3);
		
		if($regNotas['Nota2']!=0){
			$promedioanual=round(($promediofinal+$regNotas['Nota2'])/2);	
		}else{
			$promedioanual=$promediofinal;	
		}
		
		if($cont==3){
			
			if($cur['NotaAprobacion']>$promediofinal){
				$bordeN=1;
			}else{
				$bordeN=0;
			}
		$pdf->SetXY(162,80+$i);
		$pdf->Cell(6,4,$promediofinal,$bordeN,0,"R",$bordeN);//Promedio Anual
		
			//if($cur['NotaAprobacion']>$regNotas['Nota2']){
				//$bordeN=1;
			//}else{
				$bordeN=0;
			//}
			
		$pdf->SetXY(180,80+$i);
		$pdf->Cell(6,4,$regNotas['Nota2'],$bordeN,0,"R",$bordeN);//Reforzamiento
		
			if($cur['NotaAprobacion']>$promedioanual){
				$bordeN=1;
			}else{
				$bordeN=0;
			}
		$pdf->SetXY(198,80+$i);
		$pdf->Cell(6,4,$promedioanual,$bordeN,0,"R",$bordeN);//Promedio Final
		}
		$i+=4;//Salto para abajo
	}
	
	
	
	/************************INICIO*******************/
		//Cantidad de Observaciones
		$CodAl=$CodAlumno;
	$CodObser=$observaciones->CodObservaciones(1);
	foreach($CodObser as $CodO){$Obser[]=$CodO['CodObservacion'];}
	$CodigosObservaciones=implode(",",$Obser);
	$CantObser=$agenda->CantidadObservaciones($CodAl,$CodigosObservaciones);
	$CantObser=array_shift($CantObser);
		//Cantidad de Faltas
	$Obser=array();
	$CodObser=$observaciones->CodObservaciones(2);
	foreach($CodObser as $CodO){$Obser[]=$CodO['CodObservacion'];}
	$CodigosObservaciones=implode(",",$Obser);
	$CantFaltas=$agenda->CantidadObservaciones($CodAl,$CodigosObservaciones);
	$CantFaltas=array_shift($CantFaltas);
	//Cantidad de Atrasos
	$Obser=array();
	$CodObser=$observaciones->CodObservaciones(3);
	foreach($CodObser as $CodO){$Obser[]=$CodO['CodObservacion'];}
	$CodigosObservaciones=implode(",",$Obser);
	$CantAtrasos=$agenda->CantidadObservaciones($CodAl,$CodigosObservaciones);
	$CantAtrasos=array_shift($CantAtrasos);
	//Cantidad de Licencias
	$Obser=array();
	$CodObser=$observaciones->CodObservaciones(4);
	foreach($CodObser as $CodO){$Obser[]=$CodO['CodObservacion'];}
	$CodigosObservaciones=implode(",",$Obser);
	$CantLicencias=$agenda->CantidadObservaciones($CodAl,$CodigosObservaciones);
	$CantLicencias=array_shift($CantLicencias);
	//Cantidad de Felicitaciones
	$Obser=array();
	$CodObser=$observaciones->CodObservaciones(5);
	foreach($CodObser as $CodO){$Obser[]=$CodO['CodObservacion'];}
	$CodigosObservaciones=implode(",",$Obser);
	$CantNotificacion=$agenda->CantidadObservaciones($CodAl,$CodigosObservaciones);
	$CantNotificacion=array_shift($CantNotificacion);
	//Cantidad de No contestan
	$Obser=array();
	$CodObser=$observaciones->CodObservaciones(6);
	foreach($CodObser as $CodO){$Obser[]=$CodO['CodObservacion'];}
	$CodigosObservaciones=implode(",",$Obser);
	$CantNoContestan=$agenda->CantidadObservaciones($CodAl,$CodigosObservaciones);
	$CantNoContestan=array_shift($CantNoContestan);
	//Cantidad de Felicitaciones
	$Obser=array();
	$CodObser=$observaciones->CodObservaciones(7);
	foreach($CodObser as $CodO){$Obser[]=$CodO['CodObservacion'];}
	$CodigosObservaciones=implode(",",$Obser);
	$CantFelicitacion=$agenda->CantidadObservaciones($CodAl,$CodigosObservaciones);
	$CantFelicitacion=array_shift($CantFelicitacion);
	$Total=$CantObser['Cantidad']+$CantFaltas['Cantidad']+$CantAtrasos['Cantidad']+$CantLicencias['Cantidad']+$CantNotificacion['Cantidad']+$CantNoContestan['Cantidad']+$CantFelicitacion['Cantidad'];
	/********************FIN DE AGENDA****************/
	$pdf->SetXY(15,160);
	$pdf->Cell(150,5,utf8_decode($idioma["EstadisticaAgenda"].":"),0,1);
	$pdf->SetX(15);
	$pdf->Cell(30,5,utf8_decode($idioma["Observaciones"]),1,0,"C");
	$pdf->Cell(15,5,utf8_decode($idioma["Faltas"]),1,0,"C");
	$pdf->Cell(15,5,utf8_decode($idioma["Atrasos"]),1,0,"C");
	$pdf->Cell(20,5,utf8_decode($idioma["Licencias"]),1,0,"C");
	
	$pdf->Cell(35,5,utf8_decode($idioma["NotificacionPadres"]),1,0,"C");
	$pdf->SetFont("Arial","",8);
	$pdf->Cell(25,5,utf8_decode($idioma["NoRespondeTelf"]),1,0,"C");
	$pdf->SetFont("Arial","",11);
	$pdf->Cell(30,5,utf8_decode($idioma["Felicitaciones"]),1,0,"C");
	$pdf->Cell(15,5,utf8_decode($idioma["Total"]),1,0,"C");
	$pdf->Ln();
	$pdf->SetX(15);
	$pdf->Cell(30,5,$CantObser['Cantidad'],1,0,"C");
	$pdf->Cell(15,5,$CantFaltas['Cantidad'],1,0,"C");
	$pdf->Cell(15,5,$CantAtrasos['Cantidad'],1,0,"C");
	$pdf->Cell(20,5,$CantLicencias['Cantidad'],1,0,"C");
	$pdf->Cell(35,5,$CantNotificacion['Cantidad'],1,0,"C");
	$pdf->Cell(25,5,$CantNoContestan['Cantidad'],1,0,"C");
	$pdf->Cell(30,5,$CantFelicitacion['Cantidad'],1,0,"C");
	$pdf->Cell(15,5,$Total,1,0,"C");
	$pdf->Ln();
	$pdf->SetX(15);
	$pdf->Cell(150,5,utf8_decode($idioma["RevisarConstantemente"]),0,1);
	$pdf->Output("Boletín Trimestre","I");
}
?>