<?php
include_once("../../login/check.php");
$CodAlumno=$_POST['CodAlumno'];
//echo "-".$CodAlumno."-";
if($CodAlumno=="null"){
exit();	
}
?>
<div class="row-fluid">
<?php
	$men1=array(
			array("Nombre"=>"RegistrarFactura","Url"=>"factura/registro/?CodAlumno=$CodAlumno","Imagen"=>"facturaregistro.png"),
			array("Nombre"=>"Agenda","Url"=>"agenda/total/agenda.php?CodAl=$CodAlumno","Imagen"=>"agendaregistro.png"),
			array("Nombre"=>"EnviarMensajePrivado","Url"=>"sms/enviarmensaje/?CodAlumno=$CodAlumno","Imagen"=>"sms2.png"),
			array("Nombre"=>"VerBoletin","Url"=>"notas/boletines/?CodAlumno=$CodAlumno","Imagen"=>"boletin.png"),
			
			array("Nombre"=>"PagarCuotas","Url"=>"cuotas/pagar/?CodAlumno=$CodAlumno","Imagen"=>"pagar.png"),
			array("Nombre"=>"ImprimirTarjetaCuotas","Url"=>"cuotas/tarjetacuotas/?CodAlumno=$CodAlumno","Imagen"=>"impresion.png"),
			array("Nombre"=>"DatosAlumno","Url"=>"alumno/datosalumno/?CodAlumno=$CodAlumno","Imagen"=>"alumnoeditar.png"),
			array("Nombre"=>"VerBoletaDatos","Url"=>"alumno/boletadatos/?CodAlumno=$CodAlumno","Imagen"=>"verdatos.png"),
			array("Nombre"=>"ModificarRude","Url"=>"rude/editarrude/?CodAlumno=$CodAlumno","Imagen"=>"editarrude.png"),
			array("Nombre"=>"VerRudeImpresion","Url"=>"rude/verrude/?CodAlumno=$CodAlumno","Imagen"=>"verrude.png"),
			array("Nombre"=>"CodigosAlumnos","Url"=>"codigos/alumnos/?CodAlumno=$CodAlumno","Imagen"=>"codigosalumnos.png"),
			
			
			
			
			array("Nombre"=>"ConfigurarNumeroCelulares","Url"=>"sms/revisardatos/?CodAlumno=$CodAlumno","Imagen"=>"sms.png"),
		);
	$i=0;
	foreach($men1 as $m){$i++;
    ?>
    
    <div class="span6 box">
    	<div class="box-header centrar"><?php echo $idioma[$m['Nombre']];?></div>
        <div class="box-content centrar">
        <a class="box-small-link" href="../../<?php echo $m['Url']?>" title="<?php echo $idioma['IrA']?> <?php echo $idioma[$m['Nombre']];?>">
        <img src="../../imagenes/submenu/<?php echo $m['Imagen']?>">
        </a>
        </div>
    </div>
    <?php
	if($i==2){
		$i=0;
	?>
    </div>
    <div class="row-fluid">
    <?php	
	}
}?>