<?php
include_once("../../login/check.php");
include_once("../../class/agenda.php");
include_once("../../class/alumno.php");
include_once("../../class/curso.php");
include_once("../../class/materias.php");
include_once("../../class/config.php");
include_once("../../class/observaciones.php");
if(isset($_POST)){
	$Fecha=fecha2Str($_POST['Fecha'],0);
	//$CodAl=$_SESSION['CodAl'];
	$alumno=new alumno;
	$curso=new curso;
	$agenda=new agenda;
	$materia=new materias;
	$observaciones=new observaciones;
	$config=new config;

	//Cantidad de Observaciones
	$CodObser=$observaciones->CodObservaciones(1);
	foreach($CodObser as $CodO){$Obser[]=$CodO['CodObservacion'];}
	$CodigosObservaciones=implode(",",$Obser);
	$CantObser=$agenda->CantidadObservaciones($CodAl,$CodigosObservaciones,$_POST['CodMateria'],$Fecha);
	$CantObser=array_shift($CantObser);
	//Cantidad de Faltas
	$Obser=array();
	$CodObser=$observaciones->CodObservaciones(2);
	foreach($CodObser as $CodO){$Obser[]=$CodO['CodObservacion'];}
	$CodigosObservaciones=implode(",",$Obser);
	$CantFaltas=$agenda->CantidadObservaciones($CodAl,$CodigosObservaciones,$_POST['CodMateria'],$Fecha);
	$CantFaltas=array_shift($CantFaltas);
	//Cantidad de Atrasos
	$Obser=array();
	$CodObser=$observaciones->CodObservaciones(3);
	foreach($CodObser as $CodO){$Obser[]=$CodO['CodObservacion'];}
	$CodigosObservaciones=implode(",",$Obser);
	$CantAtrasos=$agenda->CantidadObservaciones($CodAl,$CodigosObservaciones,$_POST['CodMateria'],$Fecha);
	$CantAtrasos=array_shift($CantAtrasos);
	//Cantidad de Licencias
	$Obser=array();
	$CodObser=$observaciones->CodObservaciones(4);
	foreach($CodObser as $CodO){$Obser[]=$CodO['CodObservacion'];}
	$CodigosObservaciones=implode(",",$Obser);
	$CantLicencias=$agenda->CantidadObservaciones($CodAl,$CodigosObservaciones,$_POST['CodMateria'],$Fecha);
	$CantLicencias=array_shift($CantLicencias);
	//Cantidad de Felicitaciones
	$Obser=array();
	$CodObser=$observaciones->CodObservaciones(5);
	foreach($CodObser as $CodO){$Obser[]=$CodO['CodObservacion'];}
	$CodigosObservaciones=implode(",",$Obser);
	$CantNotificacion=$agenda->CantidadObservaciones($CodAl,$CodigosObservaciones,$_POST['CodMateria'],$Fecha);
	$CantNotificacion=array_shift($CantNotificacion);
	//Cantidad de No contestan
	$Obser=array();
	$CodObser=$observaciones->CodObservaciones(6);
	foreach($CodObser as $CodO){$Obser[]=$CodO['CodObservacion'];}
	$CodigosObservaciones=implode(",",$Obser);
	$CantNoContestan=$agenda->CantidadObservaciones($CodAl,$CodigosObservaciones,$_POST['CodMateria'],$Fecha);
	$CantNoContestan=array_shift($CantNoContestan);
	//Cantidad de Felicitaciones
	$Obser=array();
	$CodObser=$observaciones->CodObservaciones(7);
	foreach($CodObser as $CodO){$Obser[]=$CodO['CodObservacion'];}
	$CodigosObservaciones=implode(",",$Obser);
	$CantFelicitacion=$agenda->CantidadObservaciones($CodAl,$CodigosObservaciones,$_POST['CodMateria'],$Fecha);
	$CantFelicitacion=array_shift($CantFelicitacion);
	$Total=$CantObser['Cantidad']+$CantFaltas['Cantidad']+$CantAtrasos['Cantidad']+$CantLicencias['Cantidad']+$CantNotificacion['Cantidad']+$CantNoContestan['Cantidad']+$CantFelicitacion['Cantidad'];
	
	
	$ag=$agenda->mostrarRegistroFecha($Fecha);
	?>
    <table class="table table-condensed table-bordered inicio">
        <tr>
        	<td width="75" colspan="1" class=""><?php echo $idioma['TotalObservaciones']?>: <span class="resaltar"><?php echo $Total;?></span> <a href="#" class="imprimir btn btn-info btn-mini"><?php echo $idioma['Imprimir']?></a></td>
        </tr>
    	<tr>
        	<td class="centrar" id="grafica" width="100%" height="270"><?php echo $CantObser['Cantidad'];?></td>
            
            
        </tr>
    </table>
    <?php
	?>
    <a href="#" id="exportarexcel" class="btn btn-success btn-mini"><?php echo $idioma['ExportarExcel']?></a>
    <table class="table table-hover table-bordered table-striped table-condensed inicio">
	<thead>
    	<tr class="resaltar"><th colspan="3"><?php echo $idioma['Fecha']?></th><th colspan="4"><?php echo fecha2Str($Fecha)?></th></tr>
    	<tr class="cabecera"><th width="10" style="min-width:10px;"></th><th><small><?php echo $idioma['Nombre']?></small></th><th><small><?php echo sacarToolTip($idioma['Curso'],"","0")?></small></th><th><small><?php echo sacarToolTip($idioma['Materia'],"","R",3)?></small></th><th width="100"><small><?php echo sacarToolTip($idioma['Observacion'],"","R",3)?></small></th><th><small><?php echo $idioma['Detalle']?></small></th><th></th></tr>
</thead>
        <?php
		if(!count($ag)){
			?>
            <tr><td colspan="5"><?php echo $idioma['NoExisteRegistro'];?></td></tr>
            <?php
		}else{
			
		foreach($ag as $a){
			$al=$alumno->mostrarTodoDatos($a['CodAlumno']);
			$al=array_shift($al);
			
			$cur=$curso->mostrarCurso($al['CodCurso']);
			$cur=array_shift($cur);
			
			/*Sacando Fecha de Trimestre*/
			if($cur['Bimestre']){
				$cnf=$config->mostrarConfig("InicioBimestre1");
				$fechaInicioBimestre1=$cnf['Valor'];
				$cnf=$config->mostrarConfig("FinBimestre1");
				$fechaFinBimestre1=$cnf['Valor'];
				$cnf=$config->mostrarConfig("InicioBimestre2");
				$fechaInicioBimestre2=$cnf['Valor'];
				$cnf=$config->mostrarConfig("FinBimestre2");
				$fechaFinBimestre2=$cnf['Valor'];
				$cnf=$config->mostrarConfig("InicioBimestre3");
				$fechaInicioBimestre3=$cnf['Valor'];
				$cnf=$config->mostrarConfig("FinBimestre3");
				$fechaFinBimestre3=$cnf['Valor'];
				$cnf=$config->mostrarConfig("InicioBimestre4");
				$fechaInicioBimestre4=$cnf['Valor'];
				$cnf=$config->mostrarConfig("FinBimestre4");
				$fechaFinBimestre4=$cnf['Valor'];
			}else{
				$cnf=$config->mostrarConfig("InicioTrimestre1");
				$fechaInicioTrimestre1=$cnf['Valor'];
				$cnf=$config->mostrarConfig("FinTrimestre1");
				$fechaFinTrimestre1=$cnf['Valor'];
				$cnf=$config->mostrarConfig("InicioTrimestre2");
				$fechaInicioTrimestre2=$cnf['Valor'];
				$cnf=$config->mostrarConfig("FinTrimestre2");
				$fechaFinTrimestre2=$cnf['Valor'];
				$cnf=$config->mostrarConfig("InicioTrimestre3");
				$fechaInicioTrimestre3=$cnf['Valor'];
				$cnf=$config->mostrarConfig("FinTrimestre3");
				$fechaFinTrimestre3=$cnf['Valor'];
			}
			/*Fin de Sacando Información de Trimestre*/
			
			$tipo=0;
			$mensaje="";
			$m=$materia->mostrarMateria($a['CodMateria']);
			$m=array_shift($m);
			$o=$observaciones->mostrarObser($a['CodObservacion']);
			$o=array_shift($o);
			if($cur['Bimestre']){
				if(strtotime($a['Fecha'])>=strtotime($fechaInicioBimestre1) and strtotime($a['Fecha'])<=strtotime($fechaFinBimestre1)){$tipo=1;}
				if(strtotime($a['Fecha'])>=strtotime($fechaInicioBimestre2) and strtotime($a['Fecha'])<=strtotime($fechaFinBimestre2)){$tipo=2;}
				if(strtotime($a['Fecha'])>=strtotime($fechaInicioBimestre3) and strtotime($a['Fecha'])<=strtotime($fechaFinBimestre3)){$tipo=3;}
				if(strtotime($a['Fecha'])>=strtotime($fechaInicioBimestre4) and strtotime($a['Fecha'])<=strtotime($fechaFinBimestre4)){$tipo=4;}
				$mensaje=$tipo." ".$idioma['Bimestre'];
			}else{
				if(strtotime($a['Fecha'])>=strtotime($fechaInicioTrimestre1) and strtotime($a['Fecha'])<=strtotime($fechaFinTrimestre1)){$tipo=1;}
				if(strtotime($a['Fecha'])>=strtotime($fechaInicioTrimestre2) and strtotime($a['Fecha'])<=strtotime($fechaFinTrimestre2)){$tipo=2;}
				if(strtotime($a['Fecha'])>=strtotime($fechaInicioTrimestre3) and strtotime($a['Fecha'])<=strtotime($fechaFinTrimestre3)){$tipo=3;}
				$mensaje=$tipo." ".$idioma['Trimestre'];
			}
			if($a['Resaltar']){$resaltar="resaltar";}else{$resaltar="";}
			?>
           	<tr class=" <?php if($a['Resaltar2'])echo "warning";?>">
            	<td>
                	<?php
                    switch($tipo){
						case 1:{?><div class="cverde lateral" title="<?php echo $mensaje?>"></div><?php }break;
						case 2:{?><div class="cazul lateral" title="<?php echo $mensaje?>"></div><?php }break;
						case 3:{?><div class="cnaranja lateral" title="<?php echo $mensaje?>"></div><?php }break;
						case 4:{?><div class="cnegro lateral" title="<?php echo $mensaje?>"></div><?php }break;	
					}
					?><?php if($a['Resaltar']){?><div class="crojo" title="<?php echo $idioma['Importante']?>"></div><?php }?></td>
                <td class="<?php echo $resaltar?>"><?php echo capitalizar($al['Paterno'])?> <?php echo capitalizar(acortarPalabra($al['Nombres']))?></td>
                <td class="<?php echo $resaltar?>"><small><?php echo $cur['Abreviado']?></small></td>
            	<td class="<?php echo $resaltar?> pequeno"><?php echo $m['Abreviado']?></td>
                <td class="<?php echo $resaltar?>"><?php echo $o['Nombre']?></td>
                <td class="<?php echo $resaltar?>"><?php echo $a['Detalle'];?></td>
				<td class="centrar">
                    <a href="agenda/total/agenda.php?CodAl=<?php echo $a['CodAlumno']?>" class="btn btn-mini" title="<?php echo $idioma['VerAgenda']?>"><i class="icon-book"></i></a>
                </td>
			</tr>
            <?php
		}
		}//Fin If
		?>
    </table>
    <?php	
}

