<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	/*echo "<pre>";
	print_r($_POST);
	echo "</pre>";*/
	include_once("../../class/rude.php");
	include_once("../../class/alumno.php");
	include_once("../funciones.php");
	include_once("../../class/documento.php");
	$rude=new rude;
	$alumno=new alumno;
	$doc=new documento;
	$fechaReg=date("Y-m-d H:i:s");
	
	$values=array("CodRude"=>"NULL",
		"CodAlumno"=>$_POST['CodAlumno'],
		"PaisN"=>"'".mb_strtolower($_POST['paisNacA'],"UTF-8")."'",
		"ProvinciaN"=>"'".mb_strtolower($_POST['provinciaNacA'],"UTF-8")."'",
		"LocalidadN"=>"'".mb_strtolower($_POST['localidadNacA'],"UTF-8")."'",
		"Documento"=>1,
		"CertOfi"=>"'{$_POST['oficialiaA']}'",
		"CertLibro"=>"'{$_POST['libroA']}'",
		"CertPartida"=>"'{$_POST['partidaA']}'",
		"CertFolio"=>"'{$_POST['folioA']}'",
		"Paralelo"=>"'A'",
		"Turno"=>"'M'",
		"CodigoSie"=>"'{$_POST['codigoSIEA']}'",
		"NombreUnidad"=>"'".mb_strtolower($_POST['unidadEducativaA'],"UTF-8")."'",
		"ProvinciaE"=>"'".mb_strtolower($_POST['provinciaA'],"UTF-8")."'",
		"MunicipioE"=>"'".mb_strtolower($_POST['seccionA'],"UTF-8")."'",
		"ComunidadE"=>"'".mb_strtolower($_POST['localidadA'],"UTF-8")."'",
		"LenguaMater"=>"'{$_POST['lenguaMaterna']}'",
		"CastellanoI"=>$_POST['lenguaCastellano'],
		"AymaraI"=>$_POST['lenguaAymara'],
		"InglesI"=>$_POST['lenguaIngles'],
		"PerteneceA"=>"'{$_POST['identificaA']}'",
		"CentroSalud"=>$_POST['centroSalud'],
		"VecesCentro"=>"'{$_POST['vecesSalud']}'",
		"Discapacidad"=>"'{$_POST['deficiencia']}'",
		"AguaDomicilio"=>$_POST['aguaPotable'],
		"Electricidad"=>$_POST['electricidad'],
		"Alcantarillado"=>$_POST['alcantarillado'],
		"Trabaja"=>"'{$_POST['trabaja']}'",
		"InternetCasa"=>$_POST['internet'],
		"Transporte"=>"'{$_POST['traslado']}'",
		"TiempoLlegada"=>"'{$_POST['tiempo']}'",
		"InstruccionP"=>"'{$_POST['instruccionP']}'",
		"IdiomaP"=>"'{$_POST['idiomaP']}'",
		"ParentescoP"=>"'{$_POST['parentescoP']}'",
		"InstruccionM"=>"'{$_POST['instruccionM']}'",
		"IdiomaM"=>"'{$_POST['idiomaM']}'",
		"Lugar"=>"'EL ALTO'",
		"FechaReg"=>"'$fechaReg'"
	);
	$usuarioPadre=usuarioPadre($_POST['CedulaPadre'],$_POST['CedulaMadre']);
	$valuesAlumno=array("Paterno"=>"'".mb_strtolower($_POST['paterno'],"UTF-8")."'",
						"Materno"=>"'".mb_strtolower($_POST['materno'],"UTF-8")."'",
						"Nombres"=>"'".mb_strtolower($_POST['nombres'],"UTF-8")."'",
						"LugarNac"=>"'".mb_strtolower($_POST['departamentoNacA'],"UTF-8")."'",
						"FechaNac"=>"'".fecha2Str($_POST['fechaNac'],0)."'",
						"Ci"=>"'{$_POST['numeroDoc']}'",
						"Sexo"=>$_POST['sexo'],
						"Zona"=>"'".mb_strtolower($_POST['zonaA'],"UTF-8")."'",
						"Calle"=>"'".mb_strtolower($_POST['calleA'],"UTF-8")."'",
						"Numero"=>"'".mb_strtolower($_POST['numeroViviendaA'],"UTF-8")."'",
						"CodCurso"=>$_POST['curso'],
						"TelefonoCasa"=>"'{$_POST['telefonoA']}'",
						"Celular"=>"'{$_POST['celularA']}'",
						"Rude"=>"'{$_POST['rude']}'",
						
						"ApellidosPadre"=>"'".mb_strtolower($_POST['ApellidosP'],"UTF-8")."'",
						"NombrePadre"=>"'".mb_strtolower($_POST['nombresP'],"UTF-8")."'",
						"CiPadre"=>"'".mb_strtolower($_POST['CedulaPadre'],"UTF-8")."'",
						"OcupPadre"=>"'".mb_strtolower($_POST['ocupacionP'],"UTF-8")."'",
						"CelularP"=>"'".mb_strtolower($_POST['telefonoP'],"UTF-8")."'",
						
						"ApellidosMadre"=>"'".mb_strtolower($_POST['paternoM'],"UTF-8")."'",
						"NombreMadre"=>"'".mb_strtolower($_POST['nombresM'],"UTF-8")."'",
						"CiMadre"=>"'".mb_strtolower($_POST['CedulaMadre'],"UTF-8")."'",
						"OcupMadre"=>"'".mb_strtolower($_POST['ocupacionM'],"UTF-8")."'",
						"CelularM"=>"'".mb_strtolower($_POST['telefonoM'],"UTF-8")."'",
						"UsuarioPadre"=>"'$usuarioPadre'"
						);
	//print_r($valuesAlumno);
	$alumno->actualizarDatosAlumno($valuesAlumno,$_POST['CodAlumno']);
	$ru=$rude->mostrarTodoDatos($_POST['CodAlumno']);
	if(count($ru)==0){
		$rude->insertarAlumno($values);
	}//else{echo "Duplicado";}

	/*DOCUMENTOS*/
	$CertificadoNac=$_POST['CertificadoNac'];if($CertificadoNac=="on")$CertificadoNac=1;else $CertificadoNac=0;
	$LibretaEsc=$_POST['LibretaEsc'];if($LibretaEsc=="on")$LibretaEsc=1;else $LibretaEsc=0;
	$LibretaVac=$_POST['LibretaVac'];if($LibretaVac=="on")$LibretaVac=1;else $LibretaVac=0;
	$CedulaId=$_POST['CedulaId'];if($CedulaId=="on")$CedulaId=1;else $CedulaId=0;
	$CedulaIdP=$_POST['CedulaIdP'];if($CedulaIdP=="on")$CedulaIdP=1;else $CedulaIdP=0;
	$CedulaIdM=$_POST['CedulaIdM'];if($CedulaIdM=="on")$CedulaIdM=1;else $CedulaIdM=0;
	$ObservacionesDoc=$_POST['ObservacionesDoc'];
	$valuesDoc=array('CertificadoNac'=>$CertificadoNac,
					'LibretaEsc'=>$LibretaEsc,
					'LibretaVac'=>$LibretaVac,
					'CedulaId'=>$CedulaId,
					'CedulaIdP'=>$CedulaIdP,
					'CedulaIdM'=>$CedulaIdM,
					'Observaciones'=>"LOWER('$ObservacionesDoc')"
					);
	$doc->actualizarDocumento($valuesDoc,$_POST['CodAlumno']);
	/*FIN DOCUMENTOS*/
	header("Location:../../impresion/rude/verrude.php?CodAlumno={$_POST['CodAlumno']}");
}
?>