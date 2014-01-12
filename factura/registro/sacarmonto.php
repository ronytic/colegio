<?php
include_once("../../login/check.php");
if(!empty($_POST['CodAlumno'])){
	//include_once("../../class/alumno.php");
	//include_once("../../class/curso.php");
	include_once("../../class/cuota.php");
	//$alumno=new alumno;
	//$curso=new curso;
	$cuota=new cuota;
	$CodAlumno=$_POST['CodAlumno'];
	$NumeroCuota=$_POST['NumeroCuota'];
	//$al=$alumno->mostrarTodoDatos($CodAlumno);
	if($NumeroCuota=="null"){
		$cuo['CodCuota']=0;
		$cuo['MontoPagar']=0;
		$cuo['Numero']=0;
	}else{
		if($NumeroCuota=="Todo"){
			$cuo=$cuota->mostrarCuotasNoCanceladas($CodAlumno);
			$Monto=0;
			foreach($cuo as $c){
				$Monto+=$c['MontoPagar'];
			}
			$cuo['CodCuota']="Todo";
			$cuo['MontoPagar']="$Monto";
			
			//$cuo=array_shift($cuo);		
			
		}else{
		$cuo=$cuota->mostrarCuota($CodAlumno,$NumeroCuota);
		//print_r($cuota);
		$cuo=array_shift($cuo);
		}
	}
	$valores=array("CodCuota"=>$cuo['CodCuota'],
					"MontoPagar"=>$cuo['MontoPagar'],
					"Cuota"=>$cuo['Numero'],
					//"MontoCuota"=>$al['FacturaA']
					);
	
	echo json_encode($valores);
}
?>