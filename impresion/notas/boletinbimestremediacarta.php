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
	$titulo=$idioma["BoletinBimestral"];
    $FechaReporte=0;
	include_once("../pdf.php");
	$alumno=new alumno;
	$curso=new curso;
	$cursomateria=new cursomateria;
	$materias=new materias;
	$casilleros=new casilleros;
	$registronotas=new registronotas;
	$config=new config;
    $al=array_shift($alumno->mostrarTodoDatos($CodAlumno));
	$cur=array_shift($curso->mostrarCurso($CodCurso));
	if($cur['Bimestre']){
		$PeriodoActualConfig="PeriodoActualBimestre";
	}else{
		$PeriodoActualConfig="PeriodoActualTrimestre";	
	}
	$cnf=($config->mostrarConfig($PeriodoActualConfig));
	$PeriodoActual=$cnf['Valor'];
	$cnf=($config->mostrarConfig("Anio"));
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
    
    
    class PDF extends PPDF{
        function Cabecera(){
            global $idioma,$al,$anio,$cur;
            $this->CuadroCabecera(20,$idioma["Nombre"].": ",100,mb_strtoupper(utf8_decode($al['Paterno']." ".$al['Materno']." ".$al['Nombres'])));  
            $this->CuadroCabecera(20,$idioma["Gestion"].": ",60,$anio); 
            $this->ln();  
            $this->CuadroCabecera(20,$idioma["Curso"].": ",100,$cur['Nombre']); 
            $this->CuadroCabecera(20,$idioma["Fecha"].": ",60,strftime("%d/%m/%Y"));
            $this->ln();  
            $this->TituloCabecera(50,$idioma['Materia']);
            $this->TituloCabecera(25,"1 ".$idioma['Bimestre']);
            $this->TituloCabecera(25,"2 ".$idioma['Bimestre']);
            $this->TituloCabecera(25,"3 ".$idioma['Bimestre']);
            $this->TituloCabecera(25,"4 ".$idioma['Bimestre']);
        }    
    }
	$pdf=new PDF("P","mm",array(215.9,139.7));//612,792
    //215.9     w
    //279,4     h
	$pdf->SetAutoPageBreak(true,15);
	$pdf->SetMargins(0,0,0);
	$pdf->AddPage();
    $pdf->AltoCelda(4);
	$pdf->SetFont("Arial","",11);
	$bordeC="1";
	$i=0;
	$pdf->SetFillColor(210,210,210);
	foreach($cursomateria->mostrarMaterias($CodCurso) as $matbol){
		$mat=$materias->mostrarMateria($matbol['CodMateria']);
		$mat=array_shift($mat);
		if($matbol['Alterno']==1)
			$pdf->CuadroCuerpo(50,$mat['Nombre'],0,"L",$bordeC);
		if($matbol['Alterno']==2)
			$pdf->CuadroCuerpo(50,$mat['NombreAlterno1'],0,"L",$bordeC);
		if($matbol['Alterno']==3)
			$pdf->CuadroCuerpo(50,$mat['NombreAlterno2'],0,"L",$bordeC);
		$cont=0;
		$sumanotas=0;
		
		$casillas=array_shift($casilleros->mostrarMateriaCursoSexoTrimestre($mat['CodMateria'],$CodCurso,$al['Sexo'],1));
		$regNotas=$registronotas->notasBoletin($CodAlumno,$casillas['CodCasilleros']);
		$regNotas=array_shift($regNotas);
		$sumanotas+=$regNotas['NotaFinal'];
		///Primer Bimestre
		if($PeriodoActual>=1){
			if($cur['NotaAprobacion']>$regNotas['NotaFinal']){
				$bordeN=0;
			}else{
				$bordeN=0;
			}
			/*$pdf->SetXY($boletin4x+63,$boletin4y+80+$i);
			$pdf->Cell(6,4,$regNotas['Resultado'],$bordeC,0,"R");//Nota
			$pdf->SetXY($boletin4x+75,$boletin4y+80+$i);
			if($casillas['Dps']==1)
			$pdf->Cell(6,4,$regNotas['Dps'],$bordeC,0,"R");//DPS*/
			$pdf->CuadroCuerpo(25,$regNotas['NotaFinal'],0,"C",$bordeC);//Puntaje Trimestral
			$cont++;
		}
			
		$casillas=array_shift($casilleros->mostrarMateriaCursoSexoTrimestre($mat['CodMateria'],$CodCurso,$al['Sexo'],2));
		$regNotas=$registronotas->notasBoletin($CodAlumno,$casillas['CodCasilleros']);
		$regNotas=array_shift($regNotas);
		$sumanotas+=$regNotas['NotaFinal'];
		//Segundo Bimestre
		if($PeriodoActual>=2){
			if($cur['NotaAprobacion']>$regNotas['NotaFinal']){
				$bordeN=0;
			}else{
				$bordeN=0;
			}
			/*$pdf->SetXY($boletin4x+95,$boletin4y+80+$i);
			$pdf->Cell(6,4,$regNotas['Resultado'],$bordeC,0,"R");//Nota
			//$pdf->Cell(6,4,"00",$bordeC,0,"R");
			$pdf->SetXY($boletin4x+106,$boletin4y+80+$i);
			if($casillas['Dps']==1)
			$pdf->Cell(6,4,$regNotas['Dps'],$bordeC,0,"R");//DPS
			//$pdf->Cell(6,4,"00",$bordeC,0,"R");*/
			$pdf->CuadroCuerpo(25,$regNotas['NotaFinal'],0,"C",$bordeC);//Puntaje Trimestral
			//$pdf->Cell(6,4,"00",$bordeC,0,"R");
			$cont++;
		}
		
		
		$casillas=array_shift($casilleros->mostrarMateriaCursoSexoTrimestre($mat['CodMateria'],$CodCurso,$al['Sexo'],3));
		$regNotas=$registronotas->notasBoletin($CodAlumno,$casillas['CodCasilleros']);
		$regNotas=array_shift($regNotas);
		$sumanotas+=$regNotas['NotaFinal'];
		///Tercer Bimestre
		if($PeriodoActual>=3){
			if($cur['NotaAprobacion']>$regNotas['NotaFinal']){
				$bordeN=0;
			}else{
				$bordeN=0;
			}
			/*$pdf->SetXY($boletin4x+127,$boletin4y+80+$i);
			$pdf->Cell(6,4,$regNotas['Resultado'],$bordeC,0,"R");//Nota
			//$pdf->Cell(6,4,"00",$bordeC,0,"R");
			$pdf->SetXY($boletin4x+138,$boletin4y+80+$i);
			if($casillas['Dps']==1)
			$pdf->Cell(6,4,$regNotas['Dps'],$bordeC,0,"R");//DPS
			//$pdf->Cell(6,4,"00",$bordeC,0,"R");*/
			$pdf->CuadroCuerpo(25,$regNotas['NotaFinal'],0,"C",$bordeC);//Puntaje Trimestral
			//$pdf->Cell(6,4,"00",$bordeC,0,"R");
			$cont++;
		}
		
		
		$casillas=array_shift($casilleros->mostrarMateriaCursoSexoTrimestre($mat['CodMateria'],$CodCurso,$al['Sexo'],4));
		$regNotas=$registronotas->notasBoletin($CodAlumno,$casillas['CodCasilleros']);
		$regNotas=array_shift($regNotas);
		$sumanotas+=$regNotas['NotaFinal'];
		///Cuarto Bimestre
		if($PeriodoActual>=4){
			if($cur['NotaAprobacion']>$regNotas['NotaFinal']){
				$bordeN=0;
			}else{
				$bordeN=0;
			}
			/*$pdf->SetXY($boletin4x+127,$boletin4y+80+$i);
			$pdf->Cell(6,4,$regNotas['Resultado'],$bordeC,0,"R");//Nota
			//$pdf->Cell(6,4,"00",$bordeC,0,"R");
			$pdf->SetXY($boletin4x+138,$boletin4y+80+$i);
			if($casillas['Dps']==1)
			$pdf->Cell(6,4,$regNotas['Dps'],$bordeC,0,"R");//DPS
			//$pdf->Cell(6,4,"00",$bordeC,0,"R");*/
			$pdf->CuadroCuerpo(25,$regNotas['NotaFinal'],0,"C",$bordeC);//Puntaje Trimestral
			//$pdf->Cell(6,4,"00",$bordeC,0,"R");
			$cont++;
		}
		
		
		$casillas=array_shift($casilleros->mostrarMateriaCursoSexoTrimestre($mat['CodMateria'],$CodCurso,$al['Sexo'],5));
		$regNotas=array_shift($registronotas->notasBoletin($CodAlumno,$casillas['CodCasilleros']));
		$sumanotas+=$regNotas['NotaFinal'];
		$promediofinal=round($sumanotas/4);
		
		if($regNotas['Nota2']!=0){
			$promedioanual=round(($promediofinal+$regNotas['Nota2'])/2);	
		}else{
			$promedioanual=$promediofinal;	
		}
		if($cont==4){

			$pdf->CuadroCuerpo(25,$promediofinal,0,"C",$bordeC);//Promedio Anual
			
			//$pdf->SetXY(180,80+$i);
			//$pdf->Cell(6,4,$regNotas['Nota2'],$bordeC,0,"R");//Reforzamiento
			
			//$pdf->SetXY(198,80+$i);
			//$pdf->Cell(6,4,$promedioanual,$bordeC,0,"R");//Promedio Final
		}
		$i+=4;//Salto para abajo
        $pdf->ln();
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
	$pdf->CuadroCuerpo(150,$idioma["EstadisticaAgenda"],0);
    $pdf->ln();
	$pdf->CuadroCuerpo(30,$idioma["Observaciones"],1,"C",1,9,"B");
	$pdf->CuadroCuerpo(15,$idioma["Faltas"],1,"C",1,9,"B");
	$pdf->CuadroCuerpo(15,$idioma["Atrasos"],1,"C",1,9,"B");
	$pdf->CuadroCuerpo(20,$idioma["Licencias"],1,"C",1,9,"B");
	
	$pdf->CuadroCuerpo(35,$idioma["NotificacionPadres"],1,"C",1,8,"B");
	$pdf->SetFont("Arial","",8);
	$pdf->CuadroCuerpo(25,$idioma["NoRespondeTelf"],1,"C",1,8,"B");
	$pdf->SetFont("Arial","",11);
	$pdf->CuadroCuerpo(30,$idioma["Felicitaciones"],1,"C",1,9,"B");
	$pdf->CuadroCuerpo(15,$idioma["Total"],1,"C",1,9,"B");
	$pdf->Ln();
	$pdf->CuadroCuerpo(30,$CantObser['Cantidad'],0,"C",1,9,"");
	$pdf->CuadroCuerpo(15,$CantFaltas['Cantidad'],0,"C",1,9,"");
	$pdf->CuadroCuerpo(15,$CantAtrasos['Cantidad'],0,"C",1,9,"");
	$pdf->CuadroCuerpo(20,$CantLicencias['Cantidad'],0,"C",1,9,"");
	$pdf->CuadroCuerpo(35,$CantNotificacion['Cantidad'],0,"C",1,9,"");
	$pdf->CuadroCuerpo(25,$CantNoContestan['Cantidad'],0,"C",1,9,"");
	$pdf->CuadroCuerpo(30,$CantFelicitacion['Cantidad'],0,"C",1,9,"");
	$pdf->CuadroCuerpo(15,$Total,0,"C",1,9,"");;
	$pdf->Ln();
    if($Internet==1 || $Internet==0){
    $pdf->CuadroCuerpo(150,$idioma["RevisarConstantemente"],0,"L",0,9,"");
    }
	$pdf->Output("Boletín Bimestre","I");
}
?>