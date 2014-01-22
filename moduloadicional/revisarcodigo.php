<?php
include_once("../login/check.php");
include_once("../class/factura.php");
include_once("../class/alumno.php");
include_once("../class/curso.php");
include_once("../factura/codigocontrol.class.php");
$factura=new factura;
$fac=$factura->mostrarFacturas("Estado='Valido'");
$alumno=new alumno;
$curso=new curso;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Listado de Facturas Erroneas</title>
</head>

<body>
<style type="text/css">
body{
	font-family:Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", serif	
}
a{
	background-color:#CCC;
	padding:4px;
	color:#333;
	text-decoration:none;	
}
</style>
<table border="1">
<tr style="font-weight:bold">
	<td>N</td>
	<td>Paterno</td>
    <td>Materno</td>
    <td>Nombres</td>
    <td>Curso</td>
    <td>Telefono</td>
	<!--<td>N Autorizacion</td>-->
    <td>N Factura</td>
    <td>Nit</td>
    <td>FechaFactura</td>
    <td>Monto</td>
    <!--<td>Llave</td>-->
    <td>Codigo Generado</td>
    <td>Codigo Correcto</td>
    <td>Estado</td>
</tr>
<?php
$CantidadCorrecto=0;
$CantidadIncorrecto=0;
$i=0;
foreach($fac as $f){$i++;
	
	$CodAlumno=$f['CodAlumno'];
	if($CodAlumno!=""){
		$al=$alumno->mostrarTodoDatos($CodAlumno);
		$al=array_shift($al);
		$cur=$curso->mostrarCurso($al['CodCurso']);
		$cur=array_shift($cur);
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
	}else{
		$CantidadIncorrecto++;
		$TextoEstado="Error";
	}
	?>
    <tr style="<?php echo $CodigoControlGuardado!=$CodigoControlGenerado?'background-color:#F93':'';?>">
    	<td><?php echo $i?></td>
    	<td><?php echo capitalizar($al['Paterno'])?></td>
        <td><?php echo capitalizar($al['Materno'])?></td>
        <td><?php echo capitalizar($al['Nombres'])?></td>
        <td><?php echo capitalizar($cur['Abreviado'])?></td>
        <td>C:<?php echo capitalizar($al['TelefonoCasa'])?><br>
        	P:<?php echo capitalizar($al['CelularP'])?><br>
            M:<?php echo capitalizar($al['CelularM'])?>
        </td>
    	<!--<td><?php echo $NAutorizacion?></td>-->
        <td><?php echo $NFactura?></td>
        <td><?php echo $Nit?></td>
        <td><?php echo $FechaFactura?></td>
        <td><?php echo $Total?></td>
        <!--<td><?php echo $LlaveDosificacion?></td>-->
    	<td><?php echo $CodigoControlGuardado?></td>
        <td><?php echo $CodigoControlGenerado?></td>
        <td><?php echo $TextoEstado;?></td>
        <td><?php if($TextoEstado=="Error"){?><a href="corregircodigo.php?CodFactura=<?php echo $CodFactura?>&CodigoControl=<?php echo $CodigoControlGenerado?>" target="_blank">Corregir</a><?php }?></td>
    </tr>
    <?php
}
?>
<tr style="background-color:#6C9;font-size:30px;">
	<td colspan="7">Cantidad Correctos</td>
    <td colspan="2" align="right"><?php echo $CantidadCorrecto?></td>
</tr>
<tr style="background-color:#F66;font-size:30px;">
	<td colspan="7">Cantidad Incorrectos</td>
    <td colspan="2" align="right"><?php echo $CantidadIncorrecto?></td>
</tr>
</table>
</body>
</html>