<?php
include_once("../login/check.php");
if(!empty($_POST)){
	include_once("../class/alumno.php");
	include_once("../class/tmp_alumno.php");
	include_once("../class/cuota.php");
	include_once("../class/documento.php");
	include_once("../class/config.php");
	include_once("../class/rude.php");
	include_once("../class/tmp_rude.php");
	$folder="../";
	$alumno=new alumno;
	$cuota=new cuota;
	$documento=new documento;
	$tmpalumno=new tmp_alumno;
	$conf=new config;
	$classrude=new rude;
	$tmp_rude=new tmp_rude;
	
	$CodAlu=$_POST['CodAlu'];

	$tmprude=$tmp_rude->mostrarDatos($CodAlu);
	$tmprude=array_shift($tmprude);
//	print_r($tmprude);	
//	exit();
	/**/
	//$cnf=$conf->mostrarConfig();
	
	
	$CodAlu=$_POST['CodAlu'];
	$Matricula=$_POST['Matricula'];
	$CodCurso=$_POST['Curso'];
	$Paterno=$_POST['Paterno'];
	$Materno=$_POST['Materno'];
	$Nombres=$_POST['Nombres'];
	$Sexo=$_POST['Sexo'];
	$LugarNac=$_POST['LugarNac'];
	$FechaNac=date("Y-m-d",strtotime($_POST['FechaNac']));
	$Ci=$_POST['Ci'];
	$CiExt=$_POST['CiExt'];
	$Zona=$_POST['Zona'];
	$Calle=$_POST['Calle'];
	$Numero=$_POST['Numero'];
	$TelefonoCasa=$_POST['TelefonoCasa'];
	$Celular=$_POST['Celular'];
	$CelularSMS=$_POST['CelularSMS'];
	$ActivarSMS=$_POST['ActivarSMS'];
	//
	$Procedencia=$_POST['Procedencia'];
	$Repitente=$_POST['Repitente'];
	$Traspaso=$_POST['Traspaso'];
	$Becado=$_POST['Becado'];
	$MontoBeca=$_POST['MontoBeca'];
	$MontoPagar=$_POST['MontoPagar'];
	$Retirado=$_POST['Retirado'];
	$FechaRetiro=$_POST['FechaRetiro'];
	$Rude=$_POST['Rude'];
	$Observaciones=$_POST['Observaciones'];
	//=$_POST[''];
	$ApellidosPadre=$_POST['ApellidosPadre'];
	$NombrePadre=$_POST['NombrePadre'];
	$CiPadre=$_POST['CiPadre'];
	$CiExtP=$_POST['CiExtP'];
	$OcupPadre=$_POST['OcupPadre'];
	$CelularP=$_POST['CelularP'];
	$ApellidosMadre=$_POST['ApellidosMadre'];
	$NombreMadre=$_POST['NombreMadre'];
	$CiMadre=$_POST['CiMadre'];
	$CiExtM=$_POST['CiExtM'];
	$OcupMadre=$_POST['OcupMadre'];
	$CelularM=$_POST['CelularM'];
	$Email=$_POST['Email'];
	//
	$Nit=$_POST['Nit'];
	$FacturaA=$_POST['FacturaA'];
	//
	$CertificadoNac=$_POST['CertificadoNac'];
	$LibretaEsc=$_POST['LibretaEsc'];
	$LibretaVac=$_POST['LibretaVac'];
	$CedulaId=$_POST['CedulaId'];
	$CedulaIdP=$_POST['CedulaIdP'];
	$CedulaIdM=$_POST['CedulaIdM'];
	$ObservacionesDoc=$_POST['ObservacionesDoc'];
	$autoIncrement=$alumno->estadoTabla();
	$CodAlumno=$autoIncrement['Auto_increment'];
	$FechaInsc=date("Y-m-d");
	$HoraIns=date(" H:i:s");
	//Obtenemos el Codigo de Barra
	$cnf=($conf->mostrarConfig("CodBarra"));
	$CodBarra=trim($cnf['Valor']).$CodAlumno;
	$CodUsuarioAlumno=trim(mb_strtolower(quitarSimbolos($Paterno),"UTF-8")).$CodAlumno;
	
	
	$Password=rand(1000,9999);
	$PasswordP=rand(1000,9999);
	$UsuarioPadre=usuarioPadre($CiPadre,$CiMadre);
	
	if($CodCurso==1){
		$cnf=$conf->mostrarConfig("MontoKinder");	
		$MontoGeneral=$cnf['Valor'];
	}else{
		$cnf=$conf->mostrarConfig("MontoGeneral");	
		$MontoGeneral=$cnf['Valor'];	
	}
	
	$valuesDoc=array('CodDocumento'=>'Null',
					'CodAlumno'=>$CodAlumno,
					'CertificadoNac'=>$CertificadoNac,
					'LibretaEsc'=>$LibretaEsc,
					'LibretaVac'=>$LibretaVac,
					'CedulaId'=>$CedulaId,
					'CedulaIdP'=>$CedulaIdP,
					'CedulaIdM'=>$CedulaIdM,
					'Observaciones'=>"LOWER('$ObservacionesDoc')"
					);

	$valuesAl=array('CodAlumno'=>"$CodAlumno",
				'Paterno'=>"LOWER('$Paterno')",
				'Materno'=>"LOWER('$Materno')",
				'Nombres'=>"LOWER('$Nombres')",
				'Sexo'=>$Sexo,
				'LugarNac'=>"LOWER('$LugarNac')",
				'FechaNac'=>"'$FechaNac'",
				'Ci'=>"'$Ci'",
				'CiExt'=>"'$CiExt'",
				'Zona'=>"LOWER('$Zona')",
				'Calle'=>"LOWER('$Calle')",
				'Numero'=>"LOWER('$Numero')",
				'TelefonoCasa'=>"'$TelefonoCasa'",
				'Celular'=>"'$Celular'",
				'CelularSMS'=>"'$CelularSMS'",
				'ActivarSMS'=>"'$ActivarSMS'",
				'Procedencia'=>"LOWER('$Procedencia')",
				'Repitente'=>$Repitente,
				'Traspaso'=>$Traspaso,
				'Becado'=>$Becado,
				'MontoBeca'=>$MontoBeca,
				'Retirado'=>$Retirado,
				'FechaRetiro'=>"'$FechaRetiro'",
				'Rude'=>"'$Rude'",
				'Observaciones'=>"LOWER('$Observaciones')",
				'ApellidosPadre'=>"LOWER('$ApellidosPadre')",
				'NombrePadre'=>"LOWER('$NombrePadre')",
				'CiPadre'=>"'$CiPadre'",
				'CiExtP'=>"'$CiExtP'",
				'OcupPadre'=>"LOWER('$OcupPadre')",
				'CelularP'=>"'$CelularP'",
				'ApellidosMadre'=>"LOWER('$ApellidosMadre')",
				'NombreMadre'=>"LOWER('$NombreMadre')",
				'CiMadre'=>"'$CiMadre'",
				'CiExtM'=>"'$CiExtM'",
				'OcupMadre'=>"LOWER('$OcupMadre')",
				'CelularM'=>"'$CelularM'",
				'Email'=>"LOWER('$Email')",
				'Nit'=>"'$Nit'",
				'FacturaA'=>"LOWER('$FacturaA')",
				'CodCurso'=>$CodCurso,
				'FechaIns'=>"'$FechaInsc'",
				'HoraIns'=>"'$HoraIns'",
				'UsuarioAlumno'=>"'$CodUsuarioAlumno'",
				'CodBarra'=>"'$CodBarra'",
				'Password'=>"'$Password'",
				'PasswordP'=>"'$PasswordP'",
				'UsuarioPadre'=>"'$UsuarioPadre'"
			);
	
	$fechaCuota=date("Y-m-d H:i:s");
	for($i=1;$i<=10;$i++){
		if($i==1){
			$valuesCuota=array('CodCuota'=>'NULL',
							'CodAlumno'=>$CodAlumno,
							'Numero'=>$i,
							'MontoPagar'=>$MontoGeneral,
							'Factura'=>"''",
							'Cancelado'=>0,
							'Fecha'=>"'$fechaCuota'",
							'Observaciones'=>"''"
							);
		}else{
			$valuesCuota=array('CodCuota'=>'NULL',
							'CodAlumno'=>$CodAlumno,
							'Numero'=>$i,
							'MontoPagar'=>$MontoPagar,
							'Factura'=>"''",
							'Cancelado'=>0,
							'Fecha'=>"'$fechaCuota'",
							'Observaciones'=>"''"
							);	
		}
		//echo "<br>";
		//print_r($valuesCuota);
		$cuota->guardar($valuesCuota);
	}
	if($NombreFoto=subirArchivo($_FILES['Foto'],"imagenes/alumnos/")){
		$valuesAl=array_merge(array("Foto"=>"'$NombreFoto'"),$valuesAl);	
	}
	$alumno->insertarAlumno($valuesAl);
	$documento->guardarDocumento($valuesDoc);
	
	$valuesRude=array(
		'CodAlumno'=>$CodAlumno,
		'PaisN'=>"'".$tmprude['PaisN']."'",
		'ProvinciaN'=>"'".$tmprude['ProvinciaN']."'",
		'LocalidadN'=>"'".$tmprude['LocalidadN']."'",
		'Documento'=>$tmprude['Documento'],
		'CertOfi'=>"'".$tmprude['CertOfi']."'",
		'CertLibro'=>"'".$tmprude['CertLibro']."'",
		'CertPartida'=>"'".$tmprude['CertPartida']."'",
		'CertFolio'=>"'".$tmprude['CertFolio']."'",
		'Paralelo'=>"'".$tmprude['Paralelo']."'",
		'Turno'=>"'".$tmprude['Turno']."'",
		'CodigoSie'=>"''",
		'NombreUnidad'=>"''",
		'ProvinciaE'=>"'".$tmprude['ProvinciaE']."'",
		'MunicipioE'=>"'".$tmprude['MunicipioE']."'",
		'ComunidadE'=>"'".$tmprude['ComunidadE']."'",
		'LenguaMater'=>"'".$tmprude['LenguaMater']."'",
		'CastellanoI'=>$tmprude['CastellanoI'],
		'AymaraI'=>$tmprude['AymaraI'],
		'InglesI'=>$tmprude['InglesI'],
		'PerteneceA'=>"'".$tmprude['PerteneceA']."'",
		'CentroSalud'=>$tmprude['CentroSalud'],
		'VecesCentro'=>"'".$tmprude['VecesCentro']."'",
		'Discapacidad'=>"'".$tmprude['Discapacidad']."'",
		'AguaDomicilio'=>$tmprude['AguaDomicilio'],
		'Electricidad'=>$tmprude['Electricidad'],
		'Alcantarillado'=>$tmprude['Alcantarillado'],
		'Trabaja'=>"'".$tmprude['Trabaja']."'",
		'InternetCasa'=>$tmprude['InternetCasa'],
		'Transporte'=>"'".$tmprude['Transporte']."'",
		'TiempoLlegada'=>"'".$tmprude['TiempoLlegada']."'",
		'InstruccionP'=>"'".$tmprude['InstruccionP']."'",
		'IdiomaP'=>"'".$tmprude['IdiomaP']."'",
		'ParentescoP'=>"'".$tmprude['ParentescoP']."'",
		'InstruccionM'=>"'".$tmprude['InstruccionM']."'",
		'IdiomaM'=>"'".$tmprude['IdiomaM']."'",
		'Lugar'=>"'".$tmprude['Lugar']."'",
		'FechaReg'=>"'".date("Y-m-d H:i:s")."'",
	);
	
	$classrude->insertarAlumno($valuesRude);
	
	
	
	$tmpalumno->actualizarVisor($CodAlu);
	header("Location:../alumno/boletadatos/?CodAlumno=".$CodAlumno);
}
?>