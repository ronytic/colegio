<?php
include_once("../../login/check.php");
include_once("../../class/registronotas.php");
include_once("../../class/casilleros.php");
include_once("../../class/curso.php");
include_once("../../class/alumno.php");
include_once("../fn.php");

if(!empty($_POST)){
	$regNota=new registronotas;
	$casilleros=new casilleros;
	$curso=new curso;
	$fn=new funciones;
	$alumno=new alumno;
	$CodCasilleros=$_POST['CodCasilleros'];
	$casillas=array_shift($casilleros->mostrar($CodCasilleros));
	$CodAlumno=$_POST['CodAlumno'];
	$NumeroNota=$_POST['NumeroNota'];
	$Nota=$_POST['Nota'];
	$TipoNota=$_POST['TipoNota'];
	//$al=array_shift($alumno->mostrarDatos($CodAlumno));
	//$cur=array_shift($curso->mostrarCurso($al['CodCurso']));
	
	$trimestre=$casillas['Trimestre'];
	$Nota=trim($Nota);
	$Nota=(int)$Nota;
	$Fecha=date("Y-m-d");
	$Hora=date("H:i:s");
	if(!ereg("[0-9]{1,3}",$Nota)){$Nota=0;}
	$Values=array("Nota".$NumeroNota=>$Nota,"FechaRegistro"=>"'$Fecha'","HoraRegistro"=>"'$Hora'");
	$Where="CodCasilleros=$CodCasilleros and CodAlumno=$CodAlumno and Trimestre=$trimestre";
	$regNota->actualizarNota($Values,$Where);
	//hasta aqui actualizamos nota
	//sacamos todos los campos
	$regNotaAlumno=$regNota->mostrarRegistroNotas($CodCasilleros,$CodAlumno,$trimestre);
	$regNotaAlumno=array_shift($regNotaAlumno);
	//asignamos valores a los casilleros
	for($i=1;$i<=$casillas['Casilleros'];$i++){
		$valuesNotas['casilla'.$i]=$regNotaAlumno['Nota'.$i];
	}
	
	//print_r($docMateria);
	//obtenemos formulafinalpromedio
	//echo $docMateria['FormulaCalificaciones'];
	//print_r($_POST);
	if($TipoNota=="avanzado"){
		//print_r($valuesNotas);
		$PD1=round((($valuesNotas['casilla1']+$valuesNotas['casilla2']+$valuesNotas['casilla3']+$valuesNotas['casilla4']+$valuesNotas['casilla5'])/5)*0.2);
			$P1=(($valuesNotas['casilla7']+$valuesNotas['casilla8'])/2);
			$P2=(($valuesNotas['casilla10']+$valuesNotas['casilla11'])/2);
		$PD2=round((($P1+$P2)/2)*0.3);
		$PD3=round((($valuesNotas['casilla14']+$valuesNotas['casilla15'])/2)*0.3);
		$PD4=round((($valuesNotas['casilla17']+$valuesNotas['casilla18'])/2)*0.2);
		$PB=$PD1+$PD2+$PD3+$PD4;
		//echo $PD1;
		$notaResultado=$PB;
	}else{
		$notaResultado=$fn->polaco($casillas['FormulaCalificaciones'],$valuesNotas);
	}
	if($notaResultado<=22){
		if($casillas['Dps']==1){
			$notaResultado=22;// Sacamos nota Minima para cada Uno	
		}else{
			$notaResultado=27;// Sacamos nota Minima para cada Uno	sui no tiene dps
		}
	}
	if($casillas['Dps']==1){///Condicion para la nota de 35
		if($notaResultado==30){
			$notaResultado=31;	
		}	
	}else{
		if($notaResultado==35){
			$notaResultado=36;	
		}
		
	}
	if($TipoNota=="avanzado"){
		$notafinal=$notaResultado;
		$valuesNotaDps=array("Nota6"=>$PD1,"Nota9"=>$P1,"Nota12"=>$P2,"Nota13"=>$PD2,"Nota16"=>$PD3,"Nota19"=>$PD4,"Resultado"=>$notaResultado,'Dps'=>"0",'NotaFinal'=>$notafinal);
		$regNota->actualizarNota($valuesNotaDps,$Where);
		$resultado=array("TipoNota"=>$TipoNota,"PD1"=>$PD1,"P1"=>$P1,"P2"=>$P2,"PD2"=>$PD2,"PD3"=>$PD3,"PD4"=>$PD4,"CodAlumno"=>$CodAlumno,"Resultado"=>$notaResultado,'Dps'=>"0","NotaFinal"=>$notafinal);	
	}else{
		//echo $docMateria['FormulaCalificaciones'];
		//imprimimos resultados
		if($casillas['Dps']==1){
			$dps=$fn->dpsnota($notaResultado);
			$notafinal=$notaResultado+$dps;
			$valuesNotaDps=array("Resultado"=>$notaResultado,'Dps'=>$dps,'NotaFinal'=>$notafinal);
			$regNota->actualizarNota($valuesNotaDps,$Where);
			$resultado=array("CodAlumno"=>$CodAlumno,"Resultado"=>$notaResultado,'Dps'=>$dps,"NotaFinal"=>$notafinal);
		}else{
			$dps=0;
			$notafinal=$notaResultado;
			$valuesNotaDps=array("Resultado"=>$notaResultado,'Dps'=>$dps,'NotaFinal'=>$notafinal);
			$regNota->actualizarNota($valuesNotaDps,$Where);
			$resultado=array("CodAlumno"=>$CodAlumno,"Resultado"=>$notaResultado,'Dps'=>$dps,"NotaFinal"=>$notafinal);	
		}
	}
	echo json_encode($resultado);
}
?>