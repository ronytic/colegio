<?php
include_once("../../login/check.php");
include_once("../../class/alumno.php");
include_once("../../class/curso.php");
if(!empty($_POST)){
	$al=new alumno;
	$rude=new alumno;
	$cur=new curso;
	@$CodAlumno=$_POST['CodAlumno'];	
	$CantidadTotal=$al->contarInscritosTotal();
	$CantidadTotal=$CantidadTotal[0];
	$CantidadTotalV=0;
	$CantidadTotalM=0;
	$CantidadNuevo=0;
	?>
    <table class="table">
    	<thead>
    	<tr><th><?php echo $idioma['CantidadTotalInscritos']?></th></tr>
        </thead>
        <tr class="contenido"><td><?php echo $CantidadTotal['CantidadTotal'];?> <?php echo $idioma['Alumnos']?></td></tr>
    </table>
    <div id="reporte"></div>
	<a href="#" class="imprimir btn btn-info btn-mini"><?php echo $idioma['Imprimir']?></a>
    <a href="#" class="btn btn-success btn-mini" id="exportarexcel"><?php echo $idioma['ExportarExcel']?></a>
    <table class="table table-condensed table-hover table-striped table-bordered">
    	<thead>
    	<tr class="cabecera"><th><?php echo $idioma['Fechas']?></th><th><?php echo $idioma['CantidadTotal']?></th></tr>
        </thead>
        <?php 
		$titulos=array();
		$cantidad=array();
		foreach($al->contarInscritoFechas() as $CantidadFechas){
			array_push($titulos,"'".utf8_encode(strftime("%A, %d de %B del %Y",strtotime($CantidadFechas['FechaIns'])))."'");
			array_push($cantidad,$CantidadFechas['CantidadFecha']);
			?>
        <tr class="contenido"><td><?php echo utf8_encode(strftime("%A, %d de %B del %Y",strtotime($CantidadFechas['FechaIns'])));?></td><td><?php echo $CantidadFechas['CantidadFecha'];?> <?php echo $idioma['Alumnos']?></td></tr>
        <?php
        }
		$titulos=implode(",",$titulos);
		$cantidad=implode(",",$cantidad);
		?>
    </table>
    <a href="#" class="btn btn-success btn-mini" id="exportarexcel"><?php echo $idioma['ExportarExcel']?></a>
    <table class="table table-hover table-bordered table-striped" id="cantidades">
    	<thead>
    	<tr class="cabecera"><th><?php echo $idioma['Cursos']?></th><th><?php echo $idioma['CantidadTotal']?></th><th><?php echo $idioma['Hombres']?></th><th><?php echo $idioma['Mujeres']?></th><th colspan="2"><?php echo $idioma['Nuevos']?></th></tr>
        </thead>
        <?php foreach($al->contarInscritoCurso() as $CantidadCurso){
				$var=$al->cantidadAlumno("Sexo=1 and CodCurso={$CantidadCurso['CodCurso']} and Retirado=0");
				$varones=array_shift($var);
				$muj=$al->cantidadAlumno("Sexo=0 and CodCurso={$CantidadCurso['CodCurso']} and Retirado=0");
				$mujeres=array_shift($muj);
				
				$cns=$rude->contarInscritoNuevoCurso($CantidadCurso['CodCurso']);
				$cn=array_shift($cns);
				
				$CantidadTotalM+=$mujeres['Cantidad'];
				$CantidadTotalV+=$varones['Cantidad'];
				$CantidadNuevo+=$cn['CantidadNuevo'];
				?>
        <tr class="contenido">
        	<td><?php  $cursos=array_shift($cur->mostrarCurso($CantidadCurso['CodCurso']));echo $cursos['Nombre'];?></td>
            <td><?php echo $CantidadCurso['CantidadCurso'];?> <?php echo $idioma['Alumnos']?></td>
			<td><?php echo $varones['Cantidad'];?> <?php echo $idioma['Alumnos']?></td>
            <td><?php echo $mujeres['Cantidad']?> <?php echo $idioma['Alumnas']?></td>
            <td class="text-right"><?php echo $cn['CantidadNuevo']?> </td>
            <td><a class="btn btn-mini vermasnuevo" title="<?php echo $idioma["VerAlumnosNuevos"]?>" rel="<?php echo $CantidadCurso['CodCurso']?>"><i class="icon-chevron-down"></i></a></td>

        </tr>
        <?php
        }
		?>
        <tfoot>
        <tr class="contenido resaltar">
        	<th><?php echo $idioma['TodoColegio']?></th>
            <th><?php echo $CantidadTotal['CantidadTotal'];?> <?php echo $idioma['Alumnos']?></th>
			<th><?php echo $CantidadTotalV;?> <?php echo $idioma['Alumnos']?></th>
            <th><?php echo $CantidadTotalM?> <?php echo $idioma['Alumnas']?></th>
            <th><?php echo $CantidadNuevo;?></th>
            <th></th>
        </tr>
        </tfoot>
    </table>
	<div class="alumnosnuevos oculto">
    	<div class="box-header"><h2><?php echo $idioma['AlumnosNuevos']?></h2></div>
        <div class="box-content" id="alumnosnuevos">
        </div>
    </div>
   
    
    
    <div class="clear"></div>
    <?php
	
}

?>
<script language="javascript" type="text/javascript" src="../../js/core/plugins/highcharts.js"></script>
<script language="javascript" type="text/javascript" src="../../js/core/plugins/exporting.js"></script>
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
                text: '<?php echo $idioma['EstadisticasInscritos']?>'
            },
            subtitle: {
                text: '<?php echo $idioma['Fecha']?>: <?php echo fecha2Str()?>'
            },
            xAxis: {
                categories: [<?php echo $titulos?>],
				labels: {
                    rotation: -90,
					align: 'right',
				}
            },
            yAxis: {
				min: 0,
                title: {
                    text: '<?php echo $idioma['CantidadInscritos']?>'
                }
            },
            tooltip: {
                enabled: true,
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': '+ this.y +' <?php echo $idioma['Inscritos']?>';
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
			legend:false,
            series: [
				{
                name: '<?php echo $idioma['CantidadInscritos'];?>',
                data: [<?php echo $cantidad?>]
            	}
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