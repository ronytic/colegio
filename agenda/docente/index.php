<?php
include_once("../../login/check.php");
include_once("../../class/curso.php");
include_once("../../class/docente.php");
include_once("../../class/docentemateriacurso.php");
include_once("../../class/materias.php");
include_once("../../class/observaciones.php");
$titulo="NRegistroAgenda";
$folder="../../";
$docente=new docente;
$curso=new curso;
$docmateriacurso=new docentemateriacurso;
$materias=new materias;
$observaciones=new observaciones;
$CodDocente=$_SESSION['CodUsuarioLog'];
$_SESSION['CodDocente']=$CodDocente;
?>
<?php include_once($folder."cabecerahtml.php");?>
<script language="javascript" type="text/javascript" src="../../js/agenda/docente.js"></script>
<script language="javascript">
$(document).ready(function(e) {

});
</script>
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
  	<div class="box-header"><?php echo $idioma["Alumnos"]?></div>
    <div class="box-content">
    	<?php campo("talumnos","search","","span12",0,$idioma['BusquePor'])?>
      	<select id="alumnos" name="Alumnos">
        </select>
	</div>
</div>
<div class="span6">
	<div class="box-header"><?php echo $idioma["Observaciones"]?></div>
	<div class="box-content">
    	<div class="row-fluid">
        <div class="span5">
            <select name="Observacion">
            <?php foreach($observaciones->mostrarObservacionDoc() as $obs){?>
            <option value="<?php echo $obs['CodObservacion'];?>"><?php echo $obs['Nombre'];?></option>
            <?php }?>
            </select>
		</div>
        <div class="span7">
        <table class="table table-hover table-striped table-bordered">
        	<tr>
        		<td><?php echo $idioma["Fecha"]?>:<br />
                <?php campo("Fecha","text",date("d-m-Y"),"span12",1,"",0,array("maxlength"=>10))?>
                </td>
            </tr>
            
        	<tr>
            	<td><?php echo $idioma["Detalle"]?>:<br />
                <?php campo("Detalle","textarea","","span12")?>
				</td>
			</tr>
            <tr>
            	<td>
                <div class="alert alert-error">
                <label for="Urgente" ><?php echo $idioma["Urgente"]?> (<?php echo $idioma["Citacion"]?>):<?php campo("Urgente","checkbox","1","")?></label> 
                </div>
                </td>
            </tr>
        </table>
        <input type="submit" value="<?php echo $idioma["Registrar"]?>" class="btn btn-success" id="registrar"/><br />
        <?php echo $idioma["ParaEliminarAnotacionConsulteRegente"]?>.
        </div>
        </div>
        <div id="respuestaformulario"></div>
        <div class="alert alert-info">
        <label for="Busqueda" ><?php echo $idioma["BusquedaEspecificaPorAlumno"]?>:<?php campo("Busqueda","checkbox","1","")?></label> 
        </div>
	</div>
	<div class="box-header"><?php echo $idioma["AgendaAlumnos"]?></div>
	<div class="box-content" id="Agenda">
	</div>
</div>
<?php include_once($folder."pie.php");?>