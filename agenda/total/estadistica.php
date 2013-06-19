<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	include_once("../../class/agenda.php");
	include_once("../../class/alumno.php");
	include_once("../../class/curso.php");
	include_once("../../class/observaciones.php");
	$alumno=new alumno;
	$observaciones=new observaciones;
	$agenda=new agenda;
	$curso=new curso;
	$CodCurso=$_POST['CodCurso'];
	$cur=array_shift($curso->mostrarCurso($CodCurso));
	?>
    <a href="#" class="btn" id="reportegeneral"><?php echo $idioma['ReporteGeneral']?></a>
    <a href="#" class="btn btn-info" id="reporteimprimir"><?php echo $idioma['ReporteImprimir']?></a>
    <hr />
    <div id="respuesta1">
    <a href="#" class="btn btn-success btn-mini" id="exportarexcel"><?php echo $idioma['ExportarExcel']?></a>
    <table class="table table-hover table-bordered table-striped">
    <thead>
    <tr><th colspan="2"><?php echo $idioma['Curso']?>:</th><td colspan="10"><?php echo $cur['Nombre']?></td></tr>
    
	<tr>
    	<th>N</th>
    	<th><?php echo $idioma['Paterno']?></th>
        <th><?php echo $idioma['Materno']?></th>
        <th><?php echo $idioma['Nombres']?></th>
        <th><span title="<?php echo $idioma['Observaciones'];?>"><?php echo sacarIniciales($idioma['Observaciones'])?></span><span class="hidden-phone hidden-tablet hidden-desktop"> - <?php echo $idioma['Observaciones'];?></span></th>
        <th><span title="<?php echo $idioma['Faltas'];?>"><?php echo sacarIniciales($idioma['Faltas'])?></span><span class="hidden-phone hidden-tablet hidden-desktop"> - <?php echo $idioma['Faltas'];?></span></th>
        <th><span title="<?php echo $idioma['Atrasos'];?>"><?php echo sacarIniciales($idioma['Atrasos'])?></span><span class="hidden-phone hidden-tablet hidden-desktop"> - <?php echo $idioma['Atrasos'];?></span></th>
        <th><span title="<?php echo $idioma['Licencias'];?>"><?php echo sacarIniciales($idioma['Licencias'])?></span><span class="hidden-phone hidden-tablet hidden-desktop"> - <?php echo $idioma['Licencias'];?></span></th>
        <th><span title="<?php echo $idioma['NotificacionPadres'];?>"><?php echo sacarIniciales($idioma['NotificacionPadres'])?></span><span class="hidden-phone hidden-tablet hidden-desktop"> - <?php echo $idioma['NotificacionPadres'];?></span></th>
        <th><span title="<?php echo $idioma['NoRespondeTelf'];?>"><?php echo sacarIniciales($idioma['NoRespondeTelf'])?></span><span class="hidden-phone hidden-tablet hidden-desktop"> - <?php echo $idioma['NoRespondeTelf'];?></span></th>
        <th><span title="<?php echo $idioma['Felicitaciones'];?>"><?php echo sacarIniciales($idioma['Felicitaciones'])?></span><span class="hidden-phone hidden-tablet hidden-desktop"> - <?php echo $idioma['Felicitaciones'];?></span></th>
        <th><span title="<?php echo $idioma['Total'];?>"><?php echo sacarIniciales($idioma['Total'])?></span><span class="hidden-phone hidden-tablet hidden-desktop"> - <?php echo $idioma['Total'];?></span></th>
	</tr>
    </thead>
	<?php
	$i=0;
	foreach($alumno->mostrarAlumnosCurso($CodCurso) as $al){$i++;
		$CodAl=$al['CodAlumno'];
		//Cantidad de Observaciones
	$CodObser=$observaciones->CodObservaciones(1);
	foreach($CodObser as $CodO){$Obser[]=$CodO['CodObservacion'];}
	$CodigosObservaciones=implode(",",$Obser);
	$CantObser=$agenda->CantidadObservaciones($CodAl,$CodigosObservaciones);
	$CantObser=array_shift($CantObser);
		//Cantidad de Faltas
	$Obser=array();
	$CodObser=$observaciones->CodObservaciones(2);
	foreach($CodObser as $CodO){$Obser[]=$CodO['CodObservacion'];}
	$CodigosObservaciones=implode(",",$Obser);
	$CantFaltas=$agenda->CantidadObservaciones($CodAl,$CodigosObservaciones);
	$CantFaltas=array_shift($CantFaltas);
	//Cantidad de Atrasos
	$Obser=array();
	$CodObser=$observaciones->CodObservaciones(3);
	foreach($CodObser as $CodO){$Obser[]=$CodO['CodObservacion'];}
	$CodigosObservaciones=implode(",",$Obser);
	$CantAtrasos=$agenda->CantidadObservaciones($CodAl,$CodigosObservaciones);
	$CantAtrasos=array_shift($CantAtrasos);
	//Cantidad de Licencias
	$Obser=array();
	$CodObser=$observaciones->CodObservaciones(4);
	foreach($CodObser as $CodO){$Obser[]=$CodO['CodObservacion'];}
	$CodigosObservaciones=implode(",",$Obser);
	$CantLicencias=$agenda->CantidadObservaciones($CodAl,$CodigosObservaciones);
	$CantLicencias=array_shift($CantLicencias);
	//Cantidad de Felicitaciones
	$Obser=array();
	$CodObser=$observaciones->CodObservaciones(5);
	foreach($CodObser as $CodO){$Obser[]=$CodO['CodObservacion'];}
	$CodigosObservaciones=implode(",",$Obser);
	$CantNotificacion=$agenda->CantidadObservaciones($CodAl,$CodigosObservaciones);
	$CantNotificacion=array_shift($CantNotificacion);
	//Cantidad de No contestan
	$Obser=array();
	$CodObser=$observaciones->CodObservaciones(6);
	foreach($CodObser as $CodO){$Obser[]=$CodO['CodObservacion'];}
	$CodigosObservaciones=implode(",",$Obser);
	$CantNoContestan=$agenda->CantidadObservaciones($CodAl,$CodigosObservaciones);
	$CantNoContestan=array_shift($CantNoContestan);
	//Cantidad de Felicitaciones
	$Obser=array();
	$CodObser=$observaciones->CodObservaciones(7);
	foreach($CodObser as $CodO){$Obser[]=$CodO['CodObservacion'];}
	$CodigosObservaciones=implode(",",$Obser);
	$CantFelicitacion=$agenda->CantidadObservaciones($CodAl,$CodigosObservaciones);
	$CantFelicitacion=array_shift($CantFelicitacion);
	$Total=$CantObser['Cantidad']+$CantFaltas['Cantidad']+$CantAtrasos['Cantidad']+$CantLicencias['Cantidad']+$CantNotificacion['Cantidad']+$CantNoContestan['Cantidad']+$CantFelicitacion['Cantidad'];
	//Estadisticas Totales
	$tObser+=$CantObser['Cantidad'];
	$tFaltas+=$CantFaltas['Cantidad'];
	$tAtrasos+=$CantAtrasos['Cantidad'];
	$tLicencias+=$CantLicencias['Cantidad'];
	$tNotificacion+=$CantNotificacion['Cantidad'];
	$tNoContestan+=$CantNoContestan['Cantidad'];
	$tFelicitacion+=$CantFelicitacion['Cantidad'];
	$tTotal+=$Total;
	?>
		<tr>
			<td class="der"><?php echo $i;?></td>
			<td><?php echo capitalizar($al['Paterno'])?></td>
			<td><?php echo capitalizar($al['Materno'])?></td>
			<td><?php echo capitalizar($al['Nombres'])?></td>
			<td class="centrar"><?php echo $CantObser['Cantidad'];?></td>
			<td class="centrar"><?php echo $CantFaltas['Cantidad'];?></td>
			<td class="centrar"><?php echo $CantAtrasos['Cantidad'];?></td>
			<td class="centrar"><?php echo $CantLicencias['Cantidad'];?></td>
			<td class="centrar"><?php echo $CantNotificacion['Cantidad'];?></td>
			<td class="centrar"><?php echo $CantNoContestan['Cantidad'];?></td>
			<td class="centrar"><?php echo $CantFelicitacion['Cantidad'];?></td>
			<td class="centrar der"><?php echo $Total;?></td>
		</tr>
	<?php
	}
	?>
        <tr>
            <td class="resaltar der" colspan="4"><?php echo $idioma['Total']?>:</td>
            <td class="centrar"><?php echo $tObser;?></td>
            <td class="centrar"><?php echo $tFaltas;?></td>
            <td class="centrar"><?php echo $tAtrasos;?></td>
            <td class="centrar"><?php echo $tLicencias;?></td>
            <td class="centrar"><?php echo $tNotificacion;?></td>
            <td class="centrar"><?php echo $tNoContestan;?></td>
            <td class="centrar"><?php echo $tFelicitacion;?></td>
            <td class="centrar der"><?php echo $tTotal;?></td>
        </tr>
    </table>
	</div>
	<?php
}
?>