<?php
include_once("../../login/check.php");
if(!empty($_POST['CodAnunciosLogin'])){
	$CodAnunciosLogin=$_POST['CodAnunciosLogin'];
	include_once("../../class/anuncioslogin.php");
	include_once("../../class/cursoarea.php");
	$anuncioslogin=new anuncioslogin;

	$men=$anuncioslogin->mostrarAnuncio($CodAnunciosLogin);
	$men=array_shift($men);

	//$curarea=array_shift($curarea);
	?>
    <h2><?php echo $idioma['Modificar']?></h2>
    <form action="actualizar.php" method="post" class="formulario">
    <input type="hidden" name="CodAnunciosLogin" value="<?php echo $CodAnunciosLogin?>">
    <table class="table table-bordered table-striped">
    	<tr>
        	<td><?php echo $idioma['Mensaje']?><br>
        	<textarea value="" name="Mensaje" class="span12" placeholder="" rows="5"><?php echo $men['Mensaje']?></textarea></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['Resaltar']?><br>
            <?php campo("Resaltar","select",array("1"=>$idioma["Si"],"0"=>$idioma["No"]),"span12",1,"",0,"",$men['Resaltar'])?>
        	</td>
        </tr>
        
        <tr>
        	<td><input type="submit" class="btn btn-success" value="<?php echo $idioma['Guardar']?>"></td>
        </tr>
    </table></form>
    <?php
}
?>