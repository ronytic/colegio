<?php
include_once("../../login/check.php");
if(isset($_POST)){
	$Periodo=$_POST['Periodo'];
	include_once("../../class/curso.php");
	include_once("../../class/notascualitativabimestre.php");
	$curso=new curso;
	$notascualitativabimestre=new notascualitativabimestre;
	$curs=$curso->mostrar();
	if(count($curs)){
		$notascualitativabimestre->eliminarNotaDefinitivo("Periodo=$Periodo");
		foreach($curs as $cur){
				$valores=array(
							"CodCurso"=>$cur['CodCurso'],
							"Periodo"=>$Periodo
							);
				$notascualitativabimestre->insertarRegistro($valores);
			}
		?>
        <div class="alert alert-success">
        	<strong><?php echo $idioma['CasillerosNotasCualitativas']?> <?php echo $idioma['GeneradosCorrectamente']?></strong>
        </div>
        <?php
	}else{
		?><div class="alert"><strong><?php echo $idioma["NoTieneAsignadoCasillerosParaPeriodo"];?></strong>
        </div>
        <div class="alert alert-info">
        <strong><?php echo $idioma["AsigneCasillerosLuegoGenereNotasCualitativas"];?></strong>
		</div>
		<?php
	}
}
?>