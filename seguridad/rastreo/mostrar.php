<?php
session_start();
if(!empty($_POST)){
	define(RAIZ,"../../");
	$idiomaarchivo=$_SESSION['Idioma']!=""?$_SESSION['Idioma']:"es";
	if(!file_exists(RAIZ."idioma/".$idiomaarchivo.".php")){$idiomaarchivo="es";}
	include_once(RAIZ."idioma/".$idiomaarchivo.".php");	
	
	$Tiempo=$_POST['Tiempo'];
	$Nivel=$_POST['Nivel'];
	if($Nivel=="" && $_SESSION['Nivel']==2){
		$Nivel="2,3,4,5,6,7";	
	}
	$Fecha=date("Y-m-d",strtotime($_POST['Fecha']));
	include_once("../../class/lograstreo.php");
	include_once("../../class/alumno.php");
	include_once("../../class/docente.php");
	include_once("../../class/usuario.php");
	$lograstreo=new lograstreo;
	$usuariolog=new usuario;
	$alumnolog=new alumno;
	$docentelog=new docente;
	$logr=$lograstreo->mostrarNivelFecha($Nivel,$Fecha);
	//print_r($lograstreo->mostrarNivelFecha("",""));
	$cantidad=count($logr);
	$i=$cantidad;
	if($cantidad){
		?><table class="table table-hover table-bordered table-striped table-condensed">
        <thead>
        <tr><th colspan="6"><?php echo $idioma['Fecha']?>: <?php echo $_POST['Fecha']?></th></tr>
        <tr><th>N</th><th><?php echo $idioma['Usuario']?></th><th></th><th><?php echo $idioma['Datos']?></th><th>IP</th><th><?php echo $idioma['Hora']?></th></tr></thead>
        <?php foreach($logr as $lg){
			switch($lg['Nivel']){
			case "1":{$Usuario=$idioma["Administrador"];
						$ul=$usuariolog->mostrarDatos($lg['CodUsuario']);
						$ul=array_shift($ul);
						$Paterno=$ul['Paterno'];
						$Materno=$ul['Materno'];
						$Nombres=$ul['Nombres'];
			}break;
			case "2":{$Usuario=$idioma["Director"];
						$ul=$usuariolog->mostrarDatos($lg['CodUsuario']);
						$ul=array_shift($ul);
						$Paterno=$ul['Paterno'];
						$Materno=$ul['Materno'];
						$Nombres=$ul['Nombres'];
			}break;
			case "3":{$Usuario=$idioma["Docente"];
						$ul=$docentelog->mostrarDocente($lg['CodUsuario']);
						$ul=array_shift($ul);
						$Paterno=$ul['Paterno'];
						$Materno=$ul['Materno'];
						$Nombres=$ul['Nombres'];
			}break;
			case "4":{$Usuario=$idioma["Secretaria"];
						$ul=$usuariolog->mostrarDatos($lg['CodUsuario']);
						$ul=array_shift($ul);
						$Paterno=$ul['Paterno'];
						$Materno=$ul['Materno'];
						$Nombres=$ul['Nombres'];
			}break;
			case "5":{$Usuario=$idioma["Regente"];
						$ul=$usuariolog->mostrarDatos($lg['CodUsuario']);
						$ul=array_shift($ul);
						$Paterno=$ul['Paterno'];
						$Materno=$ul['Materno'];
						$Nombres=$ul['Nombres'];
			}break;
			case "6":{$Usuario=$idioma["PadreFamilia"];
						$ul=$alumnolog->mostrarDatosPersonales($lg['CodUsuario'],2);
						$ul=array_shift($ul);
						$Paterno=$ul['Paterno'];
						$Materno=$ul['Materno'];
						$Nombres=$ul['Nombres'];
			}break;
			case "7":{$Usuario=$idioma["Alumno"];
						$ul=$alumnolog->mostrarDatosPersonales($lg['CodUsuario'],2);
						$ul=array_shift($ul);
						$Paterno=$ul['Paterno'];
						$Materno=$ul['Materno'];
						$Nombres=$ul['Nombres'];
			}break;
			}
			?>
            <tr>
            	<td><?php echo $i?></td>
                <td><div class="pequeno">
				<strong><?php echo $Usuario?></strong>: <br><?php echo ucwords($Paterno." ".$Materno." ".$Nombres)?>
                </div></td>
                <td><div class="pequeno">
                <strong><?php echo $idioma['Archivo']?>:</strong> <?php echo $lg['Archivo']?><br><strong><?php echo $idioma['Referencia']?>:</strong> <?php echo $lg['Referencia']?>
                </div></td>
                <td><div class="pequeno">
                <strong>Get</strong>:<?php echo $lg['Get']?><br>
				<strong>Post</strong>:<?php echo $lg['Post']?>
                </div></td>
                <td><?php echo $lg['Ip']?></td>
                
                <td><?php echo $lg['HoraRegistro']?></td>
            </tr>
            <?php
		$i--;}
		?>
        </table>
		<?php
	}else{
	?>
    <div class="alert alert-error">
    	<?php echo $idioma['NoHayResultados']?>
    </div>
    <?php	
	}
}
?>