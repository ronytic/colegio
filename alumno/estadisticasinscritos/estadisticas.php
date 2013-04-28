<?php
include_once("../../login/check.php");
include_once("../../class/alumno.php");
include_once("../../class/curso.php");
if(!empty($_POST)){
	$al=new alumno;
	$rude=new alumno;
	$cur=new curso;
	@$CodAlumno=$_POST['CodAlumno'];	
	$CantidadTotal=$al->contarInscritosTotal();
	$CantidadTotal=$CantidadTotal[0];
	$CantidadTotalV=0;
	$CantidadTotalM=0;
	$CantidadNuevo=0;
	?>
    <table class="table">
    	<thead>
    	<tr><th>Cantidad Total de Inscritos</th></tr>
        </thead>
        <tr class="contenido"><td><?php echo $CantidadTotal['CantidadTotal'];?> Alumnos</td></tr>
    </table>
    <table class="table table-condensed table-hover table-striped table-bordered">
    	<thead>
    	<tr class="cabecera"><th>Fechas</th><th>Cantidad Total</th></tr>
        </thead>
        <?php foreach($al->contarInscritoFechas() as $CantidadFechas){?>
        <tr class="contenido"><td><?php echo utf8_encode(strftime("%A, %d de %B del %Y",strtotime($CantidadFechas['FechaIns'])));?></td><td><?php echo $CantidadFechas['CantidadFecha'];?> Alumnos</td></tr>
        <?php
        }
		?>
    </table>
    <table class="table table-hover table-bordered table-striped" id="cantidades">
    	<thead>
    	<tr class="cabecera"><th>Cursos</th><th>Cantidad Total</th><th>Varones</th><th>Mujeres</th><th colspan="2">Nuevos</th></tr>
        </thead>
        <?php foreach($al->contarInscritoCurso() as $CantidadCurso){
				$var=$al->cantidadAlumno("Sexo=1 and CodCurso={$CantidadCurso['CodCurso']} and Retirado=0");
				$varones=array_shift($var);
				$muj=$al->cantidadAlumno("Sexo=0 and CodCurso={$CantidadCurso['CodCurso']} and Retirado=0");
				$mujeres=array_shift($muj);
				
				$cns=$rude->contarInscritoNuevoCurso($CantidadCurso['CodCurso']);
				$cn=array_shift($cns);
				
				$CantidadTotalM+=$mujeres['Cantidad'];
				$CantidadTotalV+=$varones['Cantidad'];
				$CantidadNuevo+=$cn['CantidadNuevo'];
				?>
        <tr class="contenido">
        	<td><?php  $cursos=array_shift($cur->mostrarCurso($CantidadCurso['CodCurso']));echo $cursos['Nombre'];?></td>
            <td><?php echo $CantidadCurso['CantidadCurso'];?> Alumnos</td>
			<td><?php echo $varones['Cantidad'];?> Alumnos</td>
            <td><?php echo $mujeres['Cantidad']?> Alumnas</td>
            <td class="text-right"><?php echo $cn['CantidadNuevo']?> </td>
            <td><a class="btn btn-mini vermasnuevo" title="Ver Alumnos Nuevos" rel="<?php echo $CantidadCurso['CodCurso']?>"><i class="icon-chevron-down"></i></a></td>

        </tr>
        <?php
        }
		?>
        <tfoot>
        <tr class="contenido resaltar">
        	<th>Todo el Colegio</th>
            <th><?php echo $CantidadTotal['CantidadTotal'];?> Alumnos</th>
			<th><?php echo $CantidadTotalV;?> Alumnos</th>
            <th><?php echo $CantidadTotalM?> Alumnas</th>
            <th><?php echo $CantidadNuevo;?></th>
        </tr>
        </tfoot>
    </table>
	<div class="alumnosnuevos oculto">
    	<div class="box-header"><h2>Alumnos Nuevos</h2></div>
        <div class="box-content" id="alumnosnuevos">
        </div>
    </div>
   
    
    
    <div class="clear"></div>
    <?php
	
}

?>