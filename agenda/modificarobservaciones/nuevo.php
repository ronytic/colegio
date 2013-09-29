<?php
include_once("../../login/check.php");
if(isset($_POST)){
	$sino=array(1=>$idioma['Si'],0=>$idioma['No']);
	$tipo=array("1"=>$idioma['Observacion'],"2"=>$idioma['Faltas'],"3"=>$idioma['Atrasos'],"4"=>$idioma['Licencias'],"5"=>$idioma['NotificacionPadres'],"6"=>$idioma['NoRespondeTelf'],"7"=>$idioma['Felicitaciones']);
	?>
    <h2><?php echo $idioma['NuevaObservacion']?></h2>
    <form action="guardar.php" method="post" class="formulario">
    <table class="table table-bordered table-striped">
    	<tr>
        	<td><?php echo $idioma['Nombre']?><br>
        	<input type="text" value="<?php echo $obs['Nombre']?>" name="Nombre" class="span12" placeholder=""></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['TipoObservacion']?><br>
            <?php campo("NivelObservacion","select",$tipo,"span12",1,"",0,"",$obs['NivelObservacion'])?>
            <small><?php echo $idioma['NotaTipoObservacion']?></small>
        	</td>
        </tr>
        <tr>
        	<td><?php echo $idioma['MostrarDocente']?><br>
            <?php campo("Docente","select",$sino,"span12",1,"",0,"",$obs['Docente'])?>
            <small><?php echo $idioma['NotaMostrarDocente']?></small>
        	</td>
        </tr>
        <tr>
        	<td><?php echo $idioma['Orden']?><br>
        	<input type="text" value="<?php echo $obs['Posicion']?>" name="Posicion" class="span12" placeholder=""></td>
        </tr>
        <tr>
        	<td><input type="submit" class="btn btn-success" value="<?php echo $idioma['Guardar']?>"></td>
        </tr>
    </table></form>
    <?php
}
?>