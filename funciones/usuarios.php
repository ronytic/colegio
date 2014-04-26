<?php

function DatosUsuario($Nivel,$CodUsuario){
	global $idioma;
	include_once("../../class/logusuario.php");
	include_once("../../class/usuario.php");
	include_once("../../class/docente.php");
	include_once("../../class/alumno.php");
	$logusuario=new logusuario;
	$usuario=new usuario;
	$docente=new docente;
	$alumno=new alumno;
	switch($Nivel){
		case "1":{$Usuario=$idioma["Administrador"];
					$ul=$usuario->mostrarDatos($CodUsuario);
					$ul=array_shift($ul);
					$tipousuario=$idioma['Administrador'];
					$Foto=$folder."imagenes/usuario/".$ul['Foto'];
					$Paterno=$ul['Paterno'];
					$Materno=$ul['Materno'];
					$Nombres=$ul['Nombres'];
		}break;
		case "2":{$Usuario=$idioma["Director"];
					$ul=$usuario->mostrarDatos($CodUsuario);
					$ul=array_shift($ul);
					$tipousuario=$idioma['Director'];
					$Foto=$folder."imagenes/usuario/".$ul['Foto'];
					$Paterno=$ul['Paterno'];
					$Materno=$ul['Materno'];
					$Nombres=$ul['Nombres'];
		}break;
		case "3":{$Usuario=$idioma["Docente"];
					$ul=$docente->mostrarDocente($CodUsuario);
					$ul=array_shift($ul);
					$tipousuario=$idioma['Docente'];
					$Foto=$folder."imagenes/docentes/".$ul['Foto'];
					$Paterno=$ul['Paterno'];
					$Materno=$ul['Materno'];
					$Nombres=$ul['Nombres'];
		}break;
		case "4":{$Usuario=$idioma["Secretaria"];
					$ul=$usuario->mostrarDatos($CodUsuario);
					$ul=array_shift($ul);
					$tipousuario=$idioma['Secretaria'];
					$Foto=$folder."imagenes/usuario/".$ul['Foto'];
					$Paterno=$ul['Paterno'];
					$Materno=$ul['Materno'];
					$Nombres=$ul['Nombres'];
		}break;
		case "5":{$Usuario=$idioma["Regente"];
					$ul=$usuario->mostrarDatos($CodUsuario);
					$ul=array_shift($ul);
					$tipousuario=$idioma['Regente'];
					$Foto=$folder."imagenes/usuario/".$ul['Foto'];
					$Paterno=$ul['Paterno'];
					$Materno=$ul['Materno'];
					$Nombres=$ul['Nombres'];
		}break;
		case "6":{$Usuario=$idioma["PadreFamilia"];
					$ul=$alumno->mostrarTodoDatos($CodUsuario,2);
					$ul=array_shift($ul);
					$tipousuario=$idioma['PadreFamilia'];
					$Foto=$folder."imagenes/alumnos/".$ul['Foto'];
					$Paterno=$ul['Paterno'];
					$Materno=$ul['Materno'];
					$Nombres=$ul['Nombres'];
		}break;
		case "7":{$Usuario=$idioma["Alumno"];
					$ul=$alumno->mostrarTodoDatos($CodUsuario,2);
					$ul=array_shift($ul);
					$tipousuario=$idioma['Alumno'];
					$Foto=$folder."imagenes/alumnos/".$ul['Foto'];
					$Paterno=$ul['Paterno'];
					$Materno=$ul['Materno'];
					$Nombres=$ul['Nombres'];
		}break;
	}
	$retorno=array("TipoUsuario"=>$tipousuario,
		"Foto"=>$Foto,
		"Paterno"=>$Paterno,
		"Materno"=>$Materno,
		"Nombres"=>$Nombres,
		
	);
	return $retorno;
}
?>