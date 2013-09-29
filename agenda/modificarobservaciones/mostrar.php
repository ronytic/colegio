<?php
include_once("../../login/check.php");
include_once("../../class/observaciones.php");
$observaciones=new observaciones;
$obs=$observaciones->mostrarObservaciones("Nombre");
$tipo=array("1"=>$idioma['Observacion'],"2"=>$idioma['Faltas'],"3"=>$idioma['Atrasos'],"4"=>$idioma['Licencias'],"5"=>$idioma['NotificacionPadres'],"6"=>$idioma['NoRespondeTelf'],"7"=>$idioma['Felicitaciones']);
    if(count($obs)){
		?><a href="#" class="btn btn-mini btn-success" id="exportarexcel"><?php echo $idioma['ExportarExcel']?></a>
        <table class="table table-bordered table-striped table-hover table-condensed">
		<thead><tr><th>N</th><th><?php echo $idioma['Nombre']?></th><th><?php echo $idioma['TipoObservacion']?></th><th><?php echo $idioma['MostrarDocente']?></th><th><?php echo $idioma['Orden']?></th><th></th></tr></thead>
		<?php
		foreach($obs as $m){$i++;
			?>
            <tr>
            	<td class="der"><?php echo $i?></td>
            	<td><?php echo $m['Nombre']?></td>
                <td><?php echo $tipo[$m['NivelObservacion']]?></td>
                <td><?php echo $m['Docente']?$idioma['Si']:$idioma['No']?></td>
                <td class="der"><?php echo $m['Posicion']?></td>
                <td>
                	<a href="#" class="btn btn-mini modificar" title="<?php echo $idioma['Modificar']?>" rel="<?php echo $m['CodObservacion']?>"><i class="icon-pencil"></i></a>
                    <?php if($m['Permanente']==0){?>
                    <a href="#" class="btn btn-mini eliminar" title="<?php echo $idioma['Eliminar']?>" rel="<?php echo $m['CodObservacion']?>"><i class="icon-remove"></i></a>
                    <?php }?>
                </td>
            </tr>
            <?php
		}
		?></table><?php
	}else{
	?><div class="alert alert-error"><?php echo $idioma['NoExisteObservacionesRegistrados']?></div><?php	
	}
	?>