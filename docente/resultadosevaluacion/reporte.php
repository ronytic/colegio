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
	include_once '../../class/curso.php';
	$evaluaciondocrespuestas=new evaluaciondocrespuestas;
	$evaluaciondocpreguntas=new evaluaciondocpreguntas;
	$evaluaciondocopciones=new evaluaciondocopciones;
	$docentemateriacurso=new docentemateriacurso;
	$materias=new materias;
	$docente=new docente;
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
		$mat=$materias->mostrarMateria($dmc['CodMateria']);
		$mat=array_shift($mat);
		?>
        <div class="box-header"><h2><?php echo $cur['Nombre']?> - <?php echo $mat['Nombre']?></h2></div>
        <div class="box-content">
        <?php foreach($evaluaciondocpreguntas->mostrarTodoRegistro() as $edp){$cant=0;$valorrespuesta=array();
			?><div class="resaltar"><?php echo $edp['Pregunta'];?></div><?php
			foreach($evaluaciondocopciones->mostrarTodoRegistro("CodEvaluacionDocPreguntas=".$edp['CodEvaluacionDocPreguntas']) as $edo) {
				$edr=$evaluaciondocrespuestas->mostrarTodoRegistro("CodDocente=$CodDocente and CodCurso=".$dmc['CodCurso']." and CodCampo=".$edp['CodEvaluacionDocPreguntas']." and Valor=".$edo['CodEvaluacionDocOpciones']);
				$canti=count($edr);
				$valorrespuesta[$edo['Opcion']]=$canti;
				$cant+=$canti;
				$max=max($valorrespuesta);
			}
			foreach($valorrespuesta as $vrk=>$vrv){?>
			<div class="horizontal centrar <?php echo $vrv==$max?'verde':''?>"><label><?php echo $vrk;?>
                <hr class="separador">
                <?php echo $vrv;?>
            </label></div>
			<?php }
			//print_r($valorrespuesta);
			?><div class="horizontal centrar celeste"><label><?php echo $idioma['Total']?>
            	<hr class="separador">
                 <?php echo $cant;?>
            </label></div><?php
			
		}?>
        <hr>
        	<div class="resaltar"><?php echo $idioma['Observaciones']?></div>
				<?php foreach($evaluaciondocrespuestas->mostrarTodoRegistro("CodDocente=$CodDocente and CodCurso=".$dmc['CodCurso']." and CodCampo='Observaciones'") as $edr){?>
                <?php if(!empty($edr['Valor'])){?><li><?php echo $edr['Valor'];?></li><?php }?>
                <?php }?>
            <hr>
        	<div class="resaltar"><?php echo $idioma['Sugerencias']?></div>
            	<?php foreach($evaluaciondocrespuestas->mostrarTodoRegistro("CodDocente=$CodDocente and CodCurso=".$dmc['CodCurso']." and CodCampo='Sugerencias'") as $edr){?>
                <?php if(!empty($edr['Valor'])){?><li><?php echo $edr['Valor'];?></li><?php }?>
                <?php }?>
        </div>
        <?php }?>
    
    <?php
}
?>