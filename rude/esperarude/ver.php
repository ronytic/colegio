<?php
include_once("../../login/check.php");
$Fecha=$_POST['Fecha'];
$Estado=$_POST['Estado'];
include_once("../../class/tmpcola.php");
include_once("../../class/alumno.php");
include_once("../../class/curso.php");
$tmpcola=new tmpcola;
$alumno=new alumno;
$curso=new curso;
$Estado=$Estado!=""?"Estado LIKE '$Estado'":"Estado LIKE '%'";
$tmp=$tmpcola->mostrarEspera("FechaRegistro='".fecha2Str($Fecha,0)."' and $Estado");
if(count($tmp)){
	$i=0;
	?>
    <table class="table table-hover table-bordered table-striped">
    <thead>
    	<tr>
        	<th>N</th><th><?php echo $idioma['Paterno'];?></th><th><?php echo $idioma['Materno'];?></th><th><?php echo $idioma['Nombres'];?></th><th><?php echo $idioma['Curso'];?></th><th><?php echo $idioma['Hora'];?></th><th><?php echo $idioma['Estado'];?></th><th><?php echo $idioma['Acciones'];?></th>
        </tr>
    </thead>
    <?php
	foreach($tmp as $t){$i++;
		$al=$alumno->mostrarTodoDatos($t['CodAlumno']);
		$al=array_shift($al);
		$cur=$curso->mostrarCurso($al['CodCurso']);
		$cur=array_shift($cur);
		$badge=$t['Estado']=="Espera"?"badge-success":"badge-warning";
		?>
        <tr>
        	<td class="der"><?php echo $i?></td>
            <td><?php echo capitalizar($al['Paterno'])?></td>
            <td><?php echo capitalizar($al['Materno'])?></td>
            <td><?php echo capitalizar($al['Nombres'])?></td>
            <td><?php echo capitalizar($cur['Nombre'])?></td>
            <td><?php echo capitalizar($t['HoraRegistro'])?></td>
            <td><span class="badge <?php echo $badge?>"><?php echo capitalizar($t['Estado'])?></span></td>
            <td>
            	<a href="redirigir.php?Ruta=../editarrude&CodAlumno=<?php echo $t['CodAlumno']?>" class="btn btn-small" target="_blank"><?php echo $idioma['RevisarRude']?></a>
                <a href="redirigir.php?Ruta=../../sms/revisardatos&CodAlumno=<?php echo $t['CodAlumno']?>" class="btn btn-small" target="_blank" title="<?php echo $idioma['RevisarCelularEnvioMensajes']?>"><?php echo $idioma['RevisarCelular']?></a>
                <a href="redirigir.php?Ruta=../../alumno/boletadatos&CodAlumno=<?php echo $t['CodAlumno']?>" class="btn btn-small" target="_blank" title="<?php echo $idioma['RevisarCelularEnvioMensajes']?>"><?php echo $idioma['ImprimirDatos']?></a>
                </td>
        </tr>
        <?php
	}
	?>
    </table>
    <?php
}else{
	?>
    <div class="alert alert-info">
	<?php echo $idioma['NoExistenRegistro'];?>
    </div>
    <?php
}
?>