<?php
include_once("../../login/check.php");
include_once("../../class/logusuario.php");
include_once("../../class/usuario.php");
include_once("../../class/docente.php");
include_once("../../class/alumno.php");
$folder="../../";
$logusuario=new logusuario;
$usuario=new usuario;
$docente=new docente;
$alumno=new alumno;
if($_SESSION['Nivel']==1){
	$Tipo="";
}else{
	$Tipo="1";
}

extract($_POST);
$FechaInicio=fecha2Str($FechaInicio);
$FechaFin=fecha2Str($FechaFin);
/*echo strtotime($FechaInicio);
echo "<br>";
echo strtotime($FechaFin);
echo "<br>";
echo strtotime($FechaFin)- strtotime($FechaInicio);
*/
if($Nivel==1 || $Nivel=="Todos"){
	if($_SESSION['Nivel']=="1"){$Inicio=1;}else{$Inicio=2;}
	$Fin=7;
}else{
	$Inicio=$Nivel;	
	$Fin=$Nivel;
}
for($j=$Inicio;$j<=$Fin;$j++){
	$val=array();
	for($i=strtotime($FechaInicio);$i<=strtotime($FechaFin);$i=$i+86400){
		$Fecha=date("Y-m-d",$i);	
		$log=$logusuario->mostrarCantidadUsuarioFecha($Fecha,$j);
		$log=array_shift($log);
		$Cantidad=$log['Cantidad'];
		array_push($val,$Cantidad);
	}
	switch($j){
	case 1:{$nombre=$idioma['Administradores'];}break;	
	case 2:{$nombre=$idioma['Directores'];}break;	
	case 3:{$nombre=$idioma['Docentes'];}break;	
	case 4:{$nombre=$idioma['Secretaria'];}break;	
	case 5:{$nombre=$idioma['Regentes'];}break;	
	case 6:{$nombre=$idioma['PadresFamilia'];}break;	
	case 7:{$nombre=$idioma['Alumnos'];}break;	
	}
	$Valores[$nombre]=implode(",",$val);
}
$ValoresFechas=array();
for($i=strtotime($FechaInicio);$i<=strtotime($FechaFin);$i=$i+86400){
	$Fecha=date("Y-m-d",$i);	
	$F=utf8_encode(strftime("'%A, %d de %B del %Y'",$i));
	
	array_push($ValoresFechas,$F);
}
$ValoresFechas=implode(",",$ValoresFechas);
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
                text: '<?php echo $idioma['ReporteEstadisticoAccesos']?>'
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
                    text: '<?php echo $idioma['CantidadAccesos']?>'
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
			<?php $i=0;foreach($Valores as $k=>$v){$i++;
				echo $i!=1?",":"";
				?>
				{
                name: '<?php echo $k//.$i;?>',
                data: [<?php echo $v?>]
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
