<?php
include_once("../../login/check.php");
include_once("../../class/materias.php");
include_once("../../class/alumno.php");
include_once("../../class/curso.php");
include_once("../../class/observaciones.php");
if(!empty($_GET['CodAl'])){
	$titulo="Agenda Digital";
	$folder="../../";
	$CodAlumno=$_GET['CodAl'];
	$_SESSION['CodAl']=$CodAlumno;
	$materia=new materias;
	$observaciones=new observaciones;
	$alumno=new alumno;
	$curso=new curso;
	$al=$alumno->mostrarDatos($CodAlumno);
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
     <div class="container_12" id="cuerpo">
     <div class="grid_9">Nombre: <span class="azulT"><?php echo ucwords($al['Paterno']." ".$al['Materno']." ".$al['Nombres'])?></span> Curso: <span class="azulT"><?php echo $cur['Nombre']?></span></div>
     <div class="grid_3"><div class="botones" style="position:fixed;padding:2px;"><a class="boton corner-all" id="registrar">Registrar</a><a class="boton corner-all" id="terminar">Terminar</a></div></div>
     <div class="clear"></div>
     <div class="grid_2">
     	<div class="titulo corner-tl corner-tr">Materias</div>
		<div class="cuerpo">
        	<?php
            	foreach($materia->mostrarMaterias() as $m){
				?>
                <li><input type="radio" name="Materia" value="<?php echo $m['CodMateria'];?>" id="materia<?php echo $m['CodMateria'];?>" class="radio"/><label class="lradio capital" for="materia<?php echo $m['CodMateria'];?>"><?php echo $m['Nombre'];?></label></li>
                <?php
				}
			?>
        </div>
     </div>
     <div class="grid_3">
     	<div class="titulo corner-tl corner-tr">Observación</div>
        <div class="cuerpo">
        	<?php
            	foreach($observaciones->mostrarObservaciones() as $o){
				?>
                <li><input type="radio" name="Observaciones" value="<?php echo $o['CodObservacion'];?>" id="obs<?php echo $o['CodObservacion'];?>" class="radio"/><label class="lradio capital" for="obs<?php echo $o['CodObservacion'];?>"><?php echo $o['Nombre'];?></label></li>
                <?php
				}
			?>
        </div>
        <div class="titulo corner-tr corner-tl">Detalle</div>
        <div class="cuerpo centrar">
        
        	Fecha<input name="fecha" placeholder="Fecha de la Observación" type="text" value="<?php echo date("Y-m-d")?>" id="fecha"/>
            <div id="fechac"></div>
            Detalle:   <hr /><a class="botonSec completar">Archivador</a> <a class="botonSec completar">Material de Higiene</a> <a class="botonSec completar">Actividad</a> <a class="botonSec completar">Teoría</a> <a class="botonSec completar">Sistematización</a> <a class="botonSec completar">Instrumento</a> <a class="botonSec completar">Falto</a> <a class="botonSec completar">Exposición</a> <a class="botonSec completar">No Ingreso</a> <a class="botonSec completar">No Atiende en clases</a> <a class="botonSec completar">Juega y distrae</a> <a class="botonSec completar">Lectura</a> <a class="botonSec completar">Falta Ajedrez</a> <a class="botonSec completar">Licencia Ajedrez</a><hr />
        	<textarea name="detalle" cols="22" rows="3"></textarea>
            <label for="im">Importante</label><input type="checkbox" id="im" name="importante" />
        </div>
     </div>
     <div class="grid_7">
        <div class="titulo corner-tr corner-tl">Lista de Observaciones</div>
        <div class="cuerpo" id="respuesta">
			
        </div>
     </div>
     <div class="clear"></div>
     </div>
     <?php	include_once($folder."footer.php");?>
    <?php
}
?>