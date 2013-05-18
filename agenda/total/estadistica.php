<?php
if(!empty($_POST)){
	include_once("../../login/check.php");
	include_once("../../class/agenda.php");
	include_once("../../class/alumno.php");
	include_once("../../class/observaciones.php");
	$alumno=new alumno;
	$observaciones=new observaciones;
	$agenda=new agenda;
	$CodCurso=$_POST['CodCurso'];
	?><table class="tabla"><?php
	foreach($alumno->mostrarAlumnos($CodCurso) as $al){
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
		?>
			<tr height="29" class="contenido">
				<td class="amarillo">Obser:</td><td class="centrar pasivo"><?php echo $CantObser['Cantidad'];?></td>
	            <td class="amarillo">Faltas:</td><td class="centrar pasivo"><?php echo $CantFaltas['Cantidad'];?></td>
	            <td class="amarillo">Atra:</td><td class="centrar pasivo"><?php echo $CantAtrasos['Cantidad'];?></td>
	            <td class="amarillo">Lic.:</td><td class="centrar pasivo"><?php echo $CantLicencias['Cantidad'];?></td>
	        	<td class="amarillo"><span title="Notificación Padres">Noti. Pad:</span></td><td class="centrar pasivo"><?php echo $CantNotificacion['Cantidad'];?></td>
	            <td class="amarillo">No.Con</td><td class="centrar pasivo"><?php echo $CantNoContestan['Cantidad'];?></td>
	            <td class="amarillo">Fel.:</td><td class="centrar pasivo"><?php echo $CantFelicitacion['Cantidad'];?></td>
	            <td class="amarillo">Total:</td><td class="centrar pasivo"><?php echo $Total;?></td>
	        </tr>
		<?php
	}
	?></table><?php
}
?>