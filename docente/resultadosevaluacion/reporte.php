<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	$CodDocente=$_POST['CodDocente'];
	include_once '../../class/evaluaciondocpreguntas.php';
	include_once '../../class/evaluaciondocrespuestas.php';
	include_once '../../class/evaluaciondocopciones.php';
	include_once '../../class/docentemateriacurso.php';
	include_once '../../class/materias.php';
	include_once '../../class/docente.php';
	include_once '../../class/alumno.php';
	include_once '../../class/curso.php';
	$evaluaciondocrespuestas=new evaluaciondocrespuestas;
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
    </table>
        <?php foreach($docentemateriacurso->mostrarDocenteGrupo($CodDocente,"CodCurso") as $dmc){
		$cur=$curso->mostrarCurso($dmc['CodCurso']);
		$cur=array_shift($cur);
		?>
        <div class="box-header"><h2><?php echo $cur['Nombre']?></h2></div>
        <div class="box-content">
        <?php foreach($evaluaciondocpreguntas->mostrarTodoRegistro() as $edp){
			?><div class="resaltar"><?php echo $edp['Pregunta'];?></div><?php
			foreach($evaluaciondocopciones->mostrarTodoRegistro("CodEvaluacionDocPreguntas=".$edp['CodEvaluacionDocPreguntas']) as $edo) {
				$edr=$evaluaciondocrespuestas->mostrarTodoRegistro("CodDocente=$CodDocente and CodCurso=".$dmc['CodCurso']." and CodCampo=".$edp['CodEvaluacionDocPreguntas']." and Valor=".$edo['CodEvaluacionDocOpciones']);
				?><div class="horizontal"><label><?php echo $edo['Opcion'];?>
                <hr class="separador">
                <?php echo count($edr);?>
                </label></div><?php
			}
		}?>
        </div>
        <?php }?>
    
    <?php
}
?>