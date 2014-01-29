<?php
include_once("../../login/check.php");
extract($_POST);
$da=array();
foreach($_POST as $k=>$v){
	array_push($da,$k."=".$v);
};
$url="../../impresion/factura/listado.php?".implode("&",$da);
$condi=array();
if($FechaFacturaInicio!="" && $FechaFacturaFin!=""){
	$FechaFacturaInicio=fecha2Str($FechaFacturaInicio,0);
	$FechaFacturaFin=fecha2Str($FechaFacturaFin,0);
	array_push($condi,"FechaFactura BETWEEN '$FechaFacturaInicio' and '$FechaFacturaFin'");
}
if($NFactura!=""){
	array_push($condi,"NFactura='$NFactura'");
}
if($Nit!=""){
	array_push($condi,"Nit='$Nit'");
}

if($Factura!=""){
	array_push($condi,"Factura LIKE '%$Factura%'");
}
if($Estado!=""){
	array_push($condi,"Estado LIKE '%$Estado%'");
}
if($Tipo!=""){
	array_push($condi,"Tipo LIKE '%$Tipo%'");
}
$where=implode(" and ",$condi);
include_once("../../class/factura.php");
$factura=new factura;
$fac=$factura->mostrarFacturas($where)
?>
<a class="btn btn-mini btn-success" id="exportarexcel"><?php echo $idioma['ExportarExcel']?></a>
<table class="table table-bordered table-hover table-striped">
<thead>
	<tr>
    	<th colspan="2"><?php echo $idioma['RangoFecha']?>:</th>
        <th colspan="2"><?php echo fecha2Str($FechaFacturaInicio)?> / <?php echo fecha2Str($FechaFacturaFin)?></th>
        <th colspan="7"></th>
    </tr>
    <tr>
        <th>N</th>
        <th><?php echo $idioma['FechaFactura']?></th>
        <th><?php echo $idioma['NFactura']?></th>
        <th><?php echo $idioma['Nit']?></th>
        <th><?php echo $idioma['FacturaA']?></th>
        <th><?php echo $idioma['TotalBs']?></th>
        <th><?php echo $idioma['Cancelado']?></th>
        <th><?php echo $idioma['Cambio']?></th>
        <th><?php echo $idioma['Estado']?></th>
        <th></th>
    </tr>
</thead>
<?php 
$tot=0;
$can=0;
$cambio=0;
if(count($fac)){
	foreach($fac as $f){$i++;
	$tot+=$f['TotalBs'];
	$can+=$f['Cancelado'];
	$cambio+=$f['MontoDevuelto'];
	?>
	<tr <?php echo $f['TotalBs']!=$f['Cancelado']?'class="error"':'';?>>
		<td><?php echo $i?></td>
		<td><?php echo fecha2Str($f['FechaFactura'])?></td>
		<td><?php echo ($f['NFactura'])?></td>
		<td><?php echo ($f['Nit'])?></td>
		<td><?php echo ($f['Factura'])?></td>
		<td class="der"><?php echo number_format($f['TotalBs'],2)?></td>
		<td class="der"><?php echo number_format($f['Cancelado'],2)?></td>
		<td class="der"><?php echo number_format($f['MontoDevuelto'],2)?></td>
		<td>
		<select class="estado input-small" rel="<?php echo $f['CodFactura']?>" <?php echo $f['Estado']=="Anulado"?'disabled="disabled"':''?>>
        	<option value="Valido" <?php echo ($f['Estado']=="Valido")?'selected="selected"':'';?>><?php echo $idioma['Valido']?></option>
            <option value="Anulado" <?php echo ($f['Estado']=="Anulado")?'selected="selected"':'';?>><?php echo $idioma['Anulado']?></option>
        </select>
        </td>
		<td><a href="ver.php?f=<?php echo $f['CodFactura']?>" target="_blank" class="btn btn-mini"><?php echo $idioma['VerFactura']?></a></td>
	</tr>
	<?php }?>
    <tfoot>
    	<tr><th colspan="5" class="der"><?php echo $idioma['Totales']?></th><th class="der"><?php echo number_format($tot,2);?></th>
        <th class="der"><?php echo number_format($can,2);?></th>
        <th class="der"><?php echo number_format($cambio,2);?></th>
        <th colspan="2"></th>
        </tr>
    </tfoot>
<?php }else{?>
<tr><td colspan="11"><?php echo $idioma['NoExisteFacturas'];?></td></tr>
<?php }?>
</table>
  