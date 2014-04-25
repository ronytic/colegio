<?php
include_once("../../login/check.php");

include_once("../../class/curso.php");
include_once("../../class/docente.php");
include_once("../../class/materias.php");
include_once("../../class/registronotasexcel.php");
extract($_POST);
$curso=new curso;
$docente=new docente;
$materias=new materias;
$registronotasexcel=new registronotasexcel;
$CodDocente=$CodDocente!=""?"CodDocente='$CodDocente'":"CodDocente LIKE '%'";
$CodMateria=$CodMateria!=""?"CodMateria='$CodMateria'":"CodMateria LIKE '%'";
$CodCurso=$CodCurso!=""?"CodCurso='$CodCurso'":"CodCurso LIKE '%'";
$condicion="$CodDocente and $CodMateria and $CodCurso";
//echo $condicion;
$regnotasexcel=$registronotasexcel->mostrarTodoRegistro($condicion,1,"FechaRegistro");
?>
<?php
if(!count($regnotasexcel)){
?>
<div class="alert alert-info"><?php echo $idioma['NoExisteRegistro']?></div>
<?php
exit();	
}
$i=0;
?>
<a href="#" id="exportarexcel" class="btn btn-mini btn-success"><?php echo $idioma['ExportarExcel']?></a>
<table class="table table-bordered table-hover table-striped">
<thead>
	<tr>
    	<th>N</th>
        <th><?php echo $idioma['NombreArchivo']?></th>
        <th><?php echo $idioma['Docente']?></th>
        <th><?php echo $idioma['Materia']?></th>
        <th><?php echo $idioma['Curso']?></th>
        <th><?php echo $idioma['Direccion']?></th>
        <th><?php echo $idioma['Fecha']?></th>
        <th><?php echo $idioma['Hora']?></th>
        
    </tr>
</thead> 
    <?php foreach($regnotasexcel as $rne){$i++;
	$d=$docente->mostrarDocente($rne['CodDocente']);
	$d=array_shift($d);
	$m=$materias->mostrarMateria($rne['CodMateria']);
	$m=array_shift($m);
	$c=$curso->mostrarCurso($rne['CodCurso']);
	$c=array_shift($c);
	?>
    <tr>
    	<td><?php echo $i?></td>
        <td><?php echo $rne['NombreArchivo']?>
        <?php if($rne['Ubicacion']=="Subida"){?>
        <a href="../notasexcel/archivos/<?php echo $rne['NombreArchivo']?>" class="btn btn-mini" target="_blank"><i class="icon-chevron-down"></i></a>
        <?php }?>
        </td>
        <td><?php echo capitalizar($d['Paterno']." ".$d['Materno']." ".$d['Nombres'])?></td>
        <td><?php echo $m['Nombre']?></td>
        <td><?php echo $c['Nombre']?></td>
        <td><?php echo $rne['Ubicacion']?></td>
        <td><?php echo fecha2Str($rne['FechaRegistro'])?></td>
        <td><?php echo $rne['HoraRegistro']?></td>
    </tr> 
    <?php }?>

<?php

?>
 </table>