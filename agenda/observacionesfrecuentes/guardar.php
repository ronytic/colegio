<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	extract($_POST);
	include_once("../../class/observacionesfrecuentes.php");
	$observacionesfrecuentes=new observacionesfrecuentes;
	$valores=array("Nombre"=>"'$Nombre'",
				"Valor"=>"'$Valor'",
	);
	if($observacionesfrecuentes->insertarRegistro($valores)){
		?><div class="alert alert-success"><?php echo $idioma['DatosGuardadosCorrectamente']?></div>
        <?php	
	}else{
		?><div class="alert alert-error"><?php echo $idioma['DatosGuardadosError']?></div>
        <?php
	}
}
?>

<script language="javascript">mostrar();</script>