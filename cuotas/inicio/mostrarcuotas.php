<?php
include_once("../../login/check.php");
if(isset($_POST)){
include_once("../../class/cuota.php");
include_once("../../class/alumno.php");
include_once("../../class/curso.php");
$cuota=new cuota;
$alumno=new alumno;
$curso=new curso;
$Desde=fecha2Str($_POST['Fecha'],0);
$cuotas=$cuota->mostrarCuotasWhere("cuota c,alumno a","a.Paterno,a.Materno,a.Nombres,a.CodCurso,c.*","c.CodAlumno=a.CodALumno and DATE(c.Fecha) = '$Desde' and c.Cancelado=1 ","a.CodCurso,c.Factura,c.Numero");
	$MontoTotal=0;
	$i=0;
if(count($cuotas)){
	foreach($cuotas as $cuo){
	$MontoTotal+=$cuo['MontoPagar'];	
	}
	$MontoTotal=number_format($MontoTotal,2)
	?>
    <a href="#" id="exportarexcel" class="btn btn-success btn-mini"><?php echo $idioma['ExportarExcel']?></a>
	<table class="table table-bordered table-striped table-hover inicio">
    <thead>
    	<tr><th colspan="5" class="der"><?php echo $idioma['Total']?> <?php echo $idioma['Del']?> <?php echo $idioma['Dia']?> <?php echo $idioma['Recaudado']?>: </th><th colspan="2" class="der"><?php echo $MontoTotal?></th></tr>
    	<tr><th>N</th>
		<th><small><?php echo $idioma["NombreCompleto"]?></small></th>
        <th><small><?php echo $idioma["Curso"]?></small></th>
        <th><small><?php echo $idioma["FechaPago"]?></small></th>
        <th><small><span title="<?php echo $idioma["Numero"]." ".$idioma["De"]." ".$idioma["Cuota"]?>"><?php echo sacarIniciales($idioma["Numero"])?>/<?php echo sacarIniciales($idioma["Cuota"])?></span></small></th>
        <th><small><?php echo $idioma["Factura"]?></small></th>
        <th><small><?php echo $idioma["Monto"]?></small></th>
        </tr>
    </thead>
	<?php
	foreach($cuotas as $cuo){
		$i++;
		$al=$alumno->mostrarTodoDatos($cuo['CodAlumno']);
		$al=array_shift($al);
		$nombre=explode(" ",$al['Nombres']);
		$nombre=array_shift($nombre);
		$cur=$curso->mostrarCurso($al['CodCurso']);
		$cur=array_shift($cur);
		$fechaPago=date("d-m-Y",strtotime($cuo['Fecha']));
		$MontoTotal+=$cuo['MontoPagar'];
		?>
        <tr>
        	<td><?php echo $i;?></td>
            <td><?php echo capitalizar($al['Paterno']." ".$al['Materno']." ".$al['Nombres']);?></td>
            <td><small><?php echo $cur['Abreviado'];?></small></td>
            <td><small><?php echo fecha2Str($cuo['Fecha']);?></small></td>
            <td><?php echo $cuo['Numero'];?></td>
            <td><?php echo $cuo['Factura'];?></td>
            <td><?php echo number_format(round($cuo['MontoPagar'],2),2);?></td>
        </tr>
		<?php
	}
	?>
	</table>
	<?php
}else{
?>
<span class="resaltar"><?php echo $idioma['NoHayPagoCuotasFecha']?></span>
<?php	
}
}
?>