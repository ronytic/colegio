<?php
include_once("../../login/check.php");
if(isset($_POST)){
	include_once("../../class/curso.php");
	include_once("../../class/cursoarea.php");
	$curso=new curso;
	$cursoarea=new cursoarea;
	$CodCurso=$_POST['CodCurso'];
	$cur=$curso->mostrarCurso($CodCurso);
	$cur=array_shift($cur);
	$curarea=todoLista($cursoarea->mostrarTodoRegistro(),"CodCursoArea","Nombre");
	for($i=1;$i<=4;$i++){
		$datos[$i]=$i;	
	}
	?>
    <h2><?php echo $idioma['NuevoMensaje']?></h2>
    <form action="guardar.php" method="post" class="formulario">
    <input type="hidden" name="CodCurso" value="<?php echo $CodCurso?>">
    <table class="table table-bordered table-striped">
    	<tr>
        	<td><?php echo $idioma['Mensaje']?><br>
        	<input type="text" value="<?php echo $cur['Nombre']?>" name="Mensaje" class="span12" placeholder=""></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['Resaltar']?><br>
            <?php campo("Dps","select",array("1"=>$idioma["Si"],"0"=>$idioma["No"]),"span12",1,"",0,"",0)?>
        	</td>
        </tr>
        
        <tr>
        	<td><input type="submit" class="btn btn-success" value="<?php echo $idioma['Guardar']?>"></td>
        </tr>
    </table></form>
    <?php
}
?>