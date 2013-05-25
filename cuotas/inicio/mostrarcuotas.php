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
	<table class="table table-bordered table-striped table-hover">
    <thead>
    	<tr><th colspan="5" class="der"><?php echo $idioma['Total']?> <?php echo $idioma['Dia']?></th><th colspan="2" class="der"><?php echo $MontoTotal?></th></tr>
    	<tr><th>N</th>
		<th><?php echo $idioma["NombreCompleto"]?></th>
        <th><?php echo $idioma["Curso"]?></th>
        <th><?php echo $idioma["FechaPago"]?></th>
        <th><?php echo sacarIniciales($idioma["Numero"])?>/<?php echo sacarIniciales($idioma["Cuota"])?></th>
        <th><?php echo $idioma["Factura"]?></th>
        <th><?php echo $idioma["Monto"]?></th>
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
            <td><?php echo $cur['Abreviado'];?></td>
            <td><?php echo fecha2Str($cuo['Fecha']);?></td>
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
<h2><?php echo $idioma['NoHayPagoCuotasFecha']?></h2>
<?php	
}
}
?>