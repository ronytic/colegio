<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	include_once("../../class/alumno.php");
	$alumno=new alumno;
	$CodAlumno=$_POST['CodAlumno'];
	$CodBarra=$_POST['CodBarra'];
	$Values=array("CodBarra"=>"'$CodBarra'");
	if($alumno->actualizarDatosAlumno($Values,$CodAlumno)){
		$al=$alumno->mostrarDatosPersonales($CodAlumno);
		$al=array_shift($al);
		?>
        <div class="alert alert-success">
			<h2 class="centrar"><?php echo $idioma['CodigoBarraActualizado'];?></h2>
            <table class="table table-bordered table-hover">
            	<thead>
                	<tr><th><?php echo $idioma['DatosAlumno']?></th></tr>
                </thead>
            	<tr><td class="x2"><?php echo capitalizar($al['Paterno']." ".$al['Materno']." ".$al['Nombres'])?></td></tr>
                <tr><td class="x2"><?php echo $idioma['CodigoBarra']?>: <?php echo $CodBarra?></td></tr>
            </table>
        </div>
        <?php
	}else{
		?>
        <div class="alert alert-error">
        	<?php echo $idioma['DatosGuardadosError'];?>
        </div>
        <?php	
	}
}
?>
