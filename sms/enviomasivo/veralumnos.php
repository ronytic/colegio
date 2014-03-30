<?php
include_once("../../login/check.php");
$CodCurso=$_POST['CodCurso'];
include_once("../../class/alumno.php");
$alumno=new alumno;
include_once("../../class/curso.php");
$curso=new curso;
$cur=$curso->mostrarCurso($CodCurso);
$cur=array_shift($cur);
$al=$alumno->mostrarAlumnosCurso($CodCurso);
/*$al=array(
	array("Paterno"=>"Nombre1","CelularSMS"=>"73230568"),
	array("Paterno"=>"Nombre2","CelularSMS"=>"73230568"),
	array("Paterno"=>"Nombre3","CelularSMS"=>"73230568"),
	//array("Paterno"=>"Nombre4","CelularSMS"=>"73230568")	
);*/
$i=0;
?>

<table class="table table-bordered table-striped table-hover">
<thead>
<tr>
	<th colspan="2"><?php echo $idioma['Curso']?>:</th>
    <th colspan="4"><?php echo $cur['Nombre']?></th>
</tr>
<tr>
	<th>Nº</th>
	<th><?php echo $idioma['Paterno']?></th>
    <th><?php echo $idioma['Materno']?></th>
    <th><?php echo $idioma['Nombres']?></th>
    <th><?php echo $idioma['NumeroCelular']?></th>
    <th><?php echo $idioma['Estado']?></th>
</tr>
</thead>
<?php
foreach($al as $a){$i++;
	?>
    <tr>
    	<td class="der"><?php echo $i?></td>
        <td><?php echo capitalizar($a['Paterno']);?></td>
        <td><?php echo capitalizar($a['Materno']);?></td>
        <td><?php echo capitalizar($a['Nombres']);?></td>
        <td><input type="hidden" value="<?php echo $a['CelularSMS']?>" class="numeros" data-posicion="<?php echo $i?>" data-total="<?php echo count($al)?>"/>
			
		<?php echo capitalizar($a['CelularSMS']);?></td>
        <td><a class="EstadoMensaje btn btn-danger btn-mini enviarindependiente" data-posicion="<?php echo $i?>">
		
				<?php echo $idioma['NoEnviado'];?>
                
            </a></td>
    </tr>
    <?php
	
}
?>
</table>