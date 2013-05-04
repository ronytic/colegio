<?php
include_once("../../login/check.php");
include_once("../../class/docente.php");
include_once("../../class/logusuario.php");
$titulo="NFrecuenciaAccesos";
$folder="../../";
$docente=new docente;
$logusuario=new logusuario;
?>
<?php include_once("../../cabecerahtml.php"); ?>

<?php include_once("../../cabecera.php"); ?>
<div class="box span12">
	<div class="box-header"><h2><i class="icon-signal"></i><span class="break"></span><?php echo $idioma['FrecuenciaAcceso']?></h2></div>
    <div class="box-content">
        <table class="table table-condensed table-striped table-hover table-bordered">
        <thead>
        <tr class="cabecera"><th>Nº</th><th><?php echo $idioma['Docente']?></th><th><?php echo $idioma['CantidadAcceso']?></th><th><?php echo $idioma['UltimoAcceso']?></th></tr>
        </thead>
        <?php
        $i=0;
        foreach($docente->listar() as $doc){
            $i++;
            $lu=$logusuario->mostrarUsoDocente($doc['CodDocente']);
            $Cantidad=count($lu);
            $lu=array_shift($lu);
            $restodeFecha=strtotime(date("Y-m-d"))-strtotime($lu['FechaLog']);
            if($restodeFecha!=0){
                $dia=$restodeFecha/60/60/24;
            }else{
                $dia=0;	
            }

        ?>
            <tr class="contenido <?php if($dia>5)echo "error";elseif($dia>2) echo "warning";else echo "success"?>">
            	<td><?php echo $i;?></td>
                <td><?php echo $doc['Paterno']?> <?php echo $doc['Materno']?> <?php echo $doc['Nombres']?></td>
                <td class="centrar"><?php echo $Cantidad;?></td>
                <td class="der"><?php echo fecha2Str($lu['FechaLog']);?></td>
                <td><a class="btn btn-info btn-small " href="fechas.php?Cod=<?php echo $doc['CodDocente']?>"><?php echo $idioma['VerFechas']?></a></td></tr>
        <?php	
        }
        ?>
        </table>
    </div>
</div>




<?php include_once("../../pie.php"); ?>