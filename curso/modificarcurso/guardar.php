<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	extract($_POST);
	include_once("../../class/curso.php");
	$curso=new curso;
	$valores=array("Nombre"=>"'$Nombre'",
				"Abreviado"=>"'$Abreviado'",
				"CodCursoArea"=>"'$CodCursoArea'",
				"Paralelo"=>"'$Paralelo'",
				"Dps"=>"'$Dps'",
				"Orden"=>"'$Orden'",
				"Bimestre"=>"'$Bimestre'",
				"NotaTope"=>"'$NotaTope'",
				"NotaAprobacion"=>"'$NotaAprobacion'",
				"MontoCuota"=>"'$MontoCuota'",
				"CantidadEtapas"=>"'$CantidadEtapas'"
	);
	if($curso->insertarRegistro($valores)){
		?><div class="alert alert-success"><?php echo $idioma['DatosGuardadosCorrectamente']?></div>
        <?php	
	}else{
		?><div class="alert alert-error"><?php echo $idioma['DatosGuardadosError']?></div>
        <?php
	}
}
?>

<script language="javascript">mostrar();</script>