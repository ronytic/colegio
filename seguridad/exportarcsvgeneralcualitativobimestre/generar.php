<?php
include_once("../../login/check.php");
if(!empty($_GET)){
	extract($_GET);
	include_once("../../csv/csv.php");
	include_once("../../class/alumno.php");
	include_once("../../class/cursomateriaexportar.php");
	include_once("../../class/registronotas.php");
	include_once("../../class/casilleros.php");
	include_once("../../class/notascualitativabimestre.php");
	include_once("../../class/config.php");
	include_once("../../class/agenda.php");
	include_once("../../class/curso.php");
	include_once("../../class/materias.php");
	$config=new config;
	$agenda=new agenda;
	$curso=new curso;
	$materias=new materias;
	$notascualitativabimestre=new notascualitativabimestre;
	$cur=$curso->mostrarCurso($CodCurso);
	$cur=array_shift($cur);
	
	if(!is_array($Trimestre)){
	    //$Trimestre=(array)$Trimestre;
	    $Trimestre=explode(",",$Trimestre);
	}
	//print_r($Trimestre);
	if($cur['Bimestre']){
		$texto="Bimestre";	
	}else{
		$texto="Trimestre";	
	}
	$LimiteInicio1=$config->mostrarConfig("LimiteInicio1".$texto,1);
	$LimiteFin1=$config->mostrarConfig("LimiteFin1".$texto,1);
	$LimiteInicio2=$config->mostrarConfig("LimiteInicio2".$texto,1);
	$LimiteFin2=$config->mostrarConfig("LimiteFin2".$texto,1);
	$LimiteInicio3=$config->mostrarConfig("LimiteInicio3".$texto,1);
	$LimiteFin3=$config->mostrarConfig("LimiteFin3".$texto,1);
	$LimiteInicio4=$config->mostrarConfig("LimiteInicio4".$texto,1);
	$LimiteFin4=$config->mostrarConfig("LimiteFin4".$texto,1);
	$LimiteLetras=$config->mostrarConfig("LimiteLetras".$texto,1);
	
    $InicioBimestre1=$config->mostrarConfig("InicioBimestre1",1);
    $FinBimestre1=$config->mostrarConfig("FinBimestre1",1);
    $InicioBimestre2=$config->mostrarConfig("InicioBimestre2",1);
    $FinBimestre2=$config->mostrarConfig("FinBimestre2",1);
    $InicioBimestre3=$config->mostrarConfig("InicioBimestre3",1);
    $FinBimestre3=$config->mostrarConfig("FinBimestre3",1);
    $InicioBimestre4=$config->mostrarConfig("InicioBimestre4",1);
    $FinBimestre4=$config->mostrarConfig("FinBimestre4",1);
	
	$alumno=new alumno;
	$casilleros=new casilleros;
	$registronotas=new registronotas;
	$cursomateriaexportar=new cursomateriaexportar;
	
    $cursosExportar=$cursomateriaexportar->mostrarMaterias($CodCurso);
    
    $i=0;
    $anterior=0;
    $total=count($cursosExportar);
    $cantidad=array();
    foreach($cursosExportar as $v){$cont++;
        if($v['Combinada']==0){
            if($anterior!=0){
                array_push($cantidad,$i);
            }
                $i=1;
                array_push($cantidad,$i); 
                $i=0; 
                $anterior=$v['Combinada']; 
            
        }else{
            $i++;
            if($total==$cont){
                array_push($cantidad,$i);
            }
            $anterior=$v['Combinada'];
            continue;
        }
    }
    /*echo "<pre>";
    print_r($cantidad);
    echo "</pre>";*/
    $total=count($cantidad);
	$fila=array();
	if($Numeracion=="si"){
		if($Cabecera=="si")
		$fila[]="N";	
	}
	if($Cabecera=="si"){
		$fila[]=$idioma["Apellidos"]." ".$idioma["Nombres"];
    }
		//print_r($_GET);
		
	if($Cabecera=="si"){
	    $i=0;
		foreach($cantidad as $CurMatExp){$i++;
            //print_r($CurMatExp);
			if($SeparadorMateria!=""){
			    $fila[]=$SeparadorMateria;	
			}
			foreach($Trimestre as $Tri){
			    $fila[]="N".$Tri."_".$i;
			}
		}
		if(!empty($SeparadorCualitativo)){
			$fila[]=$SeparadorCualitativo;	
		}
		foreach($Trimestre as $Tri){
			$fila[]="Nota Cualitativa".$Tri;
		}
	}
	$datos=array();
	if($Cabecera=="si"){
		array_push($datos,$fila);
	}
    
	//print_r($_GET);
    $pos=0;
    
	$i=0;
    
	foreach($alumno->mostrarDatosAlumnos($CodCurso) as $al){$i++;
        
		$sw=0;
        $j=0;
        $pos=0;$actual=$cantidad[$pos];
		$fila=array();
		if($Numeracion=="si"){
			$fila[]=$i;	
		}
			
		$fila[]=ucwords($al['Paterno'])." ".ucwords($al['Materno'])." ".ucwords($al['Nombres']);
        $NotaSumada=0;
        $Totales["Cantidad_".$Tri]=0;
         $Totales[$Tri]=0;
		foreach($cursosExportar as $CurMatExp){$j++;
            //echo $j." - ".$pos." - ".$actual."<br>";
            //print_r($cantidad);
            if($SeparadorMateria!=""){
                $fila[]=$SeparadorMateria;	
            }
            foreach($Trimestre as $Tri){
                //print_r($CurMatExp);
                $cas=array_shift($casilleros->mostrarMateriaCursoSexoTrimestre($CurMatExp['CodMateria'],$CodCurso,$al['Sexo'],$Tri));
                /*print_r($cas);
                echo "<br>";*/
                $r=array_shift($registronotas->mostrarRegistroNotas($cas['CodCasilleros'],$al['CodAlumno'],$Tri));
                //print_r($r);
                $NotaSumada+=$r['NotaFinal'];
                //$Totales["Cantidad_".$Tri]++;
                
            }
            
            if($actual==$j){
                $NotaFinal=promedio($NotaSumada,$actual);
                $Totales[$Tri]+=$NotaFinal;
                $Totales["Cantidad_".$Tri]++;
                $fila[]=$NotaFinal;
                
                $NotaSumada=0;
               
                 $pos++;
                 $actual=$cantidad[$pos];
                 $j=0;
            }
        }
		if(!empty($SeparadorCualitativo)){
		    $fila[]=$SeparadorCualitativo;	
		}
		foreach($Trimestre as $Tri){

		    $notaPromedio=promedio($Totales[$Tri],$total);
			//$fila[]=$notaPromedio;
            //$fila[]=$Totales[$Tri];
			$ncuali=array_shift($notascualitativabimestre->mostrarNota($CodCurso,$Tri));
			$notacomprobar=$notaPromedio;
            if($notacomprobar>=$LimiteInicio1 && $notacomprobar<=$LimiteFin1){
                $fila[]=mayuscula($ncuali['PrimerRango']);
            }elseif($notacomprobar>=$LimiteInicio2 && $notacomprobar<=$LimiteFin2){
                $fila[]=mayuscula($ncuali['SegundoRango']);
            }elseif($notacomprobar>=$LimiteInicio3 && $notacomprobar<=$LimiteFin3){
                $fila[]=mayuscula($ncuali['TercerRango']);
            }elseif($notacomprobar>=$LimiteInicio4 && $notacomprobar<=$LimiteFin4){
                $fila[]=mayuscula($ncuali['CuartoRango']);
            }
		}
        array_push($datos,$fila);
    }
			

		
	if($Formato=="Tabla"){
		tabla($datos);
	}else{
	//var_dump($datos);
	archivocsv("reportecualitativo-$CodCurso.csv",$datos,$Separador,stripslashes( $SeparadorFila));
	}
}
function tabla($datos){
	echo "<table border=1>";
	foreach($datos as $d){
		echo "<tr>";
		foreach($d as $v){
			echo "<td>$v</td>";
		}
		echo "</tr>";
	}
	echo "<table>";
}
?>