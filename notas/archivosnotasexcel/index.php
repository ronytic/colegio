<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="NVerArchivosNotasExcel";
include_once("../../class/docente.php");
include_once("../../class/materias.php");
include_once("../../class/curso.php");
$docente=new docente;
$materias=new materias;
$curso=new curso;
$cur=$curso->mostrar();
$mat=$materias->mostrarMaterias(1);
$doc=$docente->mostrarTodosDocentes();
include_once($folder."cabecerahtml.php");
?>

<?php include_once($folder."cabecera.php");?>
    <div class="span12 box">
        <div class="box-header"><h2><?php echo $idioma['Configuracion']?></h2></div>
        <div class="box-content">
        	<form class="formulario" action="ver.php" method="post">
        	<table class="table table-bordered">
            	<tr>
                    <td>
                    <?php echo $idioma['Docente']?>:<br>
                    <select class="span12" name="CodDocente">
                    <option value=""><?php echo $idioma['Seleccionar']?></option>
                    <?php foreach($doc as $d){?>
                    <option value="<?php echo $d['CodDocente']?>"><?php echo $d['Paterno']?> <?php echo $d['Materno']?> <?php echo $d['Nombres']?></option>
                    <?php }?>
                    </select>
                	</td>
                    <td>
                    <?php echo $idioma['Materia']?>:<br>
                    <select class="span12" name="CodMateria">
                    <option value=""><?php echo $idioma['Seleccionar']?></option>
                    <?php foreach($mat as $m){?>
                    <option value="<?php echo $m['CodMateria']?>"><?php echo $m['Nombre']?></option>
                    <?php }?>
                    </select>
                	</td>
                    <td>
                    <?php echo $idioma['Curso']?>:<br>
                    <select class="span12" name="CodCurso">
                    <option value=""><?php echo $idioma['Seleccionar']?></option>
                    <?php foreach($cur as $c){?>
                    <option value="<?php echo $c['CodCurso']?>"><?php echo $c['Nombre']?></option>
                    <?php }?>
                    </select>
                	</td>
                    <td>
                    <?php echo $idioma['Fecha']?>:<br>
                    <input type="text" class="span12 fechatope" name="Fecha">
                	</td>
            		<td><input type="submit" class="btn" value="<?php echo $idioma['Ver']?>" id="ver"></td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<div class="row-fluid">
	<div class="span12 box">
        <div class="box-header"><h2><?php echo $idioma['Datos']?></h2></div>
        <div class="box-content" id="respuestaformulario"></div>
    </div>
<?php include_once($folder."pie.php");?>