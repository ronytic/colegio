<?php
include_once("../../login/check.php");
if(isset($_POST)){
	?>
    <h2><?php echo $idioma['NuevoMensaje']?></h2>
    <form action="guardar.php" method="post" class="formulario">
    <input type="hidden" name="CodAnunciosLogin" value="<?php echo $CodAnunciosLogin?>">
    <table class="table table-bordered table-striped">
    	<tr>
        	<td><?php echo $idioma['Mensaje']?><br>
        	<textarea value="" name="Mensaje" class="span12" placeholder="" rows="5"><?php echo $men['Mensaje']?></textarea></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['Resaltar']?><br>
            <?php campo("Resaltar","select",array("1"=>$idioma["Si"],"0"=>$idioma["No"]),"span12",1,"",0,"",0)?>
        	</td>
        </tr>
        
        <tr>
        	<td><input type="submit" class="btn btn-success" value="<?php echo $idioma['Guardar']?>"></td>
        </tr>
    </table></form>
    <?php
}
?>