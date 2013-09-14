<?php
include_once("../../login/check.php");
if(!empty($_POST['CodAnunciosLogin'])){
	include_once("../../class/anuncioslogin.php");
	include_once("../../class/cursoarea.php");
	$anuncioslogin=new anuncioslogin;

	$men=$anuncioslogin->CodAnunciosLogin($CodAnunciosLogin);
	$men=array_shift($men);

	//$curarea=array_shift($curarea);
	?>
    <h2><?php echo $idioma['Modificar']?></h2>
    <form action="actualizar.php" method="post" class="formulario">
    <input type="hidden" name="CodCurso" value="<?php echo $CodCurso?>">
    <table class="table table-bordered table-striped">
    	<tr>
        	<td><?php echo $idioma['Mensaje']?><br>
        	<input type="text" value="<?php echo $men['Mensaje']?>" name="Mensaje" class="span12" placeholder=""></td>
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