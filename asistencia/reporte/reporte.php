<?php
include_once("../../login/check.php");
include_once("../../class/asistencia.php");
include_once("../../class/alumno.php");
include_once("../../class/curso.php");
$alumno=new alumno;
$asistencia=new asistencia;
$curso=new curso;
extract($_GET);
$FechaInicio=fecha2Str($FechaInicio,0);
$FechaFin=fecha2Str($FechaFin,0);
$where="";
if($CodCurso!="Todo"){
	$where.=" CodCurso=$CodCurso";
	if($CodAlumno!=""){
		$where.=" and CodAlumno=$CodAlumno";
	}
}
//echo $where;
$Cod=array();
foreach($alumno->mostrarDatosAlumnosCursoWhere($where) as $al){
	array_push($Cod,$al['CodAlumno']);
}
$Cod=implode(",",$Cod);
//echo $Cod;
$where="CodAlumno IN($Cod)";
if($TipoObservacion!="Todos"){
	$where.=" and Tipo='$TipoObservacion'";
}
$where.=" and (Fecha BETWEEN  '$FechaInicio' AND  '$FechaFin')";
//echo $where;
$asis=$asistencia->mostrarAsistenciaWhere($where);
?>
<a href="#" id="exportarexcel" class="btn btn-mini btn-success"><?php echo $idioma['ExportarExcel']?></a>
<table class="table table-hover table-striped table-bordered">
	<thead>
    	<tr><th>N</th><th><?php echo $idioma['Nombres']?></th><th><?php echo $idioma['Curso']?></th><th><?php echo $idioma['Fecha']?></th><th><?php echo $idioma['Hora']?></th><th><?php echo sacarTooltip($idioma['TipoObservacion'])?></th></tr>
    </thead>
	<?php foreach($asis as $a){$i++;
		$al=$alumno->mostrarTodoDatos($a['CodAlumno']);
		$al=array_shift($al);
		//print_r($al);
		$cur=$curso->mostrarCurso($al['CodCurso']);
		$cur=array_shift($cur);
		switch($a['Tipo']){
			case 'C':{$t=$idioma["Asistencia"];}break;
			case 'F':{$t=$idioma["Falta"];}break;
			case 'A':{$t=$idioma["Atraso"];}break;	
		}
	?>
    <tr>
    	<td><?php echo $i;?></td>
        <td><?php echo capitalizar($al['Paterno']." ".$al['Materno']." ".$al['Nombres'])?></td>
        <td><?php echo $cur['Nombre']?></td>
        <td><?php echo fecha2Str($a['Fecha'])?></td>
        <td><?php echo hora2Str($a['Hora'])?></td>
        <td><?php echo sacarTooltip($t)?></td>
	</tr>
    <?php }?>
</table>
<?php
?>