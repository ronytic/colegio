<?php
include_once("../../login/check.php");
include_once("../../class/docente.php");
include_once("../../class/logusuario.php");
$titulo="Frecuencia de Acceso de Docentes";
$folder="../../";
$docente=new docente;
$logusuario=new logusuario;
$CodDocente=$_GET['Cod'];
$doc=array_shift($docente->mostrarDocente($CodDocente));
?>
<?php include_once("../../cabecerahtml.php"); ?>

<?php include_once("../../cabecera.php"); ?>
<div class="container_12" id="cuerpo">
	<div class="box-header">
    	<h2><i class="icon-signal"></i><span class="break"></span><?php echo $idioma['FrecuenciaAcceso']?></h2>
    </div>
    <div class="box-content">
    	Nombre Docente:<strong><?php echo ucfirst($doc['Paterno'])?> <?php echo ucfirst($doc['Materno'])?> <?php echo ucfirst($doc['Nombres'])?></strong>
        <a href="./" class="btn btn-info btn-mini"><?php echo $idioma['Volver']?></a>
        <hr>
    	<table class="table table-bordered table-condensed table-hover table-striped">
        	<tr class="cabecera"><th>Nº</td><th><?php echo $idioma['Dia']?></th><th><?php echo $idioma['FechaAcceso']?></th><th><?php echo $idioma['HoraAcceso']?></th></tr>
            <?php
			$i=0;

				foreach($logusuario->mostrarUsoDocente($CodDocente) as $lu){$i++;
		
				
				if($restodeFecha!=0){
					$dia=$restodeFecha/60/60/24;
				}else{
					$dia=0;	
				}

			?>
            	<tr class="contenido"><td class="der"><?php echo $i;?></td><td><?php echo utf8_encode(strftime("%A",strtotime( $lu['FechaLog'])));?></td><td><?php echo date("d-m-Y",strtotime($lu['FechaLog']));?></td><td class="der"><?php echo $lu['HoraLog'];?></td></tr>
            <?php	
				}
			?>
        </table>
    </div>
    </div>
    <div class="clear"></div>
</div>
<?php include_once("../../pie.php"); ?>