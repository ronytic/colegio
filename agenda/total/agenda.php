<?php
include_once("../../login/check.php");
if(!empty($_GET['CodAl'])){
	include_once("../../class/materias.php");
	include_once("../../class/alumno.php");
	include_once("../../class/curso.php");
	include_once("../../class/observaciones.php");
	$titulo="AgendaDigital";
	$folder="../../";
	$CodAlumno=$_GET['CodAl'];
	$_SESSION['CodAl']=$CodAlumno;
	$materia=new materias;
	$observaciones=new observaciones;
	$alumno=new alumno;
	$curso=new curso;
	$al=$alumno->mostrarTodoDatos($CodAlumno);
	$al=array_shift($al);
	$cur=$curso->mostrarCurso($al['CodCurso']);
	$cur=array_shift($cur);
	?>
    <?php include_once($folder."cabecerahtml.php");?>
    <script language="javascript" type="text/javascript" src="../../js/agenda/registro.js"></script>
    <script language="javascript">var CodCurso
	$(document).ready(function(e) {
    CodCurso=<?php echo $al['CodCurso']?>;    
    });
	
    </script>
    <?php include_once($folder."cabecera.php");?>

     <div class="span9 box">
     	<div class="box-header"><?php echo $idioma['DatosPersonales']?></div>
     	<div class="box-content">
     		<?php echo $idioma['Nombre']?>: <strong><span class="text-info"><?php echo capitalizar($al['Paterno']." ".$al['Materno']." ".$al['Nombres'])?></span></strong> <?php echo $idioma['Curso']?>: <strong><span class="text-info"><?php echo $cur['Nombre']?></span></strong></div>
     </div>
      
     <div class="span3 box" >
     
       	<div class="" style="background-color:#F00;">
        	<div class="box-header"><?php echo $idioma['Acciones']?></div>
            <div class="box-content">
            	<a class="btn" id="registrar"><?php echo $idioma['Registrar']?></a> <a class="btn" id="terminar"><?php echo $idioma['Terminar']?></a>
            </div>
        </div>
     </div>
</div>
<div class="sortable row-fluid">
     <div class="span3">
     	<div class="box-header"><?php echo $idioma['Materias']?></div>
		<div class="box-content">
        	<input type="search" name="sMateria" class="span12"/>
        	<select name="Materia" class="span12">
        	<?php
            	foreach($materia->mostrarMaterias() as $m){
				?>
                <option value="<?php echo $m['CodMateria'];?>" ><?php echo $m['Nombre'];?></option>
                <?php
				}
			?>
            </select>
        </div>
     </div>
     
     <div class="span3">
     	<div class="">
     	<div class="box-header"><?php echo $idioma['Observacion']?></div>
        <div class="box-content">
        <input type="search" name="sObservaciones" class="span12" placeholder="<?php echo $idioma['']?>"/>
        	<select name="Observaciones">
        	<?php
            	foreach($observaciones->mostrarObservaciones() as $o){
				?>
                <option value="<?php echo $o['CodObservacion'];?>"><?php echo $o['Nombre'];?></option>
                <?php
				}
			?>
            </select>
        </div>
        </div>
        <div class="box-header"><?php echo $idioma['Detalle']?></div>
        <div class="box-content">
        
        	Fecha <input name="fecha" placeholder="Fecha de la Observación" type="text" value="<?php echo date("Y-m-d")?>" id="fecha" class="span6"/>
            <div id="fechac"></div>
            <?php echo $idioma['Detalle']?>: <br /><a class="btn btn-mini completar">Archivador</a> <a class="btn btn-mini completar">Material de Higiene</a> <a class="btn btn-mini completar">Actividad</a> <a class="btn btn-mini completar">Teoría</a> <a class="btn btn-mini completar">Sistematización</a> <a class="btn btn-mini completar">Instrumento</a> <a class="btn btn-mini completar">Falto</a> <a class="btn btn-mini completar">Exposición</a> <a class="btn btn-mini completar">No Ingreso</a> <a class="btn btn-mini completar">No Atiende en clases</a> <a class="btn btn-mini completar">Juega y distrae</a> <a class="btn btn-mini completar">Lectura</a> <a class="btn btn-mini completar">Falta Ajedrez</a> <a class="btn btn-mini completar">Licencia Ajedrez</a><hr />
        	<textarea name="detalle" cols="22" rows="3" class="span12"></textarea>
            <label for="im">Importante</label><input type="checkbox" id="im" name="importante" />
        </div>
     </div>
     <div class="span6">
        <div class="box-header">Lista de Observaciones</div>
        <div class="box-content" id="respuesta">
			
        </div>
     </div>
     <div class="clear"></div>

     <?php	include_once($folder."pie.php");?>
    <?php
}
?>