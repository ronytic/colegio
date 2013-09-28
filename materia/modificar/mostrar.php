<?php
include_once("../../login/check.php");
include_once("../../class/materias.php");
$materias=new materias;
$mat=$materias->mostrarMaterias('all');
    if(count($mat)){
		?><a href="#" class="btn btn-mini btn-success" id="exportarexcel"><?php echo $idioma['ExportarExcel']?></a>
        <table class="table table-bordered table-striped table-hover table-condensed">
		<thead><tr><th>N</th><th><?php echo $idioma['Nombre']?></th><th><?php echo $idioma['Abreviado']?></th><th><?php echo $idioma['NombreAlterno']?></th><th><?php echo $idioma['NombreAlterno']?> 2</th><th></th></tr></thead>
		<?php
		foreach($mat as $m){$i++;
			switch($m['Tipo']){
				case "1":{$Tipo=$idioma['Error'];}break;
				case "2":{$Tipo=$idioma['Advertencia'];}break;
				case "3":{$Tipo=$idioma['Comunicado'];}break;
			}
			$usu=explode(",",$m['Usuarios']);
			?>
            <tr>
            	<td class="der"><?php echo $i?></td>
            	<td><?php echo $m['Nombre']?></td>
                <td><?php echo $m['Abreviado']?></td>
                <td class="der"><?php echo $Tipo?></td>
                <td><?php mostrarUsuarios($usu);?></td>
                <td>
                	<a href="#" class="btn btn-mini modificar" title="<?php echo $idioma['Modificar']?>" rel="<?php echo $m['CodNotificaciones']?>"><i class="icon-pencil"></i></a>
                    <a href="#" class="btn btn-mini eliminar" title="<?php echo $idioma['Eliminar']?>" rel="<?php echo $m['CodNotificaciones']?>"><i class="icon-remove"></i></a>
                </td>
            </tr>
            <?php
		}
		?></table><?php
	}else{
	?><div class="alert alert-error"><?php echo $idioma['NoExisteMensajesRegistrados']?></div><?php	
	}
	?>
	
    
<?php
function mostrarUsuarios($usu){
	global $idioma;
	if(in_array("1",$usu)){
		?><span class="label label-info" title="<?php echo $idioma['TodoAdministradores']?>"><?php echo recortarTexto($idioma['Administradores'],1,"")?></span><?php	
	}
	if(in_array("2",$usu)){
		?><span class="label label-info" title="<?php echo $idioma['TodoDirectores']?>"><?php echo recortarTexto($idioma['Directores'],1,"")?></span><?php	
	}
	if(in_array("3",$usu)){
		?><span class="label label-info" title="<?php echo $idioma['TodoDocentes']?>"><?php echo recortarTexto($idioma['Docentes'],1,"")?></span><?php	
	}
	if(in_array("4",$usu)){
		?><span class="label label-info" title="<?php echo $idioma['TodosSecretarias']?>"><?php echo recortarTexto($idioma['Secretaria'],1,"")?></span><?php	
	}
	if(in_array("5",$usu)){
		?><span class="label label-info" title="<?php echo $idioma['TodoRegentes']?>"><?php echo recortarTexto($idioma['Regentes'],1,"")?></span><?php	
	}
	if(in_array("6",$usu)){
		?><span class="label label-info" title="<?php echo $idioma['TodoPadresFamilia']?>"><?php echo recortarTexto($idioma['PadreFamilia'],1,"")?></span><?php	
	}
	if(in_array("7",$usu)){
		?><span class="label label-info" title="<?php echo $idioma['TodoAlumnos']?>"><?php echo recortarTexto($idioma['Alumnos'],1,"")?></span><?php	
	}
}
?>