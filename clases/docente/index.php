<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="NMisClases";
include_once("../../class/docentemateriacurso.php");
include_once("../../class/curso.php");
include_once("../../class/materias.php");
$docentemateriacurso=new docentemateriacurso;
$curso=new curso;
$materias=new materias;
$CodDocente=$_SESSION['CodUsuarioLog'];
$docmateriacurso=$docentemateriacurso->mostrarTodoDocente($CodDocente);

include_once("../../cabecerahtml.php");
?>
<link href="../../css/clases/estio.css" type="text/css" rel="stylesheet">
<script language="javascript" type="application/javascript" src="../../js/clases/docente.js"></script>
<script language="javascript">
	var PesoArchivo="<?php echo $idioma['PesoArchivo']?>";
	var FechaModificacion="<?php echo $idioma['FechaModificacion']?>";
</script>
<?php include_once("../../cabecera.php");?>
<div class="span5 box">
	<div class="box-header"><h2><?php echo $idioma['Datos']?></h2></div>
    <div class="box-content">
    	<form action="subir.php" enctype="multipart/form-data">
    	<div class="row-fluid">
        	<div class="span5">
            	<div class="box-header"><?php echo $idioma['Curso']?></div>
                <div class="box-content">
            	<select class="span12" name="CodCurso">
            	<?php foreach($docmateriacurso as $dmc){
						
						$cur=$curso->mostrarCurso($dmc['CodCurso']);
						$cur=array_shift($cur);
				?>
                	<option value="<?php echo $dmc['CodCurso']?>"><?php echo $cur['Nombre']?></option>
                <?php }?>
                </select>
                </div>
            </div>
            <div class="span7">
            	<div class="box-header"><?php echo $idioma['Materia']?></div>
            	<div class="box-content">
                <select class="span12" name="CodMateria">
                <?php foreach($docentemateriacurso->mostrarDocenteMateria($CodDocente) as $dmc){
					$mat=$materias->mostrarMateria($dmc['CodMateria']);
					$mat=array_shift($mat);	
				?>
                	<option value="<?php echo $dmc['CodMateria']?>"><?php echo $mat['Nombre']?></option>
                <?php }?>
                </select>
                </div>
                <div class="box">
                    <div class="box-header"><?php echo $idioma['Comentario']?></div>
                    <div class="box-content">
                        <textarea class="span12" rows="4"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="row-fluid">
        	<div class="span12 box">
            	<div class="box-header"><h2><?php echo $idioma['Archivos']?></h2></div>
           		<div class="box-content">
                    <label for="files">Suelte Archivos</label>
                    <div style="position:relative">
                        <input type="file" id="files" name="files[]" multiple/>
                        <div id="drop_zone">Arrastre los Archivos aquí</div>
                        <div id="list"></div>
                    </div>
        		</div>
            </div>
        </div>
        <input type="submit" value="<?php echo $idioma['Publicar']?>" class="btn btn-success">
        <a class="btn" href="./"><?php echo $idioma['Cancelar']?></a>
        </form>
    </div>
</div>
<div class="span7 box">
	<div class="box-header"><h2><?php echo $idioma['MisArchivosClases']?></h2><div class="box-icon"><a href="#"><i class="icon-refresh"></i></a></div></div>
    <div class="box-content">
    
    </div>
</div>
<?php include_once("../../pie.php");?>