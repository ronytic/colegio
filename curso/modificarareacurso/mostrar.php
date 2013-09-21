<?php
include_once("../../login/check.php");
include_once("../../class/cursoarea.php");
$cursoarea=new cursoarea;
$cur=$cursoarea->mostrarAreas();
    if(count($cur)){
		?><a href="#" class="btn btn-mini btn-success" id="exportarexcel"><?php echo $idioma['ExportarExcel']?></a>
        <table class="table table-bordered table-striped table-hover table-condensed">
		<thead><tr><th>N</th><th><?php echo $idioma['Nombre']?></th><th><?php echo sacarTooltip($idioma['Abreviado'],"","R",5)?></th><th><?php echo sacarTooltip($idioma['Area'],"","R",3)?></th><th><?php echo $idioma['Dps']?></th><th><?php echo $idioma['NotaTope']?></th><th><?php echo sacarTooltip($idioma['NotaAprobacion'])?></th><th><?php echo sacarTooltip($idioma['CantidadEtapas'])?></th><th></th></tr></thead>
		<?php
		foreach($cur as $c){$i++;
			?>
            <tr>
            	<td class="der"><?php echo $i?></td>
            	<td><?php echo $c['Nombre']?></td>
                <td><?php echo $c['Abreviado']?></td>
                <td><?php echo $c['Bimestre']?$idioma['Si']:$idioma['No'] ?></td>
                <td><?php echo $c['Dps']?$idioma['Si']:$idioma['No'] ?></td>
                <td class="der"><?php echo $c['NotaTope']?></td>
                <td class="der"><?php echo $c['NotaAprobacion']?></td>
                <td class="der"><?php echo $c['CantidadEtapas']?></td>
                <td><a href="#" class="btn btn-mini modificar" title="<?php echo $idioma['Modificar']?>" rel="<?php echo $c['CodCurso']?>"><i class="icon-pencil"></i></a><a href="#" class="btn btn-mini eliminar" title="<?php echo $idioma['Eliminar']?>" rel="<?php echo $c['CodCurso']?>"><i class="icon-remove"></i></a></td>
            </tr>
            <?php
		}
		?></table><?php
	}else{
	?><div class="alert alert-error"><?php echo $idioma['NoExisteCursosRegistrados']?></div><?php	
	}
	?>