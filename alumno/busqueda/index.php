<?php
include_once("../../login/check.php");
$folder="../../";
$NoRevisar=1;
$titulo=$idioma['BusquedaAlumnos'];
$Nombre=$_POST['Nombre'];
include_once("../../class/alumno.php");
include_once("../../class/curso.php");
$alumno=new alumno;
$curso=new curso;
$alu=$alumno->mostrarDatosPorNombreOrden($Nombre);
?>
<?php include_once("../../cabecerahtml.php");?>
<script language="javascript" type="text/javascript" src="../../js/alumno/busqueda.js"></script>
<?php include_once("../../cabecera.php");?>
<div class="span6 box">
	<div class="box-header"><?php echo $idioma['ListadoAlumnos']?></div>
    <div class="box-content">
    	<?php if(count($alu)){?>
    	<input type="search" placeholder="<?php echo $idioma['BuscarAlumnoPor']?>" id="ialumno" class="span12"/>
    	<select name="CodAlumno" class="span12" id="CodAlumno">
        	<?php foreach($alu as $al){
				$cur=$curso->mostrarCurso($al['CodCurso']);
				$cur=array_shift($cur);
				?>
            <option value="<?php echo $al['CodAlumno']?>"><?php echo capitalizar($al['Paterno'])?> <?php echo capitalizar($al['Materno'])?> <?php echo capitalizar($al['Nombres'])?> - <?php echo capitalizar($cur['Nombre'])?></option>
            <?php }?>
        </select>
        <?php }else{
			echo $idioma['AlumnoNoEncontrado'].": ";
			?><strong><?php echo $Nombre?></strong>
            <?php	
		}?>
    </div>
</div>
<div class="span6" id="respuesta">

</div>
<?php include_once("../../pie.php");?>