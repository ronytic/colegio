<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	extract($_POST);
	include_once("../../class/observaciones.php");
	$observaciones=new observaciones;
	$valores=array("Nombre"=>"'$Nombre'",
				"NivelObservacion"=>"'$NivelObservacion'",
				"Docente"=>"'$Docente'",
				"Posicion"=>"'$Posicion'",
	);
	if($observaciones->actualizarRegistro($valores,"CodObservacion=$CodObservacion")){
		?><div class="alert alert-success"><?php echo $idioma['DatosGuardadosCorrectamente']?></div>
        <?php	
	}else{
		?><div class="alert alert-error"><?php echo $idioma['DatosGuardadosError']?></div>
        <?php
	}
}
?>

<script language="javascript">mostrar();</script>