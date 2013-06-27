<?php
include_once("../../login/check.php");
if(isset($_POST)){
	include_once("../../class/docente.php");
	$docente=new docente;
	$listado=$_POST['listado'];
	?>
    <a href="#" class="btn btn-success btn-mini" id="exportarexcel"><?php echo $idioma['ExportarExcel']?></a>
    <br />
    <table class="table table-bordered table-hover">
    	<thead>
        	<tr><th>N</th><th><?php echo $idioma['Paterno']?></th><th><?php echo $idioma['Materno']?></th><th><?php echo $idioma['Nombres']?></th>
            <?php if($listado=="DatosPersonales"){?>
            <th><?php echo $idioma['Sexo']?></th><th><?php echo $idioma['Ci']?></th><th><?php echo $idioma['FechaNac']?></th><th><?php echo $idioma['Telefono']?></th><th><?php echo $idioma['Celular']?></th>
            <?php }elseif($listado=="DatosFormacionProfesional"){?>
                <th><?php echo $idioma['Universidad']?></th>
                <th><?php echo $idioma['AñoIngreso']?></th>
                <th><?php echo $idioma['AñoEgreso']?></th>
                <th><?php echo $idioma['AñoTitulacion']?></th>
                <th><?php echo $idioma['Titulo']?></th>
            <?php }elseif($listado=="DatosTrabajo"){?>
            	<th><?php echo $idioma['Cargo']?></th>
                <th><?php echo $idioma['CargaHoraria']?></th>
                <th><?php echo $idioma['Antiguedad']?></th>
                <th><?php echo $idioma['Categoria']?></th>
            <?php }?>
            </tr>
        </thead>
    <?php
	foreach($docente->mostrarTodoRegistro() as $doc){$i++
	?>
    	<tr>
        	<td><?php echo $i?></td>
            <td><?php echo capitalizar($doc['Paterno'])?></td>
            <td><?php echo capitalizar($doc['Materno'])?></td>
            <td><?php echo capitalizar($doc['Nombres'])?></td>
            <?php if($listado=="DatosPersonales"){?>
            <td><?php echo $doc['Sexo']=='0'?'F':'M';?></td>
            <td><?php echo capitalizar($doc['Ci'])?></td>
            <td><?php echo fecha2Str($doc['FechaNac'])?></td>
            <td><?php echo capitalizar($doc['Telefono'])?></td>
            <td><?php echo capitalizar($doc['Celular'])?></td>
            <?php }elseif($listado=="DatosFormacionProfesional"){?>
            <td><?php echo capitalizar($doc['DPUniversidad'])?></td>	
            <td><?php echo capitalizar($doc['DPAnoIngreso'])?></td>
            <td><?php echo capitalizar($doc['DPAnoEgreso'])?></td>
            <td><?php echo capitalizar($doc['DPAnoTitulacion'])?></td>
            <td><?php echo capitalizar($doc['DPTitulo'])?></td>
			<?php }elseif($listado=="DatosTrabajo"){?>
            <td><?php echo capitalizar($doc['DTCargo'])?></td>	
            <td><?php echo capitalizar($doc['DTCargaHoraria'])?></td>
            <td><?php echo capitalizar($doc['DTAntiguedad'])?></td>
            <td><?php echo capitalizar($doc['DTCategoria'])?></td>
            <?php }?>
		</tr>
    <?php
	}
	?>
    </table>
    <?php
}
?>