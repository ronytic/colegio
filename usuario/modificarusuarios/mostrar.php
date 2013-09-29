<?php
include_once("../../login/check.php");
include_once("../../class/usuario.php");
$usuario=new usuario;
if($_SESSION['Nivel']!="1"){
	$us=$usuario->mostrarUsuarios("Nivel!=1");
}else{
	$us=$usuario->mostrarUsuarios("");	
}
$tipo=array("1"=>$idioma['Administrador'],"2"=>$idioma['Director'],"4"=>$idioma['Secretaria'],"5"=>$idioma['Regente']);
    if(count($us)){
		?><a href="#" class="btn btn-mini btn-success" id="exportarexcel"><?php echo $idioma['ExportarExcel']?></a>
        <table class="table table-bordered table-striped table-hover table-condensed">
		<thead><tr><th>N</th><th><?php echo $idioma['Paterno']?></th><th><?php echo $idioma['Materno']?></th><th><?php echo $idioma['Nombre']?></th><th><?php echo $idioma['Ci']?></th><th><?php echo $idioma['NivelUsuario']?></th><th></th></tr></thead>
		<?php
		foreach($us as $m){$i++;
			?>
            <tr>
            	<td class="der"><?php echo $i?></td>
                <td><?php echo $m['Paterno']?></td>
                <td><?php echo $m['Materno']?></td>
                <td><?php echo $m['Nombres']?></td>
                <td><?php echo $m['Ci']?></td>
                <td><?php echo $tipo[$m['Nivel']]?></td>
                <td>
                	<a href="#" class="btn btn-mini modificar" title="<?php echo $idioma['Modificar']?>" rel="<?php echo $m['CodUsuario']?>"><i class="icon-pencil"></i></a>
                    <?php if($m['Permanente']==0){?>
                    <a href="#" class="btn btn-mini eliminar" title="<?php echo $idioma['Eliminar']?>" rel="<?php echo $m['CodUsuario']?>"><i class="icon-remove"></i></a>
                    <?php }?>
                </td>
            </tr>
            <?php
		}
		?></table><?php
	}else{
	?><div class="alert alert-error"><?php echo $idioma['NoExisteUsuariosRegistrados']?></div><?php	
	}
	?>