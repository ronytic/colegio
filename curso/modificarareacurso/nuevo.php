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
    <h2><?php echo $idioma['NuevaAreaCurso']?></h2>
    <form action="guardar.php" method="post" class="formulario">
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
            <?php campo("Posicion","text",$cur['Posicion'],"span12",1,"",0,"")?>
        	<small><?php echo $idioma['DescripcionOrden']?></small>
            </td>
        </tr>
        <tr><td class="resaltar"><hr class="separador"><br><?php echo $idioma['HorarioAsistencia']?></td></tr>
        <tr>
        	<td><?php echo $idioma['HoraEntradaLunes']?><br>
        	<input type="time" value="<?php echo $cur['HoraInicioL']?>" name="HoraInicioL" class="span12"></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['HoraLimiteEsperaLunes']?><br>
        	<input type="time" value="<?php echo $cur['HoraEsperaL']?>" name="HoraEsperaL" class="span12"></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['HoraEntradaMartes']?><br>
        	<input type="time" value="<?php echo $cur['HoraInicioM']?>" name="HoraInicioM" class="span12"></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['HoraLimiteEsperaMartes']?><br>
        	<input type="time" value="<?php echo $cur['HoraEsperaM']?>" name="HoraEsperaM" class="span12"></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['HoraEntradaMiercoles']?><br>
        	<input type="time" value="<?php echo $cur['HoraInicioMi']?>" name="HoraInicioMi" class="span12"></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['HoraLimiteEsperaMiercoles']?><br>
        	<input type="time" value="<?php echo $cur['HoraEsperaMi']?>" name="HoraEsperaMi" class="span12"></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['HoraEntradaJueves']?><br>
        	<input type="time" value="<?php echo $cur['HoraInicioJ']?>" name="HoraInicioJ" class="span12"></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['HoraLimiteEsperaJueves']?><br>
        	<input type="time" value="<?php echo $cur['HoraEsperaJ']?>" name="HoraEsperaJ" class="span12"></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['HoraEntradaViernes']?><br>
        	<input type="time" value="<?php echo $cur['HoraInicioV']?>" name="HoraInicioV" class="span12"></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['HoraLimiteEsperaViernes']?><br>
        	<input type="time" value="<?php echo $cur['HoraEsperaV']?>" name="HoraEsperaV" class="span12"></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['HoraEntradaSabado']?><br>
        	<input type="time" value="<?php echo $cur['HoraInicioS']?>" name="HoraInicioS" class="span12"></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['HoraLimiteEsperaSabado']?><br>
        	<input type="time" value="<?php echo $cur['HoraEsperaS']?>" name="HoraEsperaS" class="span12"></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['HoraEntradaDomingo']?><br>
        	<input type="time" value="<?php echo $cur['HoraInicioD']?>" name="HoraInicioD" class="span12"></td>
        </tr>
        <tr>
        	<td><?php echo $idioma['HoraLimiteEsperaDomingo']?><br>
        	<input type="time" value="<?php echo $cur['HoraEsperaD']?>" name="HoraEsperaD" class="span12"></td>
        </tr>
        <tr>
        	<td><input type="submit" class="btn btn-success" value="<?php echo $idioma['Actualizar']?>"></td>
        </tr>
    </table></form>
    <?php
}
?>