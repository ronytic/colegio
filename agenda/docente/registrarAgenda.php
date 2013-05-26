<?php
include_once("../../login/check.php");
include_once("../../class/agenda.php");
if(isset($_POST)){
	$agenda=new agenda;
	$fecha=date("Y-m-d");
	$hora=date("H:i:s");
	$FechaObs=fecha2Str($_POST['Fecha'],0);
	$CodUsuario=$_SESSION['CodUsuarioLog'];
	$Nivel=$_SESSION['Nivel'];
	$agendaValues=array(
				'CodCurso'=>$_POST['CodCurso'],
				'CodAlumno'=>$_POST['CodAlumno'],
				'CodMateria'=>$_POST['CodMateria'],
				'CodObservacion'=>$_POST['CodObservacion'],
				'Fecha'=>"'$FechaObs'",
				'FechaRegistro'=>"'$fecha'",
				'HoraRegistro'=>"'$hora'",
				'Activo'=>1,
				'Detalle'=>"'{$_POST['Detalle']}'",
				'CodUsuario'=>$CodUsuario,
				'Nivel'=>$Nivel,
				'Resaltar'=>$_POST['Citacion'],
		);
		//print_r($agendaValues);
		$res=$agenda->insertarRegistro($agendaValues);
	//print_r( $agendaValues);
		if($res){
		?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $idioma['DatosGuardadosCorrectamente']?>
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