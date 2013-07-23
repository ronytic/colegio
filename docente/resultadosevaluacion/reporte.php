<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	$CodDocente=$_POST['CodDocente'];
	include_once '../../class/evaluaciondocpreguntas.php';
	include_once '../../class/evaluaciondocopciones.php';
	include_once '../../class/docentemateriacurso.php';
	include_once '../../class/materias.php';
	include_once '../../class/docente.php';
	include_once '../../class/alumno.php';
	include_once '../../class/curso.php';
	$evaluaciondocpreguntas=new evaluaciondocpreguntas;
	$evaluaciondocopciones=new evaluaciondocopciones;
	$docentemateriacurso=new docentemateriacurso;
	$materias=new materias;
	$docente=new docente;
	$alumno=new alumno;
	$curso=new curso;
	$doc=$docente->mostrarTodoDatosDocente($CodDocente);
	$doc=array_shift($doc);
	?>
    <table class="table table-bordered">
    	<thead>
        	<tr><th><?php echo $idioma['Docente']?>: <?php echo capitalizar($doc['Paterno']." ".$doc['Materno']." ".$doc['Nombres']);?></th></tr>
        </thead>
    	<tr><td><?php echo $idioma['Estadisticas']?></td></tr>
        <?php foreach($docentemateriacurso->){
			
		}?>
    </table>
    <?php
}
?>