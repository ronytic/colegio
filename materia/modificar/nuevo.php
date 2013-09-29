<?php
include_once("../../login/check.php");
if(isset($_POST)){
	$sino=array(1=>$idioma['Si'],0=>$idioma['No']);
	?>
    <h2><?php echo $idioma['NuevaMateria']?></h2>
    <form action="guardar.php" method="post" class="formulario">
    <input type="hidden" name="CodAnunciosLogin" value="<?php echo $CodAnunciosLogin?>">
    <table class="table table-bordered table-striped">
    	<tr>
        	<td><?php echo $idioma['Nombre']?><br>
        	<input type="text" value="<?php echo $mat['Nombre']?>" name="Nombre" class="span12" placeholder=""></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['Abreviado']?><br>
        	<input type="text" value="<?php echo $mat['Abreviado']?>" name="Abreviado" class="span12" placeholder=""></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['NombreAlterno']?> 1<br>
        	<input type="text" value="<?php echo $mat['NombreAlterno1']?>" name="NombreAlterno1" class="span12" placeholder=""></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['NombreAlterno']?> 2<br>
        	<input type="text" value="<?php echo $mat['NombreAlterno2']?>" name="NombreAlterno2" class="span12" placeholder=""></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['PromedioCiencias']?><br>
            <?php campo("PromedioCiencias","select",$sino,"span12",1,"",0,"",$mat['PromedioCiencias'])?>
            <small><?php echo $idioma['NotaPromedioCiencias']?></small>
        	</td>
        </tr>
        <tr>
        	<td><?php echo $idioma['Valido']?><br>
            <?php campo("Valido","select",$sino,"span12",1,"",0,"",$mat['Valido'])?>
            <small><?php echo $idioma['NotaValido']?></small>
        	</td>
        </tr>
        <tr>
        	<td><?php echo $idioma['Orden']?><br>
        	<input type="text" value="<?php echo $mat['Posicion']?>" name="Posicion" class="span12" placeholder=""></td>
        </tr>
        <tr>
        	<td><input type="submit" class="btn btn-success" value="<?php echo $idioma['Guardar']?>"></td>
        </tr>
    </table></form>
    <?php
}
?>