<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="NMisClases";
include_once("../../class/cursomateria.php");
include_once("../../class/curso.php");
include_once("../../class/materias.php");
include_once("../../class/alumno.php");
$alumno=new alumno;
$curso=new curso;
$cursomateria=new cursomateria;
$materias=new materias;
$CodAlumno=$_SESSION['CodUsuarioLog'];
$al=$alumno->mostrarTodoDatos($CodAlumno);
$al=array_shift($al);


include_once("../../cabecerahtml.php");
?>
<link href="../../css/clases/estio.css" type="text/css" rel="stylesheet">
<script language="javascript" type="application/javascript" src="../../js/clases/alumno.js"></script>
<script language="javascript">
	var PesoArchivo="<?php echo $idioma['PesoArchivo']?>";
	var FechaModificacion="<?php echo $idioma['FechaModificacion']?>";
</script>
<?php include_once("../../cabecera.php");?>
<div class="span5 box">
	<div class="box-header"><h2><?php echo $idioma['Datos']?></h2></div>
    <div class="box-content">
    	<form action="subir.php" enctype="multipart/form-data" method="post" id="formulario">
    	<div class="row-fluid">
        	<div class="span5">
            	<div class="box-header"><?php echo $idioma['Materia']?></div>
                <div class="box-content">
                
                <select class="span12" name="CodMateria">
                <?php foreach($cursomateria->mostrarMaterias($al['CodCurso']) as $cm){
					$mat=$materias->mostrarMateria($cm['CodMateria']);
					$mat=array_shift($mat);	
				?>
                	<option value="<?php echo $cm['CodMateria']?>"><?php echo $mat['Nombre']?></option>
                <?php }?>
                </select>
                </div>
            </div>
            <div class="span7">
            	<div class="box-header"><?php echo $idioma['Curso']?></div>
            	<div class="box-content">
                <?php
                $cur=$curso->mostrarCurso($al['CodCurso']);
				$cur=array_shift($cur);
				?>
            	<select class="span12" name="CodCurso">
                	<option value="<?php echo $cur['CodCurso']?>"><?php echo $cur['Nombre']?></option>
                </select>
                </div>
                <div class="box">
                    <div class="box-header"><?php echo $idioma['Comentario']?></div>
                    <div class="box-content">
                        <textarea class="span12" rows="4" name="comentario"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="row-fluid">
        	<div class="span12 box">
            	<div class="box-header"><h2><?php echo $idioma['Archivos']?></h2></div>
           		<div class="box-content">
                    <label for="files"><?php echo $idioma['SuelteArchivos']?></label>
                    <div style="position:relative">
                        <input type="file" id="files" name="files[]" multiple/>
                        <div id="drop_zone"><?php echo $idioma['SuelteArchivos']?></div>
                        <div id="list"></div>
                    </div>
        		</div>
            </div>
        </div>
        <input type="submit" value="<?php echo $idioma['Publicar']?>" class="btn btn-success">
        <a class="btn" href="./"><?php echo $idioma['Cancelar']?></a>
        </form>
        <div class="row-fluid">
        	<div class="span12" id="respuesta">
            </div>
        </div>
    </div>
</div>

<div class="span7 box">
	<div class="box-header"><h2><?php echo $idioma['MisArchivosClases']?></h2><div class="box-icon"><a href="#" id="actualizar"><i class="icon-refresh"></i></a></div></div>
    <div class="box-content">
        <div></div>
        <div id="mostrar"></div>
    </div>
    
</div>
    

<?php include_once("../../pie.php");?>