<?php
include_once("../../login/check.php");
if(isset($_POST)){
	$paraquien=array(1=>$idioma['TodoAdministradores'],2=>$idioma['TodoDirectores'],3=>$idioma['TodoDocentes'],4=>$idioma['TodosSecretarias'],5=>$idioma['TodoRegentes'],6=>$idioma['TodoPadresFamilia'],7=>$idioma['TodoAlumnos']);
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
        	<td><?php echo $idioma['TipoMensaje']?><br>
            <?php campo("Tipo","select",array("1"=>$idioma["Error"],"2"=>$idioma["Advertencia"],"3"=>$idioma["Comunicado"]),"span12",1,"",0,"",$men['Resaltar'])?>
        	</td>
        </tr>
        <tr>
        	<td><?php echo $idioma['ParaQuien']?><br>
            <select name="Usuarios[]" id="Usuario" multiple="multiple" required>
                    
                    <?php foreach($paraquien as $pqk=>$pqv){?>
                    	<option value="<?php echo $pqk?>"<?php echo $pqk==0?'selected':''?>><?php echo $pqv?></option>
                	<?php }?>
                	</select>
        	</td>
        </tr>
        
        <tr>
        	<td><input type="submit" class="btn btn-success" value="<?php echo $idioma['Guardar']?>"></td>
        </tr>
    </table></form>
    <?php
}
?>