<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	include_once("../../class/casilleros.php");
	include_once("../../class/curso.php");
	
	$CodCurso=$_POST['CodCurso'];
	$CodMateria=$_POST['CodMateria'];
	$CodDocente=$_SESSION['CodDocente'];
	$CodPeriodo=$_POST['CodPeriodo'];
	$casilleros=new casilleros;
	$curso=new curso;
	
	$cur=($curso->mostrarCurso($CodCurso));
	$cur=array_shift($cur);
	$casillas=($casilleros->mostrarDocenteMateriaCursoTrimestre($CodDocente,$CodMateria,$CodCurso,$CodPeriodo));
	$casillas=array_shift($casillas);
	
	$CodCasilleros=$casillas['CodCasilleros'];
	$numcasilleros=$casillas['Casilleros'];
	?>
    <!--<div style="display:inline-block;">-->
    <div class="box-content">
		<?php echo $idioma['Curso']?>: <strong><?php echo $cur['Nombre']?> </strong> | 
		<?php echo $cur['Bimestre']?$idioma['Bimestre']:$idioma['Trimestre']?>: <strong><?php echo $CodPeriodo?></strong>
    </div>
    	<strong><?php echo $idioma['Ejemplo']?>:</strong> <?php echo $idioma['TrabajoPractico']?>, <?php echo $idioma['Carpeta']?>, <?php echo $idioma['Laboratorio']?>, <?php echo $idioma['ExamenFinal']?>
        <hr />
        <input type="hidden" value="<?php echo $CodCasilleros?>" name="CodCasilleros" />
	<table class="table table-bordered table-striped table-hover">
		<thead>
			<tr class="cabecera"><th>N</th><th><?php echo $idioma['NombresCasilleros']?></th></tr>
		</thead>
        	<?php for($i=1;$i<=$numcasilleros;$i++){$na++;?>
            <tr>
            <td><?php echo $na;?></td>
     		<td><input type="text" value="<?php echo $casillas['NombreCasilla'.$i];?>" name="NombreCasilla<?php echo $i?>" class="nombre"/></td>
            </tr>
     		<?php }?>
    </table>
    <input type="submit" value="<?php echo $idioma['GuardarNombres']?>" class="btn btn-success" id="guardarNombre"/>
	<?php
}
?>