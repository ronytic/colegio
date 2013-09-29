<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	extract($_POST);
	include_once("../../class/materias.php");
	$materias=new materias;
	$valores=array("Nombre"=>"'$Nombre'",
				"Abreviado"=>"'$Abreviado'",
				"NombreAlterno1"=>"'$NombreAlterno1'",
				"NombreAlterno2"=>"'$NombreAlterno2'",
				"PromedioCiencias"=>"'$PromedioCiencias'",
				"Valido"=>"'$Valido'",
				"Posicion"=>"'$Posicion'",
	);
	if($materias->actualizarRegistro($valores,"CodMateria=$CodMateria")){
		?><div class="alert alert-success"><?php echo $idioma['DatosGuardadosCorrectamente']?></div>
        <?php	
	}else{
		?><div class="alert alert-error"><?php echo $idioma['DatosGuardadosError']?></div>
        <?php
	}
}
?>

<script language="javascript">mostrar();</script>