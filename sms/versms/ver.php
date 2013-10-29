<?php
include_once("../../login/check.php");
include_once("../../class/smsenviado.php");
include_once("../../class/usuario.php");
include_once("../../class/docente.php");
include_once("../../class/alumno.php");
$folder="../../";
$smsenviado=new smsenviado;
$usuario=new usuario;
$docente=new docente;
$alumno=new alumno;
if($_SESSION['Nivel']==1){
	$Tipo="";
}else{
	$Tipo="1";
}
extract($_POST);
$Fecha=fecha2Str($Fecha,0);
$smsu=$smsenviado->mostrarUsuariosNivel(0,$Nivel,$Fecha);
?>
<?php
if(!count($smsu)){
?>
<div class="alert alert-info"><?php echo $idioma['NoExisteAccesos']?></div>
<?php
exit();	
}
?>
<table class="table">
<?php
foreach($smsu as $lu){$i++;
	switch($lu['Nivel']){
		case "1":{$Usuario=$idioma["Administrador"];
					$ul=$usuario->mostrarDatos($lu['CodUsuario']);
					$ul=array_shift($ul);
					$tipousuario=$idioma['Administrador'];
					$Foto=$folder."imagenes/usuario/".$ul['Foto'];
					$Paterno=$ul['Paterno'];
					$Materno=$ul['Materno'];
					$Nombres=$ul['Nombres'];
		}break;
		case "2":{$Usuario=$idioma["Director"];
					$ul=$usuario->mostrarDatos($lu['CodUsuario']);
					$ul=array_shift($ul);
					$tipousuario=$idioma['Director'];
					$Foto=$folder."imagenes/usuario/".$ul['Foto'];
					$Paterno=$ul['Paterno'];
					$Materno=$ul['Materno'];
					$Nombres=$ul['Nombres'];
		}break;
		case "3":{$Usuario=$idioma["Docente"];
					$ul=$docente->mostrarDocente($lu['CodUsuario']);
					$ul=array_shift($ul);
					$tipousuario=$idioma['Docente'];
					$Foto=$folder."imagenes/docentes/".$ul['Foto'];
					$Paterno=$ul['Paterno'];
					$Materno=$ul['Materno'];
					$Nombres=$ul['Nombres'];
		}break;
		case "4":{$Usuario=$idioma["Secretaria"];
					$ul=$usuario->mostrarDatos($lu['CodUsuario']);
					$ul=array_shift($ul);
					$tipousuario=$idioma['Secretaria'];
					$Foto=$folder."imagenes/usuario/".$ul['Foto'];
					$Paterno=$ul['Paterno'];
					$Materno=$ul['Materno'];
					$Nombres=$ul['Nombres'];
		}break;
		case "5":{$Usuario=$idioma["Regente"];
					$ul=$usuario->mostrarDatos($lu['CodUsuario']);
					$ul=array_shift($ul);
					$tipousuario=$idioma['Regente'];
					$Foto=$folder."imagenes/usuario/".$ul['Foto'];
					$Paterno=$ul['Paterno'];
					$Materno=$ul['Materno'];
					$Nombres=$ul['Nombres'];
		}break;
		case "6":{$Usuario=$idioma["PadreFamilia"];
					$ul=$alumno->mostrarTodoDatos($lu['CodUsuario'],2);
					$ul=array_shift($ul);
					$tipousuario=$idioma['PadreFamilia'];
					$Foto=$folder."imagenes/alumnos/".$ul['Foto'];
					$Paterno=$ul['Paterno'];
					$Materno=$ul['Materno'];
					$Nombres=$ul['Nombres'];
		}break;
		case "7":{$Usuario=$idioma["Alumno"];
					$ul=$alumno->mostrarTodoDatos($lu['CodUsuario'],2);
					$ul=array_shift($ul);
					$tipousuario=$idioma['Alumno'];
					$Foto=$folder."imagenes/alumnos/".$ul['Foto'];
					$Paterno=$ul['Paterno'];
					$Materno=$ul['Materno'];
					$Nombres=$ul['Nombres'];
		}break;
	}
	//print_r($ul);
	$F="../../".$Foto;
	
	if(!is_file($F)){
		
		$F=$folder."imagenes/usuario/0.jpg";
		//echo $F;
	}
	?>
    	
        <tr>
        
        <td>
        <span class="label label-warning"><?php echo $i?></span> <span class="label label-info"> <strong><?php echo $tipousuario?>:</strong></span> <a"><?php echo capitalizar($Paterno)?> <?php echo capitalizar($Materno)?> <?php echo capitalizar(($Nombres))?></a><br>
        <strong><?php echo $idioma['Fecha']?>:</strong> <?php echo fecha2Str($lu['FechaRegistro'])?>
        <br>
        <strong><?php echo $idioma['Hora']?>:</strong> <?php echo $lu['HoraRegistro']?>
        <br>
        <strong><?php echo $idioma['NumeroCelular']?>:</strong> <?php echo $lu['Numero']?>
        <br>
        <strong><?php echo $idioma['Mensaje']?>:</strong> <?php echo $lu['Mensaje']?>
        </td>
        </tr>
       

    <?php
}
?>
 </table>