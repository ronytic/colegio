<?php
include_once("../login/check.php");
if(!empty($_POST)){
	$CodAlumno=$_POST['CodAlumno'];
	$archivo=$_POST['archivo'];
	include_once("../class/documentosimpresos.php");
	$documentosimpresos=new documentosimpresos;
	?><table class="table table-bordered table-hover table-condensed">
        	<tr><th><?php echo $idioma["Archivo"]?></th><th><?php echo $idioma["Fecha"]?></th><th><?php echo $idioma["Hora"]?></th></tr>
    <?php
	foreach($documentosimpresos->mostrarDocumentosImpresos($archivo,$CodAlumno) as $docimpreso){
	?>
    	<tr><td><?php echo $docimpreso['TipoDocumento']?></td><td><?php echo date("d-m-Y",strtotime($docimpreso['FechaRegistro']))?></td><td><?php echo $docimpreso['HoraRegistro']?></td><td><a href="#" class="btn btn-mini" id="eliminarimpresion" rel="<?php echo $docimpreso['CodDocumentosImpresos']?>" title="<?php echo $idioma['Eliminar']?>"><i class="icon-remove"></i></a></td></tr>
    <?php	
	}
	?>
    </table>
    <?php
}
?>