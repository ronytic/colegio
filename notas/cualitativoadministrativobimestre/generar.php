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
		//echo count($casillas);
		$notas=$notascualitativabimestre->mostrarTodoRegistro("Periodo=$Periodo");	
		if(count($notas)){
			?><div class="alert alert-error"><strong><?php echo $idioma["NotasCualitativasYaGeneradasParaPeriodo"];?></strong><hr />
            <strong><?php echo $idioma["DeseaVolverAGenerar"];?> <?php echo $Periodo?> <?php echo $idioma['Periodo']?></strong></div>
            <button class="btn btn-danger" id="generarreemplazar" rel="<?php echo $Periodo?>"><?php echo $idioma['ComprendoYDeseoGenerar']?></button>
			<?php 
		}else{
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
		}
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