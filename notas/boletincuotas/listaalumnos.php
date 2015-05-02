<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	$CodCurso=$_POST['CodCurso'];
	$NumeroCuotas=$_POST['NumeroCuotas'];
	include_once("../../class/alumno.php");
	include_once("../../class/curso.php");
	include_once("../../class/cuota.php");
	$alumno=new alumno;
	$curso=new curso;
	$cuota=new cuota;
	$cur=$curso->mostrarCurso($CodCurso);
	$cur=array_shift($cur);
    include_once("../../class/config.php");
	$config=new config;
    $boletinmediacarta=$config->mostrarConfig("BoletinMediaCarta",1);
    if($boletinmediacarta){
        $ar="mediacarta";    
    }else{
        $ar="";    
    }
	if($cur['Bimestre']==1){
		$Boletin="boletinbimestre$ar.php";	
	}else{
		$Boletin="boletintrimestre$ar.php";	
	}
	?>
    <a href="#" id="exportarexcel" class="btn btn-success btn-mini"><?php echo $idioma['ExportarExcel']?></a>
    <table class="table table-bordered table-striped table-hover">
    	<thead>
        	<tr><th colspan="2"><?php echo $idioma['Curso']?>: <?php echo $cur['Nombre']?></th><th colspan="3"><?php echo $idioma['CuotaCancelada']?>: <?php echo $NumeroCuotas?></th></tr>
        	<tr><th>N</th><th><?php echo $idioma['Paterno']?></th><th><?php echo $idioma['Materno']?></th><th><?php echo $idioma['Nombres']?></th><th><?php echo $idioma['Accion']?></th>
            </tr>
        </thead>
    <?php
	foreach($alumno->mostrarDatosAlumnos($CodCurso) as $al){
		
		$cuo=$cuota->mostrarNumeroCuota($al['CodAlumno'],$NumeroCuotas);
		if(count($cuo)){$i++;
		?>
        <tr>
        	<td class="der"><?php echo $i;?></td>
            <td><?php echo capitalizar($al['Paterno'])?></td>
            <td><?php echo capitalizar($al['Materno'])?></td>
            <td><?php echo capitalizar($al['Nombres'])?></td>
            <td><a href="../../impresion/notas/<?php echo $Boletin?>?CodAlumno=<?php echo $al['CodAlumno']?>&CodCurso=<?php echo $CodCurso?>&mf=dce7c4174ce9323904a934a486c41288" target="_blank" class="btn btn-info btn-mini"><?php echo $idioma['VerBoletin']?></a></td>
        </tr>
        <?php	
		}
	}
	?>
    </table>
	<?php
}
?>