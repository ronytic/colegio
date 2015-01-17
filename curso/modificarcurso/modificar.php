<?php
include_once("../../login/check.php");
if(!empty($_POST['CodCurso'])){
	include_once("../../class/curso.php");
	include_once("../../class/config.php");
	include_once("../../class/cursoarea.php");
	$curso=new curso;
	$cursoarea=new cursoarea;
	$config=new config;
	$Moneda=$config->mostrarConfig("Moneda",1);
	$CodCurso=$_POST['CodCurso'];
	$cur=$curso->mostrarCurso($CodCurso);
	$cur=array_shift($cur);
	$curarea=todoLista($cursoarea->mostrarTodoRegistro(),"CodCursoArea","Nombre");
	for($i=1;$i<=4;$i++){
		$datos[$i]=$i;	
	}
	//$curarea=array_shift($curarea);
	?>
    <h2><?php echo $idioma['Modificar']?></h2>
    <form action="actualizar.php" method="post" class="formulario">
    <input type="hidden" name="CodCurso" value="<?php echo $CodCurso?>">
    <table class="table table-bordered table-striped">
    	<tr>
        	<td><?php echo $idioma['Nombre']?><br>
        	<input type="text" value="<?php echo $cur['Nombre']?>" name="Nombre" class="span12"></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['Abreviado']?><br>
        	<input type="text" value="<?php echo $cur['Abreviado']?>" name="Abreviado" class="span12"></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['AreaCurso']?><br>
            <?php campo("CodCursoArea","select",$curarea,"span12",1,"",0,"",$cur['CodCursoArea'])?>
        	</td>
        </tr>
        <tr>
        	<td><?php echo $idioma['Dps']?><br>
            <?php campo("Dps","select",array("1"=>$idioma["Si"],"0"=>$idioma["No"]),"span12",1,"",0,"",$cur['Dps'])?>
        	</td>
        </tr>
        <tr>
        	<td><?php echo $idioma['Bimestre']?><br>
            <?php campo("Bimestre","select",array("1"=>$idioma["Si"],"0"=>$idioma["No"]),"span12",1,"",0,"",$cur['Bimestre'])?>
        	</td>
        </tr>
        <tr>
        	<td><?php echo $idioma['NotaTope']?><br>
        	<input type="text" value="<?php echo $cur['NotaTope']?>" name="NotaTope" class="span12"></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['NotaAprobacion']?><br>
        	<input type="text" value="<?php echo $cur['NotaAprobacion']?>" name="NotaAprobacion" class="span12"></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['MontoCuotaPagar']?><br>
             <div class="input-append">
        	<input type="text" value="<?php echo $cur['MontoCuota']?>" name="MontoCuota" class="span12">
            <div class="add-on"><?php echo $Moneda?></div>
    </div></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['CantidadEtapas']?><br>
            <?php campo("CantidadEtapas","select",$datos,"span12",1,"",0,"",$cur['CantidadEtapas'])?><br>
            <small><?php echo $idioma['DescripcionEtapa']?></small>
        	</td>
        </tr>
        <tr>
        	<td><?php echo $idioma['Orden']?><br>
        	<input type="text" value="<?php echo $cur['Orden']?>" name="Orden" class="span12"><br>
            <small><?php echo $idioma['DescripcionOrden']?></small>
            </td>
        </tr>
        <tr>
        	<td><input type="submit" class="btn btn-success" value="<?php echo $idioma['Actualizar']?>"></td>
        </tr>
    </table></form>
    <?php
}
?>