<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	include_once("../../class/agenda.php");
	include_once("../../class/curso.php");
	include_once("../../class/alumno.php");
	include_once("../../class/materias.php");
	include_once("../../class/observaciones.php");
	$agenda=new agenda;
	$observaciones=new observaciones;
	$alumno=new agenda;
	$cursos=new curso;
	$materias=new materias;
	
	$FechaInicio=$_POST['FechaInicio'];
	$FechaFinal=$_POST['FechaFinal'];
	$Curso=$_POST['Curso'];
	$Materia=$_POST['Materia'];
	$Alumnos=$_POST['Alumnos'];
	$Observacion=$_POST['Observacion'];
	//print_r($Observacion);
	$FechaInicio=fecha2Str($FechaInicio,0);
	$FechaFinal=fecha2Str($FechaFinal,0);
	$Cod=array_shift($_POST['Observacion']);
	
	if($Cod==""){
		//echo "Asd";
		$Observacion=array();
		foreach($observaciones->mostrarObservaciones("Nombre") as $obs){
			//$obs=array_shift($obs);
			array_push($Observacion,$obs['CodObservacion']);
		}
	}else{
		$Observacion=(array)$Observacion;
	}
	
	//print_r($Observacion);
	$ValoresObser=array();
	foreach($Observacion as $obs){$i++;
		$o=$observaciones->mostrarObser($obs);
		$o=array_shift($o);
		$ValoresObser['Observacion'.$i]="".$o['Nombre']."";
	}
	
	$CantidadDias=(strtotime($FechaFinal)-strtotime($FechaInicio))/86400;
	$ValoresFechas=array();
	$Valores=array();
	
		$j=0;
		foreach($Observacion as $obs){$j++;
			$Valor=array();
			for($i=1;$i<=$CantidadDias+1;$i++){
				
				$Fecha=date("Y-m-d",strtotime($FechaInicio."+".($i-1)."days"));
				$ag=$agenda->CantidadObservacionesTotal($Curso,$Alumnos,$obs,$Materia,$Fecha);
				$ag=array_shift($ag);
				$Cantidad=$ag['Cantidad'];
				
				array_push($Valor,$Cantidad);
				$Valores[$j]['Cantidades']=$Valor;
				$ValoresFechas['Fecha'.$i]="'".utf8_encode(strftime("%A",strtotime($Fecha))).",".fecha2Str($Fecha)."'";
			}
		}
		
		
	//print_r($Valores);
	//print_r($ValoresFechas);
	$ValoresFechas=implode(",",$ValoresFechas);
	//echo implode(",",$ValoresObser)."<br>";
	//echo $ValoresFechas."<br>";
	//echo $ValoresObser."<br>";
	foreach($Valores as $Val){
		//print_r($Val);
		$ValoresCantidad=implode(",",$Val['Cantidades']);
		//echo $ValoresCantidad."<br>";
	}
	//print_r($Valores);
	/*foreach($ValoresFechas as $vf){
			
	}*/
	//var_dump($Valores);
//	echo $CantidadDias;

	$subtitulo="";
	
	if($Curso==""){
		$subtitulo.=" ".$idioma['Curso'].": ".$idioma['TodaUnidadEducativa']." - ";
	}else{
		$cur=$cursos->mostrarCurso($Curso);
		$cur=array_shift($cur);
		$subtitulo.=" ".$idioma['Curso'].": ".$cur['Nombre']." - ";
	}
	if($Materia==""){
		$subtitulo.=" ".$idioma['Materia'].": ".$idioma['Todas']." - ";
	}else{
		$mat=$materias->mostrarMateria($Materia);
		$mat=array_shift($mat);
		$subtitulo.=" ".$idioma['Materia'].": ".$mat['Nombre']." - ";
	}
	if($Alumnos==""){
		$subtitulo.=" ".$idioma['Alumnos'].": ".$idioma['Todos']." - ";
	}else{
		$al=$alumno->mostrarRegistros($Alumnos);
		$al=array_shift($al);
		$subtitulo.=" ".$idioma['Alumnos:'].": ".$al['Paterno']." ".$al['Materno']." ".$al['Nombres']." - ";
	}
}
?>
<div id="reporte"></div>
<a href="#" class="imprimir btn btn-info"><?php echo $idioma['Imprimir']?></a>
<script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
		$(".imprimir").click(function(e) {
            e.preventDefault();
			chart.print();
        });
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'reporte',
                type: 'line'
            },
            title: {
                text: '<?php echo $idioma['ReporteEstadisticoAgenda']?>'
            },
            subtitle: {
                text: '<?php echo $subtitulo?>'
            },
            xAxis: {
                categories: [<?php echo $ValoresFechas?>],
				labels: {
                    rotation: -90,
					align: 'right',
				}
            },
            yAxis: {
				min: 0,
                title: {
                    text: '<?php echo $idioma['CantidadObservaciones']?>'
                }
            },
            tooltip: {
                enabled: true,
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': '+ this.y +' <?php echo $idioma['Registros']?>';
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: true
                }
            },
            series: [
			<?php $i=0;foreach($ValoresObser as $Vo){$i++;
				$Val=array_shift($Valores);
				//$Vo=array_shift($ValoresObser);
				$ValoresCantidad=implode(",",$Val['Cantidades']);
				echo $i!=1?",":"";
				?>
				{
                name: '<?php echo $Vo//.$i;?>',
                data: [<?php echo $ValoresCantidad?>]
            	}
				<?php
			}?>
			]
			,navigation: {
				buttonOptions: {
					enabled: false
				}
        	}
        });
    });
    
});
		</script>