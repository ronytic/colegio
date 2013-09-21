<?php
include_once("../../login/check.php");
if(!empty($_POST['CodCursoArea'])){
	include_once("../../class/curso.php");
	include_once("../../class/cursoarea.php");
	$curso=new curso;
	$cursoarea=new cursoarea;
	$CodCursoArea=$_POST['CodCursoArea'];
	$cur=$cursoarea->mostrarArea($CodCursoArea);
	$cur=array_shift($cur);
	//$curarea=todoLista($cursoarea->mostrarTodoRegistro(),"CodCursoArea","Nombre");
	/*for($i=1;$i<=4;$i++){
		$datos[$i]=$i;	
	}*/

	$curarea=array("1"=>$idioma['EducacionInicial'],"2"=>$idioma['Primaria'],"3"=>$idioma['Secundaria'],"4"=>$Area=$idioma['EducacionSuperior']);
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
        	<td><?php echo $idioma['Area']?><br>
            <?php campo("Area","select",$curarea,"span12",1,"",0,"",$cur['Area'])?>
        	</td>
        </tr>
        <tr>
        	<td><?php echo $idioma['Orden']?><br>
            <?php campo("Posicion","text",$cur['Posicion'],"span12",1,"",0,"",$cur['Dps'])?>
        	<small><?php echo $idioma['DescripcionOrden']?></small>
            </td>
        </tr>
        <tr><td class="resaltar"><hr class="separador"><br><?php echo $idioma['HorarioAsistencia']?></td></tr>
        <tr>
        	<td><?php echo $idioma['HoraEntradaLunes']?><br>
        	<input type="time" value="<?php echo $cur['HoraInicioL']?>" name="NotaTope" class="span12"></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['HoraLimiteEsperaLunes']?><br>
        	<input type="time" value="<?php echo $cur['HoraEsperaL']?>" name="NotaTope" class="span12"></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['HoraEntradaLunes']?><br>
        	<input type="time" value="<?php echo $cur['HoraInicioL']?>" name="NotaTope" class="span12"></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['HoraLimiteEsperaLunes']?><br>
        	<input type="time" value="<?php echo $cur['HoraEsperaL']?>" name="NotaTope" class="span12"></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['HoraEntradaLunes']?><br>
        	<input type="time" value="<?php echo $cur['HoraInicioL']?>" name="NotaTope" class="span12"></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['HoraLimiteEsperaLunes']?><br>
        	<input type="time" value="<?php echo $cur['HoraEsperaL']?>" name="NotaTope" class="span12"></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['HoraEntradaLunes']?><br>
        	<input type="time" value="<?php echo $cur['HoraInicioL']?>" name="NotaTope" class="span12"></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['HoraLimiteEsperaLunes']?><br>
        	<input type="time" value="<?php echo $cur['HoraEsperaL']?>" name="NotaTope" class="span12"></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['HoraEntradaLunes']?><br>
        	<input type="time" value="<?php echo $cur['HoraInicioL']?>" name="NotaTope" class="span12"></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['HoraLimiteEsperaLunes']?><br>
        	<input type="time" value="<?php echo $cur['HoraEsperaL']?>" name="NotaTope" class="span12"></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['HoraEntradaLunes']?><br>
        	<input type="time" value="<?php echo $cur['HoraInicioL']?>" name="NotaTope" class="span12"></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['HoraLimiteEsperaLunes']?><br>
        	<input type="time" value="<?php echo $cur['HoraEsperaL']?>" name="NotaTope" class="span12"></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['HoraEntradaLunes']?><br>
        	<input type="time" value="<?php echo $cur['HoraInicioL']?>" name="NotaTope" class="span12"></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['HoraLimiteEsperaLunes']?><br>
        	<input type="time" value="<?php echo $cur['HoraEsperaL']?>" name="NotaTope" class="span12"></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['NotaAprobacion']?><br>
        	<input type="text" value="<?php echo $cur['NotaAprobacion']?>" name="NotaAprobacion" class="span12"></td>
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