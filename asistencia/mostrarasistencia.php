<?php
include_once("../login/check.php");
include_once("../class/asistencia.php");
include_once("../class/alumno.php");
include_once("../class/curso.php");
$FechaActual=date("Y-m-d");
$asistencia=new asistencia;
$alumno=new alumno;
$curso=new curso;
$asis=$asistencia->mostrarFecha($FechaActual);
if(count($asis)){$i=count($asis)+1;
	?>
    <table class="table table-condensed table-hover table-striped table-bordered">
    	<thead><tr><th>N</th><th><?php echo $idioma['Nombres']?></th><th><?php echo $idioma['Hora']?></th><th><?php echo $idioma['Estado']?></th></tr></thead>
        <?php foreach($asis as $a){$i--;
			$al=$alumno->mostrarTodoDatos($a['CodAlumno']);
			$al=array_shift($al);
			$cur=$curso->mostrarCurso($al['CodCurso']);
			?><tr>
            	<td class="der"><?php echo $i?></td>
                <td><?php echo capitalizar($al['Paterno']." ".acortarPalabra($al['Nombres'],1))?></td>
                <td><?php echo ($a['HoraRegistro'])?></td>
                <td><?php switch($a['Tipo']){
						case "C":{?><span class="badge badge-success"><?php echo $idioma['Asistencia']?></span><?php }break;
						case "A":{?><span class="badge badge-warning"><?php echo $idioma['Atraso']?></span><?php }break;
					}?></td>
			</tr><?php
		}?>
    </table>
    <?php	
}else{
	?><div class="alert alert-danger"><?php echo $idioma['NoExisteAsistentes']?></div>
    <?php	
}
?>