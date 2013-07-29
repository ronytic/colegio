<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="NFrecuenciaAccesosSistemaPPFF";

include_once("../../class/config.php");
include_once("../../class/alumno.php");
include_once("../../class/curso.php");
$config=new config;
$alumno=new alumno;
$curso=new curso;

$IpInternet=($config->mostrarConfig("IpInternet",1));
$PuertoInternet=($config->mostrarConfig("PuertoInternet",1));
$UsuarioInternet=($config->mostrarConfig("UsuarioInternet",1));
$ContrasenaInternet=($config->mostrarConfig("ContrasenaInternet",1));
$BaseDatosInternet=($config->mostrarConfig("BaseDatosInternet",1));


$local=mysql_connect($host,$user,$pass);
mysql_select_db($database,$local);

$inter=mysql_connect($IpInternet.":".$PuertoInternet,$UsuarioInternet,$ContrasenaInternet);
mysql_select_db($BaseDatosInternet,$inter);

$resinter=mysql_query("SELECT *, count(*) as Cantidad  FROM `lograstreo` WHERE `Nivel` IN (6,7) GROUP BY `CodUsuario` ORDER BY count(*) DESC",$inter);
include_once($folder."cabecerahtml.php");
?>
<?php include_once($folder."cabecera.php");?>
<div class="span12">
    	<div class="box-header"><h2><?php echo $idioma['Reporte']?></h2></div>
        <div class="box-content">
        	<table class="table table-bordered table-hover table-striped">
            <thead>
            <tr><th>Nº</th><th><?php echo $idioma['Paterno']?></th><th><?php echo $idioma['Materno']?></th><th><?php echo $idioma['Nombres']?></th><th><?php echo $idioma['Curso']?></th><th><?php echo $idioma['Cantidad']?></th><th><?php echo $idioma['UltimoAcceso']?></th></tr>
            </thead>
        	<?php 
			$i=0;
			$cantidad=0;
			while($reginter=mysql_fetch_array($resinter)){
				$cantidad+=$reginter['Cantidad']*2;
				$i++;
				$al=$alumno->mostrarDatosPersonales($reginter['CodUsuario']);
				$al=array_shift($al);
				$c=$curso->mostrarCurso($al['CodCurso']);
				$c=array_shift($c);
				$sql="SELECT FechaRegistro,HoraRegistro FROM lograstreo WHERE CodUsuario=".$reginter['CodUsuario']." ORDER BY FechaRegistro DESC";
				$res1=mysql_query($sql,$inter);
				$reg1=mysql_fetch_array($res1);
				?>
                <tr>
                	<td><?php echo $i;?></td>
                    <td><?php echo ucwords($al['Paterno'])?></td>
                    <td><?php echo ucwords($al['Materno'])?></td>
                    <td><?php echo ucwords($al['Nombres'])?></td>
                    <td><?php echo $c['Nombre']?></td>
                    <td class="centrar"><?php echo $reginter['Cantidad']*2?></td>
                    <td><?php echo $reg1['FechaRegistro']?> - <?php echo $reg1['HoraRegistro']?></td>
                </tr>
                <?php
			}?>
            <tr class="info"><td colspan="5"></td><td class="centrar resaltar"><?php echo $cantidad?></td><td></td></tr>
            </table>
        </div>
</div>
<?php include_once($folder."pie.php");?>