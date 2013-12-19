<?php include_once($folder."login/check.php");?>
<?php
include_once(RAIZ."class/curso.php");
include_once(RAIZ."class/alumno.php");
if(isset($_GET['CodAlumno'])){
	$CodAlumno=$_GET['CodAlumno'];
	$alumno=new alumno;
	$al=array_shift($alumno->mostrarTodoDatos($CodAlumno));
}
if(isset($_GET['CodCurso'])){
	$CodCurso=$_GET['CodCurso'];
}
if(empty($CodCurso)){
	$CodCurso=$al['CodCurso'];
}
$curso=new curso;
?>
<script language="javascript" src="<?php echo $folder?>js/listar/listado.js"></script>
<?php if(!empty($jsFile)){?>
<script language="javascript" src="<?php echo $folder?>js/<?php echo $jsFile?>"></script>
<?php }?>
<div class="span11">

        <div class="box-header"><h2><?php echo $idioma['Curso']?></h2></div>
        <div class="box-content">
        	<!--<input type="search" placeholder="<?php echo $idioma['BuscarCursoPor']?>" id="icurso" class="span12"/>-->
            <select class="span12" id="selectcurso" data-placeholder="Seleccione un Curso">
            <?php
			$i=0;
            foreach($curso->mostrar() as $cu){$i++;
                ?><option value="<?php echo $cu['CodCurso'];?>" <?php echo $i==1 || $CodCurso==$cu['CodCurso']?'selected="selected"':'';?> rel="<?php echo $cu['caArea']?>"><?php echo eliminarEspaciosDobles($cu['Nombre']);?></option><?php
            }
            ?>
            </select>
        </div>


        <div class="box-header"><h2><i class="icon-user"></i><span class="break"></span><?php echo $idioma['Alumnos']?></h2></div>
        <div class="box-content">
        	<div id="cargandoralumnos"></div>
        	<input type="search" placeholder="<?php echo $idioma['BuscarAlumnoPor']?>" id="ialumno" class="span12"/>
            <select class="span12" id="selectalumno" data-placeholder="Seleccione un Alumno">
            	
            </select>
        </div>

</div>