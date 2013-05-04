<?php
include_once("../../login/check.php");
include_once("../../class/alumno.php");
include_once("../../class/curso.php");
include_once("../../class/config.php");
include_once("../../class/cuota.php");
if(!empty($_POST)){
	$CodAlumno=$_POST['CodAlumno'];
	$al=new alumno;
	$conf=new config;
	$cuo=new cuota;
	$alumnos=$al->mostrarTodoDatos($CodAlumno);
	$alumnos=$alumnos[0];
	$confG=$conf->mostrarConfig("MontoGeneral");
	$confK=$conf->mostrarConfig("MontoKinder");

	?>
	<table class="table table-bordered">
        <thead>
	        <tr><th><?php echo $idioma['NombreCompleto']?></th><th><?php echo $idioma['MontoPagar']?></th><th><?php echo $idioma['Descuento']?></th><th><?php echo $idioma['Nit']?></th><th><?php echo $idioma['FacturarA']?></th></tr>
        </thead>
        
        <tr>
        	<td><?php echo ucwords($alumnos['Paterno']);?> <?php echo ucwords($alumnos['Materno']);?> <?php echo ucwords($alumnos['Nombres']);?></td>
            <td><?php if($alumnos['CodCurso']==1)echo $confK['Valor'];else echo $confG['Valor']; ?> Bs</td>
            <td><?php echo $alumnos['MontoBeca'];?> Bs</td>
            <td><?php echo $alumnos['Nit'];?></td>
            <td><?php echo $alumnos['FacturaA'];?></td>
        </tr>
    </table>
    
    <table class="table table-bordered table-hover">
    	<thead>
    		<tr class="cabecera"><th>Nº</th><th><?php echo $idioma['APagar']?></th><th><?php echo $idioma['Factura']?></th><th><?php echo $idioma['Estado']?></th><th><?php echo $idioma['Observaciones']?></th><th><?php echo $idioma['Fecha']?></th></tr>
        </thead>
        <?php foreach($cuo->mostrarCuotas($CodAlumno) as $cuotas){
			?>
            <tr id="tr<?php echo $cuotas['CodCuota']?>" class="contenido <?php echo $cuotas['Cancelado']?'success':'';?>">
            	<td><?php echo $cuotas['Numero']?></td>
                <td><?php echo $cuotas['MontoPagar']?> Bs</td>
                <td><input type="text" value="<?php echo $cuotas['Factura']?>" size="4" id="f<?php echo $cuotas['CodCuota'];?>" class="ku input-mini" rel="<?php echo $cuotas['CodCuota'];?>"/></td>
                <td>
                	<input type="checkbox" id="c<?php echo $cuotas['CodCuota']?>" <?php echo $cuotas['Cancelado']?'checked="checked"':'';?> rel="<?php echo $cuotas['CodCuota']?>" class="cuotas"/>
                    <label class="msg hidden-phone hidden-tablet" for="c<?php echo $cuotas['CodCuota']?>"><?php echo $cuotas['Cancelado']?"Cancelado":"Pendiente";?></label></td>
                <td><input type="text" value="<?php echo $cuotas['Observaciones']?>" size="10" id="o<?php echo $cuotas['CodCuota'];?>"/ class="ku input-small" rel="<?php echo $cuotas['CodCuota'];?>"></td>
				<td><input type="text" value="<?php if($cuotas['Cancelado'])echo date("d-m-Y",strtotime($cuotas['Fecha']));else echo date("d-m-Y");?>" size="5" id="fe<?php echo $cuotas['CodCuota'];?>"/ class="ku fechass input-small" rel="<?php echo $cuotas['CodCuota'];?>"></td>
            </tr>
            <?php	
		}?>
    </table>
	<?php
}
?>