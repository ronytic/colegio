<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	$CodAlumno=$_POST['CodAlumno'];
	?>
    	<strong>La separación de varios datos se lo realiza con el "/" (shif+7)(Símbolo Dividido)</strong>
    	<form action="../../impresion/alumno/tarjetaDeCuotas.php" method="get" target="pdf" class="form-horizontal">
        	<input type="hidden" name="CodAlumno" value="<?php echo $CodAlumno;?>"/>
            <?php 
				campos("Nombres Adiciones:","NombresAdicional","text","",1,"span6");
				campos("Cursos Adicionales:","CursosAdicional","text","",1,"span6");
				campos("Adicionar","","submit","",1,"span6 btn btn-primary");
			?>
        </form>
    	
    	<iframe src="../../impresion/alumno/tarjetadecuotas.php?CodAlumno=<?php echo $CodAlumno;?>" height="400" width="100%" name="pdf"></iframe>
	<?php	
}
?>