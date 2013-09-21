<?php
include_once("../../login/check.php");
include_once("../../class/cursoarea.php");
$cursoarea=new cursoarea;
$cur=$cursoarea->mostrarAreas();
    if(count($cur)){
		?><a href="#" class="btn btn-mini btn-success" id="exportarexcel"><?php echo $idioma['ExportarExcel']?></a>
        <table class="table table-bordered table-striped table-hover table-condensed">
		<thead><tr><th>N</th><th><?php echo $idioma['Nombre']?></th><th><?php echo sacarTooltip($idioma['Abreviado'],"","R",5)?></th><th><?php echo $idioma['Area']?></th><th><?php echo $idioma['Posicion']?></th></tr></thead>
		<?php
		foreach($cur as $c){$i++;
			switch($c['Area']){
				case 1:{$Area=$idioma['EducacionInicial'];}break;
				case 2:{$Area=$idioma['Primaria'];}break;
				case 3:{$Area=$idioma['Secundaria'];}break;
				case 4:{$Area=$idioma['EducacionSuperior'];}break;	
			}
			?>
            <tr>
            	<td class="der"><?php echo $i?></td>
            	<td><?php echo $c['Nombre']?></td>
                <td><?php echo $c['Abreviado']?></td>
                <td><?php echo $Area ?></td>
                <td><?php echo $c['Posicion']?></td>
                <td><a href="#" class="btn btn-mini modificar" title="<?php echo $idioma['Modificar']?>" rel="<?php echo $c['CodCursoArea']?>"><i class="icon-pencil"></i></a><a href="#" class="btn btn-mini eliminar" title="<?php echo $idioma['Eliminar']?>" rel="<?php echo $c['CodCursoArea']?>"><i class="icon-remove"></i></a></td>
            </tr>
            <?php
		}
		?></table><?php
	}else{
	?><div class="alert alert-error"><?php echo $idioma['NoExisteCursosRegistrados']?></div><?php	
	}
	?>