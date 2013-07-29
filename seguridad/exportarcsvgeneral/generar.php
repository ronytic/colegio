<?php
include_once("../../login/check.php");
if(!empty($_GET)){
	extract($_GET);
	include_once("../../csv/csv.php");
	include_once("../../class/alumno.php");
	include_once("../../class/cursomateriaexportar.php");
	include_once("../../class/registronotas.php");
	include_once("../../class/casilleros.php");
	
	include_once("../../class/config.php");
	include_once("../../class/agenda.php");
	$conf=new config;
	$agenda=new agenda;
	
	$cnf=array_shift($conf->mostrarConfig("InicioTrimestre1"));
	$InicioTrimestre1=$cnf['Valor'];
	$cnf=array_shift($conf->mostrarConfig("FinTrimestre1"));
	$FinTrimestre1=$cnf['Valor'];
	$cnf=array_shift($conf->mostrarConfig("InicioTrimestre2"));
	$InicioTrimestre2=$cnf['Valor'];
	$cnf=array_shift($conf->mostrarConfig("FinTrimestre2"));
	$FinTrimestre2=$cnf['Valor'];
	$cnf=array_shift($conf->mostrarConfig("InicioTrimestre3"));
	$InicioTrimestre3=$cnf['Valor'];
	$cnf=array_shift($conf->mostrarConfig("FinTrimestre3"));
	$FinTrimestre3=$cnf['Valor'];
	
	$alumno=new alumno;
	$casilleros=new casilleros;
	$registronotas=new registronotas;
	$cursomateriaexportar=new cursomateriaexportar;
	
	$fila=array();
	if($Numeracion=="si"){
		if($Cabecera=="si")
		$fila[]="N";	
	}
	if($Cabecera=="si")
		$fila[]="Apellidos y Nombres";
	
	if($Trimestre=="todo"){
		
		if($Cabecera=="si"){
			foreach($cursomateriaexportar->mostrarMaterias($CodCurso) as $CurMatExp){
			if($SeparadorMateria!=""){
				$fila[]=$SeparadorMateria;	
			}
			$fila[]="N1";
			$fila[]="Dps1";
			$fila[]="N2";
			$fila[]="Dps2";
			$fila[]="N3";
			$fila[]="Dps3";
			$fila[]="Ref";
			}
			if($SeparadorEstadisticas!=""){
				$fila[]=$SeparadorEstadisticas;	
			}
			$fila[]="Dias Trab-1";
			$fila[]="Falta C/Lic-1";
			$fila[]="Falta S/Lic-1";
			$fila[]="Atrasos-1";
			$fila[]="Dias Trab-2";
			$fila[]="Falta C/Lic-2";
			$fila[]="Falta S/Lic-2";
			$fila[]="Atrasos-2";
			$fila[]="Dias Trab-3";
			$fila[]="Falta C/Lic-3";
			$fila[]="Falta S/Lic-3";
			$fila[]="Atrasos-3";
			
		}
	}else{
		$cas=array_shift($casilleros->mostrarMateriaCursoTrimestre($Materias,$CodCurso,$Trimestre));
		if($Cabecera=="si"){
			$fila[]="N".$Trimestre;
			$fila[]="Dps".$Trimestre;
			/*$fila[]="Dias Trabajados";
			$fila[]="Falta C/Lic";
			$fila[]="Falta S/Lic";
			$fila[]="Atrasos";*/
		}
	}
	$datos=array();
	if($Cabecera=="si"){
		array_push($datos,$fila);
	}
	//print_r($_GET);
	$i=0;
		foreach($alumno->mostrarDatosAlumnos($CodCurso) as $al){$i++;
		$sw=0;
		$fila=array();
			if($Numeracion=="si"){
				$fila[]=$i;	
			}
			
			$fila[]=ucwords($al['Paterno'])." ".ucwords($al['Materno'])." ".ucwords($al['Nombres']);
			if($Trimestre=="todo"){
				/**/
				$faltasConLic1=array_shift($agenda->mostrarCodCursoCodObservacionCodAlumnoRango($CodCurso,14,$al['CodAlumno'],$InicioTrimestre1,$FinTrimestre1));
				$faltasSinLic1=array_shift($agenda->mostrarCodCursoCodObservacionCodAlumnoRango($CodCurso,12,$al['CodAlumno'],$InicioTrimestre1,$FinTrimestre1));
				$Atrasos1=array_shift($agenda->mostrarCodCursoCodObservacionCodAlumnoRango($CodCurso,11,$al['CodAlumno'],$InicioTrimestre1,$FinTrimestre1));
				
				$faltasConLic2=array_shift($agenda->mostrarCodCursoCodObservacionCodAlumnoRango($CodCurso,14,$al['CodAlumno'],$InicioTrimestre2,$FinTrimestre2));
				$faltasSinLic2=array_shift($agenda->mostrarCodCursoCodObservacionCodAlumnoRango($CodCurso,12,$al['CodAlumno'],$InicioTrimestre2,$FinTrimestre2));
				$Atrasos2=array_shift($agenda->mostrarCodCursoCodObservacionCodAlumnoRango($CodCurso,11,$al['CodAlumno'],$InicioTrimestre2,$FinTrimestre2));
				
				$faltasConLic3=array_shift($agenda->mostrarCodCursoCodObservacionCodAlumnoRango($CodCurso,14,$al['CodAlumno'],$InicioTrimestre3,$FinTrimestre3));
				$faltasSinLic3=array_shift($agenda->mostrarCodCursoCodObservacionCodAlumnoRango($CodCurso,12,$al['CodAlumno'],$InicioTrimestre3,$FinTrimestre3));
				$Atrasos3=array_shift($agenda->mostrarCodCursoCodObservacionCodAlumnoRango($CodCurso,11,$al['CodAlumno'],$InicioTrimestre3,$FinTrimestre3));
				
				/**/
				foreach($cursomateriaexportar->mostrarMaterias($CodCurso) as $CurMatExp){
					if($SeparadorMateria!=""){
						$fila[]=$SeparadorMateria;	
					}
					if($CurMatExp['CodMateria']==200){
						for($na=1;$na<=3;$na++){
							$cas1=array_shift($casilleros->mostrarMateriaCursoTrimestre(17,$CodCurso,$na));
							$cas2=array_shift($casilleros->mostrarMateriaCursoTrimestre(18,$CodCurso,$na));
							$cas3=array_shift($casilleros->mostrarMateriaCursoTrimestre(19,$CodCurso,$na));
							
							/*$casref1=array_shift($casilleros->mostrarMateriaCursoTrimestre($CurMatExp['CodMateria'],$CodCurso,4));
							$casref1=array_shift($casilleros->mostrarMateriaCursoTrimestre($CurMatExp['CodMateria'],$CodCurso,4));
							$casref1=array_shift($casilleros->mostrarMateriaCursoTrimestre($CurMatExp['CodMateria'],$CodCurso,4));
							*/
							$mr1=array_shift($registronotas->mostrarRegistroNotas($cas1['CodCasilleros'],$al['CodAlumno'],$na));
							$mr2=array_shift($registronotas->mostrarRegistroNotas($cas2['CodCasilleros'],$al['CodAlumno'],$na));
							$mr3=array_shift($registronotas->mostrarRegistroNotas($cas3['CodCasilleros'],$al['CodAlumno'],$na));
							
							//$r4=array_shift($registronotas->mostrarRegistroNotas($cas4['CodCasilleros'],$al['CodAlumno'],$na));	
							
							$promedioresul=number_format(($mr1['Resultado']+$mr2['Resultado']+$mr3['Resultado'])/3,0);
							$dpsresul=number_format(($mr1['Dps']+$mr2['Dps']+$mr3['Dps'])/3,0);
							$fila[]=$promedioresul;
							$fila[]=$dpsresul;
						}
						
						//$fila[]=$r2['Resultado'];
						//$fila[]=$r2['Dps'];
						//$fila[]=$r3['Resultado'];
						//$fila[]=$r3['Dps'];
						//$fila[]=$r4['Nota2'];
						$fila[]=0;
						
					}else{
						$cas1=array_shift($casilleros->mostrarMateriaCursoSexoTrimestre($CurMatExp['CodMateria'],$CodCurso,$al['Sexo'],1));
						$cas2=array_shift($casilleros->mostrarMateriaCursoSexoTrimestre($CurMatExp['CodMateria'],$CodCurso,$al['Sexo'],2));
						$cas3=array_shift($casilleros->mostrarMateriaCursoSexoTrimestre($CurMatExp['CodMateria'],$CodCurso,$al['Sexo'],3));
						$cas4=array_shift($casilleros->mostrarMateriaCursoSexoTrimestre($CurMatExp['CodMateria'],$CodCurso,$al['Sexo'],4));
						$r1=array_shift($registronotas->mostrarRegistroNotas($cas1['CodCasilleros'],$al['CodAlumno'],1));
						$r2=array_shift($registronotas->mostrarRegistroNotas($cas2['CodCasilleros'],$al['CodAlumno'],2));
						$r3=array_shift($registronotas->mostrarRegistroNotas($cas3['CodCasilleros'],$al['CodAlumno'],3));
						$r4=array_shift($registronotas->mostrarRegistroNotas($cas4['CodCasilleros'],$al['CodAlumno'],4));
						//$promedioAnual=number_format(($r1['NotaFinal']+$r2['NotaFinal']+$r3['NotaFinal'])/3,0);
						$fila[]=$r1['Resultado'];
						$fila[]=$r1['Dps'];
						$fila[]=$r2['Resultado'];
						$fila[]=$r2['Dps'];
						$fila[]=$r3['Resultado'];
						$fila[]=$r3['Dps'];
						$fila[]=$r4['Nota2'];
						
						

						if($r4['Nota2']!=0){
							$sw=1;	
						}
					}
				}		
				if($SeparadorEstadisticas!=""){
					$fila[]=$SeparadorEstadisticas;	
				}
				$total1=68-$faltasConLic1['Cantidad']-$faltasSinLic1['Cantidad'];
				$fila[]=$total1;
				$fila[]=$faltasConLic1['Cantidad'];
				$fila[]=$faltasSinLic1['Cantidad'];
				$fila[]=$Atrasos1['Cantidad'];
				
				$total2=64-$faltasConLic2['Cantidad']-$faltasSinLic2['Cantidad'];
				$fila[]=$total2;
				$fila[]=$faltasConLic2['Cantidad'];
				$fila[]=$faltasSinLic2['Cantidad'];
				$fila[]=$Atrasos2['Cantidad'];
				
				$total3=68-$faltasConLic3['Cantidad']-$faltasSinLic3['Cantidad'];
				$fila[]=$total3;
				$fila[]=$faltasConLic3['Cantidad'];
				$fila[]=$faltasSinLic3['Cantidad'];
				$fila[]=$Atrasos3['Cantidad'];
			}else{
				$r=array_shift($registronotas->mostrarRegistroNotas($cas['CodCasilleros'],$al['CodAlumno'],$Trimestre));
				$fila[]=$r['NotaFinal'];
				$fila[]=$r['Dps'];
			}
			if($sw==1){
				$fila[]=6;	
			}else{
				$fila[]=0;	
			}
			array_push($datos,$fila);
		}
	
	
	archivocsv("reporte-$CodCurso.csv",$datos,$Separador,stripslashes( $SeparadorFila));
}
?>