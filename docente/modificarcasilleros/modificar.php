<?php
include_once("../../login/check.php");
if(isset($_POST)){
	include_once("../../class/casilleros.php");
	$casilleros=new casilleros;
	$CodCasilleros=$_POST['CodCasilleros'];
	$i=0;
	$valoresN['Casilleros']=$_POST['casillas'];
	$valoresN['FormulaCalificaciones']="'".$_POST['formula']."'";
	foreach($_POST['nombre'] as $n){$i++;
		$l=array_shift($_POST['limite']);
		$lm=array_shift($_POST['limitemin']);
		
		$valoresN["NombreCasilla".$i]="'".$n."'";
		$valoresN["LimiteCasilla".$i]=$l;
		$valoresN["LimiteMinCasilla".$i]=$lm;
	}
	if($casilleros->actualizarCasilleros($valoresN,$CodCasilleros)){
	?>
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<?php echo $idioma['DatosGuardadosCorrectamente']?>
        <a href="" id="actualizarventana" class="btn"><?php echo $idioma['ActualizarVentana']?></a>	
	</div>
	<?php
	}else{
	?>
	<div class="alert alert-error">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<?php echo $idioma['DatosGuardadosError']?>
	</div>
	<?php	
	}
}
?>