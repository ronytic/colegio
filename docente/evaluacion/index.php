<?php  
include_once '../../login/check.php';
$folder="../../";
$titulo="NEvaluaciondocente";
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
$CodAlumno=$_SESSION['CodUsuarioLog'];
$al=array_shift($alumno->mostrarTodoDatos($CodAlumno));
$cur=array_shift($curso->mostrarCurso($al['CodCurso']));
$i=0;
?>
<?php include_once $folder.'cabecerahtml.php'; ?>
<?php include_once $folder.'cabecera.php'; ?>
	<div class="span12">
		<table class="table table-bordered">
			<tr>
				<td><?php echo $idioma['Nombre']?>:</td><td class="resaltar"><?php echo $idioma['Anonimo']?></td><td><?php echo $idioma['Curso']?>:</td><td class="resaltar"><?php echo $cur['Nombre']; ?></td>
			</tr>
		</table>
	</div>
</div>
    <form action="guardarevaluacion.php" method="post"><input type="hidden" name="CodCurso" value="<?php echo $al['CodCurso'];?>" />
	<?php foreach ($docentemateriacurso->mostrarCursoSexo($al['CodCurso'],$al['Sexo']) as $key => $value):$i++;?>
		<?php $mat=array_shift($materias->mostrarMateria($value['CodMateria'])); 
			$doc=array_shift($docente->mostrarTodoDatosDocente($value['CodDocente']));
			$direcfoto=$folder."imagenes/docentes/".$doc['Foto']."";
			if(!file_exists($direcfoto))
				$direcfoto=$folder."imagenes/docentes/0.jpg";
		?>
        <div class="row-fluid">
		<div class="span12">
        
			<div class="box-header"><?php echo ucwords($doc['Nombres']) ?> <?php echo ucfirst($doc['Paterno']) ?> - <?php echo $mat['Nombre'] ?></div>
			<div class="box-content">
				<div class="row-fluid">
				<div class="span2">
					<img src="<?php echo $direcfoto ?>" class="img-polaroid">
				</div>
				<div class="span7">
					<div class="cuerpo preguntas">
						<?php foreach ($evaluaciondocpreguntas->mostrarTodoRegistro() as $key => $edp): ?>
							<div class="resaltar"><?php echo $edp['Pregunta'] ?></div>	
							<?php foreach ($evaluaciondocopciones->mostrarTodoRegistro("CodEvaluacionDocPreguntas=".$edp['CodEvaluacionDocPreguntas'],1) as $key => $edo): ?>
								<?php 
								switch ($edp['Tipo']) {
									case 'radio':
										?>
										<div class="horizontal">
										<label for="r-<?php echo $i?>-<?php echo $edo['CodEvaluacionDocOpciones'] ?>"><?php echo $edo['Opcion'];?>
										<input type="radio" name="eva[<?php echo $i?>][<?php echo $doc['CodDocente']?>][<?php echo $edp['CodEvaluacionDocPreguntas'] ?>]" id="r-<?php echo $i?>-<?php echo $edo['CodEvaluacionDocOpciones'] ?>" value="<?php echo $edo['CodEvaluacionDocOpciones'] ?>" required>
                                        </label>
										</div>
										<?php
										break;
								}
								 ?>
							<?php endforeach ?>
						<?php endforeach ?>
					</div>
				</div>
				<div class="span3">
					<div class="resaltar"><?php echo $idioma['Observaciones']?></div>
					<textarea name="eva[<?php echo $i?>][<?php echo $doc['CodDocente']?>][Observaciones]" rows="6" class="span12"></textarea>
                    <div class="resaltar"><?php echo $idioma['Sugerencias']?></div>
					<textarea name="eva[<?php echo $i?>][<?php echo $doc['CodDocente']?>][Sugerencias]" rows="6" class="span12"></textarea>
				</div>
              
                </div>
			</div>
		</div>
		</div>
	<?php endforeach ?>
<div class="row-fluid">
    <div class="span12">
    	<div class="box-content">
            	<input type="submit" value="<?php echo $idioma['GuardarEvaluacion']?>" class="btn btn-success btn-large"/>
        </div>
    </div>
</div>
    </form>
<div class="row-fluid">

<?php include_once $folder.'pie.php'; ?>