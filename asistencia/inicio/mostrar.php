<?php
include_once("../../login/check.php");
if(isset($_POST)){
include_once("../../class/asistencia.php");
include_once("../../class/alumno.php");
include_once("../../class/agenda.php");
include_once("../../class/config.php");
$asistencia=new asistencia;
$alumno=new alumno;
$config=new config;
$agenda=new agenda;
if($_POST['Fecha']!=""){
	$Fecha=fecha2Str($_POST['Fecha'],0);
}else{
	$Fecha=date("Y-m-d");
}
$FechaActual=$Fecha;
$al=$alumno->contarInscritosTotal();
$al=array_shift($al);
$CantidadTotal=$al['CantidadTotal'];

$TipoEstadisticaAsistenciaInicio=$config->mostrarConfig("TipoEstadisticaAsistenciaInicio",1);
if($TipoEstadisticaAsistenciaInicio=="Agenda"){
	$ag=$agenda->CantidadObservaciones("","6","",$Fecha);
	$ag=array_shift($ag);
	$Faltas=$ag['Cantidad'];
	$ag=$agenda->CantidadObservaciones("","8","",$Fecha);
	$ag=array_shift($ag);
	$Atrasos=$ag['Cantidad'];
	$asistenciaAtraso=$Atrasos;
	$asistenciaFaltas=$Faltas;
	$asistenciaAsistencia=$CantidadTotal-$asistenciaFaltas-$asistenciaAtraso;
	$porcentajeAsistentes=porcentaje($asistenciaAsistencia,$CantidadTotal);
	$porcentajeAtrasos=porcentaje($asistenciaAtraso,$CantidadTotal);
	$porcentajeFaltas=100-$porcentajeAtrasos-$porcentajeAsistentes;
}else{
	$asis=$asistencia->mostrarFechaAtraso($FechaActual);
	$asis=array_shift($asis);
	$asistenciaAtraso=$asis['Cantidad'];
	$asis=$asistencia->mostrarFechaAsistencia($FechaActual);
	$asis=array_shift($asis);
	$asistenciaAsistencia=$asis['Cantidad'];
	$asistenciaFaltas=$CantidadTotal-$asistenciaAtraso-$asistenciaAsistencia;
	$porcentajeAsistentes=porcentaje($asistenciaAsistencia,$CantidadTotal);
	$porcentajeAtrasos=porcentaje($asistenciaAtraso,$CantidadTotal);
	//$porcentajeFaltas=porcentaje($asistenciaFaltas,$CantidadTotal);
	$porcentajeFaltas=100-$porcentajeAtrasos-$porcentajeAsistentes;
}
?>
<div class="box-small span3">
    <a data-rel="tooltip" title="<?php echo $porcentajeAsistentes?>% <?php echo $idioma['DeAsistentes']?>" class="box-small-link" href="#">
        <div id="visits-count"><?php echo $asistenciaAsistencia?><br><br><?php echo $idioma['Alumnos']?></div>
    </a>
    <div class="box-small-title"><?php echo $idioma['AsistenciaTiempo']?></div>
    <span id="visits-count-n"class="notification green"><?php echo $porcentajeAsistentes?>%</span>
</div>
<div class="box-small span3">
    <a data-rel="tooltip" title="<?php echo $porcentajeAtrasos?>% <?php echo $idioma['DeAtrasos']?>" class="box-small-link" href="#">
        <div id="members-count"><?php echo $asistenciaAtraso?><br><br><?php echo $idioma['Alumnos']?></div>
    </a>
    <div class="box-small-title"><?php echo $idioma['Atrasos']?></div>
    <span id="members-count-n" class="notification yellow"><?php echo $porcentajeAtrasos?>%</span>
</div>
<div class="box-small span3">
    <a data-rel="tooltip" title="<?php echo $porcentajeFaltas?>% <?php echo $idioma['DeFaltas']?>" class="box-small-link" href="#">
        <div id="members-count"><?php echo $asistenciaFaltas?><br><br><?php echo $idioma['Alumnos']?></div>
    </a>
    <div class="box-small-title"><?php echo $idioma['Faltas']?></div>
    <span id="members-count-n" class="notification red"><?php echo $porcentajeFaltas?>%</span>
</div>

<?php }?>