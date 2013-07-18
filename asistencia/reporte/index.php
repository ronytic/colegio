<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="NReporteAsistencias";
include_once("../../class/curso.php");
$curso=new curso;
include_once($folder."cabecerahtml.php");
?>
<script language="javascript" type="text/javascript" src="../../js/asistencia/reporte.js"></script>
<script language="javascript" type="text/javascript">
var seleccionar="<?php echo $idioma['Todos']?>";
</script>
<?php include_once($folder."cabecera.php");?>
<div class="span3">
	<div class="box">
    	<div class="box-header"><h2><?php echo $idioma['Configuracion']?></h2></div>
        <div class="box-content">
        <form action="formulario.php" method="post" class="formulario">
        	<table class="table table-bordered table-striped table-hover">
            	<tr>
                	<td><?php echo $idioma['Fecha']?></td>
                </tr>
            	<tr>
                	<td>
                    <?php echo $idioma['Desde']?>:
            		<?php campo("FechaInicio","text",fecha2Str(date("Y-m-d")),"span12",1);?>
                    
                    <?php echo $idioma['Hasta']?>:
            		<?php campo("FechaFin","text",fecha2Str(date("Y-m-d")),"span12",1);?>
                    </td>
                </tr>
                <tr>
                	<td>
                    <?php echo $idioma['Curso']?>:	
                    <select name="CodCurso" class="span12">
                    	<option value="Todo"><?php echo $idioma['TodosLosCursos']?></option>
                        <?php foreach($curso->mostrar() as $cur){?>
                        <option value="<?php echo $cur['CodCurso']?>"><?php echo $cur['Nombre']?></option>
                        <?php }?>
                    </select>
                    </td>
                </tr>
                <tr class="alumnos ocultar">
                	<td>
                    	<?php echo $idioma['Alumnos']?>:
						<select name="CodAlumno" class="span12">
                        </select>
					</td>
                </tr>
                <tr>
                	<td>
                    	<?php echo $idioma['TipoObservacion']?>:
						<select name="TipoObservacion" class="span12">
                        	<option class="Todo"><?php echo $idioma['Todos']?></option>
                            <option value="A"><?php echo $idioma['Atraso']?></option>
                            <option value="C"><?php echo $idioma['Asistencia']?></option>
                            <option value="F"><?php echo $idioma['Falta']?></option>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td>
                    	<input class="btn btn-success" value="<?php echo $idioma['VerReporte']?>" type="submit">
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<div class="span9">
	<div class="box">
    	<div class="box-header"><h2><?php echo $idioma['Reporte']?></h2></div>
        <div class="box-content" id="respuestaformulario">
        
        </div>
	</div>
</div>
<?php include_once($folder."pie.php");?>