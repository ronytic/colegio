<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="NModificarCurso";
include_once("../../class/curso.php");
$curso=new curso;
$cur=$curso->mostrar();
include_once($folder."cabecerahtml.php");
?>
<?php include_once($folder."cabecera.php");?>
<div class="span8 box">
	<div class="box-header"><h2><?php echo $idioma['ListadoCursos']?></h2></div>
    <div class="box-content">
    <?php
    if(count($cur)){
		?><table class="table table-bordered table-striped table-hover table-condensed">
		<thead><tr><th>N</th><th><?php echo $idioma['Nombre']?></th><th><?php echo sacarTooltip($idioma['Abreviado'],"","R",5)?></th><th><?php echo sacarTooltip($idioma['Bimestre'],"","R",3)?></th><th><?php echo $idioma['Dps']?></th><th><?php echo $idioma['NotaTope']?></th><th><?php echo sacarTooltip($idioma['NotaAprobacion'])?></th><th><?php echo sacarTooltip($idioma['CantidadEtapas'])?></th><th></th></tr></thead>
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
                <td><a href="#" class="btn btn-mini" title="<?php echo $idioma['Modificar']?>"><i class="icon-pencil"></i></a><a href="#" class="btn btn-mini" title="<?php echo $idioma['Eliminar']?>"><i class="icon-remove"></i></a></td>
            </tr>
            <?php
		}
		?></table><?php
	}else{
	?><div class="alert alert-error"><?php echo $idioma['NoExisteCursosRegistrados']?></div><?php	
	}
	?>
    </div>
</div>
<div class="span4 box">
	<div class="box-header"><h2><?php echo $idioma['Configuracion']?></h2></div>
    <div class="box-content">
    
    </div>
</div>
<?php include_once($folder."pie.php");?>