?>
<script language="javascript" type="application/javascript" src="js/core/plugins/exporting.js"></script>
<script language="javascript" type="text/javascript">
var chart;
chart = new Highcharts.Chart({
	chart: {
		renderTo: 'grafica',
		type: 'bar'
	},
	title: {
		text: '<?php echo $idioma['Estadisticas']?> <?php echo $idioma['Agenda']?>'
	},
	subtitle: {
		text: '<?php echo $idioma['Fecha']?>: <?php echo fecha2Str($Fecha)?>'
	},
	xAxis: {
		categories: ['<?php echo $idioma['Observaciones']?>', '<?php echo $idioma['Faltas']?>', '<?php echo $idioma['Atrasos']?>', '<?php echo $idioma['Licencias']?>','<?php echo $idioma['NoRespondeTelf']?>','<?php echo $idioma['NotificacionPadres']?>', '<?php echo $idioma['Felicitaciones']?>'],
	},
	yAxis: {
		min: 0,
		title: {
			text: '<?php echo $idioma['CantidadObservaciones']?>'
		},
		labels: {
                    overflow: 'justify'
                }
	},
	plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
	legend:false,
	series: [{
		name: '<?php echo $idioma['Observaciones']?>',
		data: [<?php echo $CantObser['Cantidad'];?>,<?php echo $CantFaltas['Cantidad'];?>,<?php echo $CantAtrasos['Cantidad'];?>,<?php echo $CantLicencias['Cantidad'];?>,<?php echo $CantNoContestan['Cantidad'];?>,<?php echo $CantNotificacion['Cantidad'];?>,<?php echo $CantFelicitacion['Cantidad'];?>],
	}],
	exporting: {
		enabled: false
	}
});
$(document).ready(function() {
	$(".imprimir").click(function(e) {
		e.preventDefault();
		chart.print();
	});
});
</script>