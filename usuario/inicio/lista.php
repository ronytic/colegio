<?php
include_once("../../login/check.php");
include_once("../../class/logusuario.php");
include_once("../../class/usuario.php");
include_once("../../class/docente.php");
include_once("../../class/alumno.php");
$folder="";
$logusuario=new logusuario;
$usuario=new usuario;
$docente=new docente;
$alumno=new alumno;
if($_SESSION['Nivel']==1){
	$Tipo="";
}else{
	$Tipo="1";
}
$logu=$logusuario->mostrarUsuariosCantidad(4,$Tipo);
?><ul class="dashboard-list">
<?php
foreach($logu as $lu){
	switch($lu['Nivel']){
		case "1":{$Usuario=$idioma["Administrador"];
					$ul=$usuario->mostrarDatos($lu['CodUsuario']);
					$ul=array_shift($ul);
					$tipousuario=$idioma['Administrador'];
					$Foto="imagenes/usuario/".$ul['Foto'];
					$Paterno=$ul['Paterno'];
					$Materno=$ul['Materno'];
					$Nombres=$ul['Nombres'];
		}break;
		case "2":{$Usuario=$idioma["Director"];
					$ul=$usuario->mostrarDatos($lu['CodUsuario']);
					$ul=array_shift($ul);
					$tipousuario=$idioma['Director'];
					$Foto="imagenes/usuario/".$ul['Foto'];
					$Paterno=$ul['Paterno'];
					$Materno=$ul['Materno'];
					$Nombres=$ul['Nombres'];
		}break;
		case "3":{$Usuario=$idioma["Docente"];
					$ul=$docente->mostrarDocente($lu['CodUsuario']);
					$ul=array_shift($ul);
					$tipousuario=$idioma['Docente'];
					$Foto="imagenes/docentes/".$ul['Foto'];
					$Paterno=$ul['Paterno'];
					$Materno=$ul['Materno'];
					$Nombres=$ul['Nombres'];
		}break;
		case "4":{$Usuario=$idioma["Secretaria"];
					$ul=$usuario->mostrarDatos($lu['CodUsuario']);
					$ul=array_shift($ul);
					$tipousuario=$idioma['Secretaria'];
					$Foto="imagenes/usuario/".$ul['Foto'];
					$Paterno=$ul['Paterno'];
					$Materno=$ul['Materno'];
					$Nombres=$ul['Nombres'];
		}break;
		case "5":{$Usuario=$idioma["Regente"];
					$ul=$usuario->mostrarDatos($lu['CodUsuario']);
					$ul=array_shift($ul);
					$tipousuario=$idioma['Regente'];
					$Foto="imagenes/usuario/".$ul['Foto'];
					$Paterno=$ul['Paterno'];
					$Materno=$ul['Materno'];
					$Nombres=$ul['Nombres'];
		}break;
		case "6":{$Usuario=$idioma["PadreFamilia"];
					$ul=$alumno->mostrarTodoDatos($lu['CodUsuario'],2);
					$ul=array_shift($ul);
					$tipousuario=$idioma['PadreFamilia'];
					$Foto="imagenes/alumnos/".$ul['Foto'];
					$Paterno=$ul['Paterno'];
					$Materno=$ul['Materno'];
					$Nombres=$ul['Nombres'];
		}break;
		case "7":{$Usuario=$idioma["Alumno"];
					$ul=$alumno->mostrarTodoDatos($lu['CodUsuario'],2);
					$ul=array_shift($ul);
					$tipousuario=$idioma['Alumno'];
					$Foto="imagenes/alumnos/".$ul['Foto'];
					$Paterno=$ul['Paterno'];
					$Materno=$ul['Materno'];
					$Nombres=$ul['Nombres'];
		}break;
	}
	//print_r($ul);
	$F="../../".$Foto;
	$existe= is_file($F);
	$F="".$Foto;
	if(!$existe){
		
		$F=$folder."imagenes/usuario/0.jpg";
		//echo $F;
	}
	?>
    <li>
        <a>
            <img class="dashboard-avatar" alt="" src="<?php echo $F?>">
        </a>
        <span class="label label-info"><strong><?php echo $tipousuario?>:</strong></span> <a"><?php echo capitalizar($Paterno)?> <?php echo capitalizar(acortarPalabra($Nombres))?></a><br>
        <strong><?php echo $idioma['Fecha']?>:</strong> <?php echo fecha2Str($lu['FechaLog'])?><br>
        <strong><?php echo $idioma['Hora']?>:</strong> <?php echo $lu['HoraLog']?>
    </li>
    <?php
}
?></ul>