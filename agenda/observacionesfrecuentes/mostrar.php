<?php
include_once("../../login/check.php");
include_once("../../class/anuncioslogin.php");
include_once("../../class/observacionesfrecuentes.php");
$observacionesfrecuentes=new observacionesfrecuentes;
$men=$observacionesfrecuentes->mostrarObservaciones();
    if(count($men)){
		?><a href="#" class="btn btn-mini btn-success" id="exportarexcel"><?php echo $idioma['ExportarExcel']?></a>
        <table class="table table-bordered table-striped table-hover table-condensed">
		<thead><tr><th>N</th><th><?php echo $idioma['Nombre']?></th><th><?php echo $idioma['ValorObservacion']?></th><th></th></tr></thead>
		<?php
		foreach($men as $m){$i++;
			?>
            <tr>
            	<td class="der"><?php echo $i?></td>
            	<td><?php echo $m['Nombre']?></td>
                <td><?php echo $m['Valor']?></td>
                <td><a href="#" class="btn btn-mini modificar" title="<?php echo $idioma['Modificar']?>" rel="<?php echo $m['CodObservacionesFrecuentes']?>"><i class="icon-pencil"></i></a><a href="#" class="btn btn-mini eliminar" title="<?php echo $idioma['Eliminar']?>" rel="<?php echo $m['CodObservacionesFrecuentes']?>"><i class="icon-remove"></i></a></td>
            </tr>
            <?php
		}
		?></table><?php
	}else{
	?><div class="alert alert-error"><?php echo $idioma['NoExisteMensajesRegistrados']?></div><?php	
	}
	?>