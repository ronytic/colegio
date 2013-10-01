<?php
include_once("../../login/check.php");
include_once("../../class/curso.php");
include_once("../../class/docente.php");
include_once("../../class/docentemateriacurso.php");
include_once("../../class/materias.php");
include_once("../../class/observaciones.php");
$titulo="NReporteEstadisticoAgenda";
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
<script language="javascript" type="text/javascript" src="../../js/core/plugins/highcharts.js"></script>
<script language="javascript" type="text/javascript" src="../../js/core/plugins/exporting.js"></script>
<script language="javascript" type="text/javascript" src="../../js/agenda/estadisticas.js"></script>
<script language="javascript">
$(document).ready(function(e) {

});
</script>
<?php include_once($folder."cabecera.php");?>
<div class="span3">
    <div class="box-header"><?php echo $idioma["Configuracion"]?></div>    
    <div class="box-content">
    	<?php //campo("tcurso","search","","span12",0,$idioma['BusquePor'])?>
        <?php echo $idioma['FechaInicio']?>
        <?php campo("FechaInicio","text",date("d-m-Y",strtotime(date("Y-m-d")." -7 Days")),"span12",0,"")?>
        <?php echo $idioma['FechaFinal']?>
        <?php campo("FechaFinal","text",date("d-m-Y"),"span12",0,"")?>
        <?php echo $idioma['Curso']?>
    	<select class="span12" name="Curso" id="Curso">
        <option value=""><?php echo $idioma['Seleccionar']?></option>
		<?php foreach($curso->mostrar() as $c){
				?>
                <option  value="<?php echo $c['CodCurso'];?>"><?php echo $c['Nombre'];?></option>
		<?php }?>
        </select>
        <?php echo $idioma["Materia"]?>
        <select name="Materia" class="span12" id="Materia">
        <option value=""><?php echo $idioma['Seleccionar']?></option>
        <?php foreach($materias->mostrarMaterias() as $m){
                ?>
                <option value="<?php echo $m['CodMateria'];?>"><?php echo $m['Nombre'];?></option>
        <?php }?>
        </select>
         <?php echo $idioma["Alumno"]?>
        <select id="Alumnos" name="Alumnos" class="span12">
        <option value=""><?php echo $idioma['Seleccionar']?></option>
        </select>
        <?php echo $idioma["Observacion"]?>
        <select name="Observacion" class="span12" id="Observacion">
        <option value=""><?php echo $idioma['Seleccionar']?></option>
        <?php foreach($observaciones->mostrarObservaciones("Nombre") as $obs){?>
			<option value="<?php echo $obs['CodObservacion'];?>"><?php echo $obs['Nombre'];?></option>
        <?php }?>
        </select>
        <input type="submit" value="<?php echo $idioma["MostrarReporte"]?>" class="btn btn-success" id="registrar"/>
	</div>
</div>
<div class="span9">
	<div class="box-header"><?php echo $idioma["Reporte"]?></div>
	<div class="box-content" id="respuestareporte">
	</div>
</div>
<?php include_once($folder."pie.php");?>