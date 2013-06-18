<?php
include_once("../../login/check.php");
if(isset($_POST)){
	$Periodo=$_POST['Periodo'];
	include_once("../../class/casilleros.php");
	include_once("../../class/notascualitativa.php");
	$casilleros=new casilleros;
	$notascualitativa=new notascualitativa;
	$cas=$casilleros->mostrarTodo("Trimestre=$Periodo");
	if(count($cas)){
		echo count($cas);
		$notas=$notascualitativa->mostrarTodoRegistro("Trimestre=$Periodo");	
		if(count($notas)){
			?><div class="alert alert-error"><strong><?php echo $idioma["NotasCualitativasYaGeneradasParaPeriodo"];?></strong><hr />
            <strong><?php echo $idioma["DeseaVolverAGenerar"];?> <?php echo $Periodo?> <?php echo $idioma['Periodo']?></strong></div>
			<?php 
		}else{
			
		}
	}else{
		?><strong><?php echo $idioma["NoTieneAsignadoCasillerosParaPeriodo"];?></strong><hr />
		<div class="alert">sasd</div>
		<?php
	}
}
?>