<?php
include_once("../../login/check.php");
include_once("../../class/asistencia.php");
include_once("../../class/alumno.php");
include_once("../../class/curso.php");
$folder="../../";
$asistencia=new asistencia;
$alumno=new alumno;
$curso=new curso;
$FechaActual=date("Y-m-d");
$asis=$asistencia->listadoFaltasHoy($FechaActual);
$Cantidad=count($asis);
include_once($folder."cabecerahtml.php");
include_once($folder."cabecera.php");
?>
<div class="span12">
    <div class="box">
    <div class="box-header"><h2><?php echo $idioma['AlumnosFaltas']?></h2></div>
    <div class="box-content">
    <?php
    if($Cantidad){
        ?>
        <table class="table table-hover table-striped table-bordered">
        	<thead>
            	<tr><th colspan="2"><?php echo $idioma['Total']?> <?php echo $idioma['Alumnos']?>:<?php echo $Cantidad?></th></tr>
            	<tr><th>N</th><th><?php echo $idioma['Nombres']?></th><th><?php echo $idioma['Curso']?></th></tr>
            </thead>
        <?php foreach($asis as $a){$i++;
			$al=$alumno->mostrarTodoDatos($a['CodAlumno']);
			$al=array_shift($al);
			$cur=$curso->mostrarCurso($al['CodCurso']);
			$cur=array_shift($cur);
            ?><tr>
                <td><?php echo $i;?></td>
                <td><?php echo capitalizar($al['Paterno']." ".$al['Materno']." ".$al['Nombres']);?></td>
                <td><?php echo $cur['Nombre']?></td>
            </tr>
        <?php }?>
        </table>
        <?php	
    }else{
        ?>
        <div class="alert alert-error"><?php echo $idioma['NoExistenFaltasHoy']?></div>
        <?php
    }
    ?>
    </div>
    </div>
</div>
<?php include_once($folder."pie.php");?>