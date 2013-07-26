<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	include_once("../../class/config.php");
	$config=new config;
	foreach($_POST as $pk=>$pv){
		//echo $pk." - ".fecha2Str($pv,1)."<br>";
		if(ereg('Fecha|InicioTrimestre|FinTrimestre|InicioBimestre|FinBimestre',$pk)){
			$valor=array("Valor"=>"'".fecha2Str($pv,0)."'");
		}else{
			$valor=array("Valor"=>"'".($pv)."'");
		}
		$config->actualizarConfig($valor,$pk);
	}	
}
header("Location:index.php?m=1");
?>