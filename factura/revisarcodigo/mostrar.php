<?php
include_once("../../login/check.php");
$FechaInicio=$_POST['FechaFacturaInicio'];
$FechaFinal=$_POST['FechaFacturaFin'];
$Tipo=$_POST['Tipo'];
$FechaInicio=fecha2Str($FechaInicio,0);
$FechaFinal=fecha2Str($FechaFinal,0);
include_once("../../class/factura.php");
include_once("../../class/alumno.php");
include_once("../../class/curso.php");
include_once("../../factura/codigocontrol.class.php");
$factura=new factura;
$fac=$factura->mostrarFacturas("(FechaFactura BETWEEN '$FechaInicio' and '$FechaFinal') and Estado='Valido'");
$alumno=new alumno;
$curso=new curso;
?>
<a href="#" id="exportarexcel" class="btn btn-mini btn-success"><?php echo $idioma['ExportarExcel']?></a>
<table class="table table-condensed table-bordered table-striped table-hover">
<thead>
<tr>
	<th>N<hr class="separador"></th>
	
	<!--<th>N Autorizacion</th>-->
    <th><?php echo $idioma['NFactura']?><hr class="separador"></th>
    <th><?php echo $idioma['Nit']?><hr class="separador"><?php echo $idioma['Paterno']?></th>
    <th><?php echo $idioma['FechaFactura']?><hr class="separador"><?php echo $idioma['Materno']?></th>
    <th><?php echo $idioma['Monto']?><hr class="separador"><?php echo $idioma['Nombres']?></th>
    <!--<th>Llave</th>-->
    <th><?php echo $idioma['CodigoGenerado']?><hr class="separador"><?php echo $idioma['Curso']?></th>
    <th><?php echo $idioma['CodigoCorrecto']?><hr class="separador"><?php echo $idioma['Telefono']?></th>
    <th><?php echo $idioma['Estado']?></th>
    <th></th>
</tr>

</thead>
<?php
$CantidadCorrecto=0;
$CantidadIncorrecto=0;
$i=0;
foreach($fac as $f){
	
	$CodAlumno=$f['CodAlumno'];
	if($CodAlumno!="0"){
		$al=$alumno->mostrarTodoDatos($CodAlumno);
		$al=array_shift($al);
		$cur=$curso->mostrarCurso($al['CodCurso']);
		$cur=array_shift($cur);
	}else{
		$al['Nombres']=$f['Factura'];
		$al['Paterno']=$f['Tipo'];
		$al['Materno']="";
	}
	$CodFactura=$f['CodFactura'];
	$FechaFactura=$f['FechaFactura'];
	$NFactura=$f['NFactura'];
	$Nit=$f['Nit'];
	$Total=$f['TotalBs'];
	$CodigoControlGuardado=$f['CodigoControl'];
	$NAutorizacion=$f['NumeroAutorizacion'];
	$LlaveDosificacion=$f['LlaveDosificacion'];
	$FechaFactura=date("Ymd",strtotime($FechaFactura));
	
	
	$CodigoControl=new CodigoControl($NAutorizacion,$NFactura,$Nit,$FechaFactura,$Total,$LlaveDosificacion);
	$CodigoControlGenerado=$CodigoControl->generar();
	
	
	if($CodigoControlGuardado==$CodigoControlGenerado){
		$CantidadCorrecto++;
		$TextoEstado="Correcto";	
		if($Tipo=="Incorrectos"){
			continue;
		}
	}else{
		$CantidadIncorrecto++;
		$TextoEstado="Error";
		if($Tipo=="Correctos"){
			continue;
		}
	}
	$i++;
	?>
    <tr class="<?php echo $CodigoControlGuardado!=$CodigoControlGenerado?'error':'';?>">
    
    	<td class="der"><?php echo $i?></td>
    	
    	<!--<td><?php echo $NAutorizacion?></td>-->
        <td><?php echo $NFactura?></td>
        <td><?php echo $Nit?></td>
        <td><?php echo fecha2Str($FechaFactura)?></td>
        <td><?php echo $Total?></td>
        <!--<td><?php echo $LlaveDosificacion?></td>-->
    	<td><strong><?php echo $CodigoControlGuardado?></strong></td>
        <td><strong><?php echo $CodigoControlGenerado?></strong></td>
        <td><?php echo $idioma[$TextoEstado];?></td>
        <td><?php if($TextoEstado=="Error"){?><a href="corregircodigo.php?CodFactura=<?php echo $CodFactura?>&CodigoControl=<?php echo $CodigoControlGenerado?>" target="_blank" class="btn btn-small btn-danger">Corregir</a><?php }?></td>
    </tr>
    <tr>
    	<td colspan="2"></td>
    	<td><?php echo capitalizar($al['Paterno'])?></td>
        <td><?php echo capitalizar($al['Materno'])?></td>
        <td><?php echo capitalizar($al['Nombres'])?></td>
        <td><?php echo capitalizar($cur['Abreviado'])?></td>
        <td>C:<?php echo capitalizar($al['TelefonoCasa'])?><br>
        	P:<?php echo capitalizar($al['CelularP'])?><br>
            M:<?php echo capitalizar($al['CelularM'])?>
        </td>
        <td></td>
        <td></td>
    </tr>
    <?php
}
?>
<tr class="success">
	<td class="der x2" colspan="7"><?php echo $idioma['CantidadCorrectos']?></td>
    <td class="der x2"><?php echo $CantidadCorrecto?></td>
    <td></td>
</tr>
<tr class="error">
	<td class="der x2" colspan="7"><?php echo $idioma['CantidadIncorrectos']?></td>
    <td class="der x2"><?php echo $CantidadIncorrecto?></td>
    <td></td>
</tr>
</table>