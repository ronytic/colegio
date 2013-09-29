<?php
include_once("../../login/check.php");
if(!empty($_POST['CodUsuario'])){
	$CodUsuario=$_POST['CodUsuario'];
	include_once("../../class/usuario.php");
	$usuario=new usuario;

	$usua=$usuario->mostrarDatos($CodUsuario);
	$usua=array_shift($usua);
	
	$valoridioma=array("es"=>"Castellano","ay"=>'Aymara',"qu"=>"Quechua","gu"=>'Guarani',"en"=>'Ingles');
	if($_SESSION['Nivel']=="1"){
		$tipo['1']=$idioma['Administrador'];
	}
	$tipo["2"]=$idioma['Director'];
	$tipo["4"]=$idioma['Secretaria'];
	$tipo["5"]=$idioma['Regente'];
	
	$sino=array(0=>$idioma['No'],1=>$idioma['Si']);
	//$curarea=array_shift($curarea);
	?>
    <h2><?php echo $idioma['ModificarUsuario']?></h2>
    <form action="actualizar.php" method="post" class="formulario">
    <input type="hidden" name="CodUsuario" value="<?php echo $CodUsuario?>">
    <table class="table table-bordered table-striped">
    	<tr>
        	<td><?php echo $idioma['Paterno']?><br>
        	<input type="text" value="<?php echo $usua['Paterno']?>" name="Paterno" class="span12" placeholder=""></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['Materno']?><br>
        	<input type="text" value="<?php echo $usua['Materno']?>" name="Materno" class="span12" placeholder=""></td>
        </tr>
    	<tr>
        	<td><?php echo $idioma['Nombres']?><br>
        	<input type="text" value="<?php echo $usua['Nombres']?>" name="Nombres" class="span12" placeholder=""></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['NivelUsuario']?><br>
            <?php campo("Nivel","select",$tipo,"span12",1,"",0,"",$usua['Nivel'])?>
            </td>
        </tr>
        <tr>
        	<td><?php echo $idioma['Usuario']?><br>
        	<input type="text" value="<?php echo $usua['Usuario']?>" name="Usuario" class="span12" placeholder=""></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['Contrasena']?><br>
        	<input type="text" value="" name="Pass" class="span12" placeholder="">
            <small><?php echo $idioma['NotaContrasena']?></small></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['Apodo']?><br>
        	<input type="text" value="<?php echo $usua['Nick']?>" name="Nick" class="span12" placeholder=""></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['Ci']?><br>
        	<input type="text" value="<?php echo $usua['Ci']?>" name="Ci" class="span12" placeholder=""></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['Direccion']?><br>
        	<input type="text" value="<?php echo $usua['Direccion']?>" name="Direccion" class="span12" placeholder=""></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['Telefono']?><br>
        	<input type="text" value="<?php echo $usua['Telefono']?>" name="Telefono" class="span12" placeholder=""></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['Celular']?><br>
        	<input type="text" value="<?php echo $usua['Celular']?>" name="Celular" class="span12" placeholder=""></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['Observacion']?><br>
        	<input type="text" value="<?php echo $usua['Observacion']?>" name="Observacion" class="span12" placeholder=""></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['Idioma']?><br>
            <?php campo("Idioma","select",$valoridioma,"span12",1,"",0,"",$usua['Idioma'])?>
        	</td>
        </tr>
        <tr>
        	<td><?php echo $idioma['Habilitado']?><br>
            <?php campo("Activo","select",$sino,"span12",1,"",0,"",$usua['Activo'])?>
        	</td>
        </tr>
        <tr>
        	<td><input type="submit" class="btn btn-success" value="<?php echo $idioma['Guardar']?>"></td>
        </tr>
    </table></form>
    <?php
}
?>