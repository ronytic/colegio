<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	$CodAlumno=$_POST['CodAlumno'];
	?>
    	<strong><?php echo $idioma['SeparacionDatos'];?></strong>
    	<form action="../../impresion/alumno/tarjetaDeCuotas.php" method="get" target="pdf" class="form-horizontal">
        	<input type="hidden" name="CodAlumno" value="<?php echo $CodAlumno;?>"/>
            <table class="table">
            	<tr><td class="der"><label for="NombresAdicional"><?php echo $idioma["NombresAdicionales"]?> :</label></td><td><?php campo("NombresAdicional","text","","span8",0,$idioma['IngreseSus'].$idioma["NombresAdicionales"]);?></td></tr>
                <tr><td class="der"><label for="CursosAdicional"><?php echo $idioma["CursosAdicionales"]?> :</label></td><td><?php campo("CursosAdicional","text","","span8",0,$idioma['IngreseSus'].$idioma["CursosAdicionales"]);?></td></tr>
                <tr><td><a href="#" class="btn btn-success" id="registrarimpresion" data-archivo="Tarjeta de Cuotas" data-alumno="<?php echo $CodAlumno;?>"><?php echo $idioma['RegistrarImpresion']?></a></td><td><?php campo("enviar","submit",$idioma['Adicionar'],"span6 btn btn-primary")?></td></tr>
            </table>
        </form>
    	
    	<iframe src="../../impresion/alumno/tarjetadecuotas.php?CodAlumno=<?php echo $CodAlumno;?>" height="400" width="100%" name="pdf"></iframe>
        <a href="#" class="btn" id="mostrarimpresion"><?php echo $idioma['MostrarImpresion']?></a>
	<div id="respuestaimpresion"></div>
	<?php	
}
?>