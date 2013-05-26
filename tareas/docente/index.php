<?php
include_once("../../login/check.php");
include_once("../../class/curso.php");
include_once("../../class/docente.php");
include_once("../../class/docentemateriacurso.php");
include_once("../../class/materias.php");
$folder="../../";
$titulo="NRegistroTareas";
$docente=new docente;
$curso=new curso;
$docmateriacurso=new docentemateriacurso;
$materias=new materias;
$CodDocente=$_SESSION['CodUsuarioLog'];
?>
<?php
include_once($folder."cabecerahtml.php");
?>
<script language="javascript">
var CompleteFechaPresentacion="<?php echo $idioma['CompleteFechaPresentacion']?>";
var CompleteNombreTarea="<?php echo $idioma['CompleteNombreTarea']?>";
var CompleteDescripcionTarea="<?php echo $idioma['CompleteDescripcionTarea']?>";
</script>

<script language="javascript" type="text/javascript" src="../../js/tareas/docente.js"></script>
<?php include_once($folder."cabecera.php");?>
<div class="span2">
    <div class="box-header"><?php echo $idioma["Curso"]?></div>    
    <div class="box-content">
    	<?php campo("tcurso","search","","span12",0,$idioma['BusquePor'])?>
    	<select class="span12" name="Curso">
		<?php foreach($docmateriacurso->mostrarDocenteOrdenCurso($CodDocente) as $cur){
				$c=$curso->mostrarCurso($cur['CodCurso']);
				$c=$c=array_shift($c);
				?>
                <option  value="<?php echo $c['CodCurso'];?>"><?php echo $c['Nombre'];?></option>
		<?php }?>
        </select>
	</div>
    <div class="box-header"><?php echo $idioma["Materia"]?></div>    
    <div class="box-content">
    	<?php campo("tmateria","search","","span12",0,$idioma['BusquePor'])?>
        <select name="Materia" class="span12">
        <?php foreach($docmateriacurso->mostrarDocenteMateria($CodDocente) as $docMat){
                $m=$materias->mostrarMateria($docMat['CodMateria']);
                $m=array_shift($m);
                ?>
                <option value="<?php echo $m['CodMateria'];?>"><?php echo $m['Nombre'];?></option>
        <?php }?>
        </select>
    </div>
</div>
<div class="span4">	
    <div class="box-header"><?php echo $idioma["Tarea"]?></div>
    <div class="box-content">
        <table class="table table-bordered table-striped table-hover">
            <tr>
            	<td><?php echo $idioma["NombreTarea"]?>:<br>
            	<?php campo("NombreTarea","text","","span12",1,$idioma['Ej:PracticaOrtografia'])?></td>
            </tr>
            <tr>
            	<td><?php echo $idioma["DescripcionTarea"]?>:<br>
                <?php campo("DescripcionTarea","textarea","","span12",0,"",0,array("rows"=>10))?></td>
            </tr>
            <tr>
            	<td><?php echo $idioma["FechaPresentacion"]?>:<br>
                <?php campo("FechaTarea","text",date("d-m-Y"),"span12",1,"",0,array("maxlength"=>10))?></td>
			</tr>
        </table>
        <input type="submit" value="<?php echo $idioma["GuardarTarea"]?>" class="btn btn-success" id="guardar"/>
    </div>
</div>
<div class="span6">
    <div class="box-header"><?php echo $idioma["TareasGuardadas"]?></div>
    <div class="box-content" id="tareaGuardada">
    
    </div>
</div>

<?php
include_once($folder."pie.php");
?>