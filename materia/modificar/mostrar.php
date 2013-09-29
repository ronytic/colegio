<?php
include_once("../../login/check.php");
include_once("../../class/materias.php");
$materias=new materias;
$mat=$materias->mostrarMaterias('all');
    if(count($mat)){
		?><a href="#" class="btn btn-mini btn-success" id="exportarexcel"><?php echo $idioma['ExportarExcel']?></a>
        <table class="table table-bordered table-striped table-hover table-condensed">
		<thead><tr><th>N</th><th><?php echo $idioma['Nombre']?></th><th><?php echo $idioma['Abreviado']?></th><th><?php echo $idioma['NombreAlterno']?>1</th><th><?php echo $idioma['NombreAlterno']?>2</th><th><?php echo $idioma['Valido']?></th><th><?php echo $idioma['PromedioCiencias']?></th><th></th></tr></thead>
		<?php
		foreach($mat as $m){$i++;
			?>
            <tr>
            	<td class="der"><?php echo $i?></td>
            	<td><?php echo $m['Nombre']?></td>
                <td><?php echo $m['Abreviado']?></td>
                <td><?php echo $m['NombreAlterno1']?></td>
                <td><?php echo $m['NombreAlterno2']?></td>
                <td><?php echo $m['PromedioCiencias']?$idioma['Si']:$idioma['No']?></td>
                <td><?php echo $m['Valido']?$idioma['Si']:$idioma['No']?></td>
                <td>
                	<a href="#" class="btn btn-mini modificar" title="<?php echo $idioma['Modificar']?>" rel="<?php echo $m['CodMateria']?>"><i class="icon-pencil"></i></a>
                    <?php if($m['Permanente']==0){?>
                    <a href="#" class="btn btn-mini eliminar" title="<?php echo $idioma['Eliminar']?>" rel="<?php echo $m['CodMateria']?>"><i class="icon-remove"></i></a>
                    <?php }?>
                </td>
            </tr>
            <?php
		}
		?></table><?php
	}else{
	?><div class="alert alert-error"><?php echo $idioma['NoExisteMensajesRegistrados']?></div><?php	
	}
	?>