<?php
include_once("../../login/check.php");
include_once("../../class/agenda.php");
include_once("../../class/materias.php");
include_once("../../class/config.php");
include_once("../../class/observaciones.php");
if(isset($_POST)){
	$CodAl=$_SESSION['CodAl'];
	$agenda=new agenda;
	$materia=new materias;
	$observaciones=new observaciones;
	$config=new config;
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
    <table class="table table-condensed">
    	<tr class="cabecera">
    		<td>Observaciones</td><td>Faltas</td><td>Atrasos</td><td>Licencias</td><!--<td><span title="Notificación a los Padres">Not.Padres</span></td><td><span title="No Contestan llamada">No Cont cel</span></td><td>Felicitaciones</td><td><span title="total">Tot</span></td>-->
    	</tr>
    	<tr class="contenido">
        	<td class="centrar"><?php echo $CantObser['Cantidad'];?></td>
            <td class="centrar"><?php echo $CantFaltas['Cantidad'];?></td>
            <td class="centrar"><?php echo $CantAtrasos['Cantidad'];?></td>
            <td class="centrar"><?php echo $CantLicencias['Cantidad'];?></td>
        	<td class="centrar"><?php echo $CantNotificacion['Cantidad'];?></td>
            <td class="centrar"><?php echo $CantNoContestan['Cantidad'];?></td>
            <td class="centrar"><?php echo $CantFelicitacion['Cantidad'];?></td>
            <td class="centrar"><?php echo $Total;?></td>
        </tr>
    </table>
    <table class="table">
    	<tr class="cabecera"><td width="20">Materia</td><td width="110">Observación</td><td>Detalle</td><td>Fecha</td><td>Acciones</td></tr>
        <?php
		$cnf=array_shift($config->mostrarConfig("InicioTrimestre2"));
		$fechaFinTrimestre1=$cnf['Valor'];
		
		foreach($agenda->mostrarRegistros($CodAl) as $a){
			$m=$materia->mostrarMateria($a['CodMateria']);
			$m=array_shift($m);
			$o=$observaciones->mostrarObser($a['CodObservacion']);
			$o=array_shift($o);
			if(strtotime($a['Fecha'])>=strtotime($fechaFinTrimestre1)){
				$clase=" verdeBajo";
			}else{
				$clase="";	
			}
			?>
           	<tr class="contenido <?php echo $clase; if($a['Resaltar'])echo " naranja";?> <?php if($a['Resaltar2'])echo "amarillo";?>"><td><?php echo $m['Nombre']?></td><td><?php echo $o['Nombre']?></td><td><?php echo $a['Detalle'];?></td><td><?php echo date("d-m-Y",strtotime($a['Fecha']));?></td><td><input type="checkbox" class="resaltar" rel="<?php echo $a['CodAgenda'];?>" title="Revisado" <?php if($a['Resaltar2'])echo 'checked="checked"';?>/><a href="#" class="btn btn-mini eliminar" title="Eliminar" rel="<?php echo $a['CodAgenda'];?>">x</a></td></tr>
            <?php
		}
		?>
    </table>
    <?php	
}

?>