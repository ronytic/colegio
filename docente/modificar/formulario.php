<?php  
include_once '../../login/check.php';
if(isset($_POST)):
?>

	<input type="button" value="<?php echo $idioma['VerDatosDocente']?>" class="btn btn-success span12" id="verdatos">
    <br /><br />
    <input type="button" value="<?php echo $idioma['ModificarDatosDocente']?>" class="btn btn-info span12" id="modificardatos">
    <br /><br />
    <input type="button" value="<?php echo $idioma['ReporteDatosDocente']?>" class="btn  span12" id="reportedatos">
    <br /><br />
    <input type="button" value="<?php echo $idioma['ReporteTodosDatosDocente']?>" class="btn  span12" id="reportetododatos">
    <br /><br />
    <input type="button" value="<?php echo $idioma['RegistroNuevoDocente']?>" class="btn  span12 btn-inverse" id="nuevodocente">
<?php 
endif
?>