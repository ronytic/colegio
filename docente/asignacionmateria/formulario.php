<?php
include_once("../../login/check.php");
if(isset($_POST)){
include_once("../../class/curso.php");
$curso=new curso;

?>
<table class="table table-bordered table-hover">
<tr>
	<td>
<?php echo $idioma['Curso']?>:
<select name="Curso" class="span12">
<?php foreach($curso->mostrar() as $cur){?>
<option value="<?php echo $cur['CodCurso']?>"><?php echo $cur['Nombre']?></option>
<?php }?>
</select>
	</td>
</tr>
<tr>
	<td>
	<?php echo $idioma['Materia']?>:
    <select name="Materia" class="span12 disabled">
    
    </select>
	</td>
</tr>
<tr>
	<td>
    	<?php echo $idioma['Alumnos']?>:<br />
            <select name="alumno" class="span12">
            	<option value="2"><?php echo $idioma['AmbosSexos']?></option>
                <option value="1"><?php echo $idioma['SoloVarones']?></option>
                <option value="0"><?php echo $idioma['SoloMujeres']?></option>
			</select>
    </td>
</tr>
<tr>
	<td>
    	<input type="button" value="<?php echo $idioma['Asignar']?>" class="btn btn-success" id="asignar">
        <input type="button" value="<?php echo $idioma['Modificar']?>" class="btn btn-warning ocultar" id="actualizar">
        <input type="button" value="<?php echo $idioma['Cancelar']?>" class="btn ocultar" id="cancelar">
    </td>
</tr>
</table>
<?php
}
?>
<script language="javascript" type="text/javascript">
var MensajeEliminar="<?php echo $idioma['EliminarAsignacion']?>";
</script>