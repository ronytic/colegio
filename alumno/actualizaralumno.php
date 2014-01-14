<?php
include_once("../login/check.php");
include_once("../class/alumno.php");
include_once("../class/cuota.php");
include_once("../class/documento.php");
include_once("../class/config.php");
if(!empty($_POST)){
	$folder="../";
	$al=new alumno;
	$cuota=new cuota;
	$doc=new documento;
	$conf=new config;
	/**/
	
	
	$CodAl=$_POST['Matricula'];
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
	$CelularSMS='';
	$ActivarSMS=1;
	
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
	$CertificadoNac=$_POST['CertificadoNac']!=""?$_POST['CertificadoNac']:"0";
	$LibretaEsc=$_POST['LibretaEsc']!=""?$_POST['LibretaEsc']:"0";
	$LibretaVac=$_POST['LibretaVac']!=""?$_POST['LibretaVac']:"0";
	$CedulaId=$_POST['CedulaId']!=""?$_POST['CedulaId']:"0";
	$CedulaIdP=$_POST['CedulaIdP']!=""?$_POST['CedulaIdP']:"0";
	$CedulaIdM=$_POST['CedulaIdM']!=""?$_POST['CedulaIdM']:"0";
	$ObservacionesDoc=$_POST['ObservacionesDoc'];
	$FechaInsc=date("Y-m-d");
	$HoraIns=date(" H:i:s");
	$CodAlumno=$CodAl;
	$cnf=($conf->mostrarConfig("CodBarra"));
	$CodBarra=trim($cnf['Valor']).$CodAlumno;
	$CodUsuarioAlumno=trim(minuscula(quitarSimbolos($Paterno))).$CodAlumno;

	$Password=rand(1000,9999);
	$PasswordP=rand(1000,9999);
	
	if($CiPadre!="" && $CiMadre!=""){
		$UsuarioPadre=usuarioPadre($CiPadre,$CiMadre);
	}else{
		$UsuarioPadre="";
	}
	
	if($CodCurso==1){
		$cnf=$conf->mostrarConfig("MontoKinder");	
		$MontoGeneral=$cnf['Valor'];
	}else{
		$cnf=$conf->mostrarConfig("MontoGeneral");	
		$MontoGeneral=$cnf['Valor'];	
	}
	
	$valuesDoc=array('CertificadoNac'=>$CertificadoNac,
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
				'LugarNac'=>"'$LugarNac'",
				'FechaNac'=>"'$FechaNac'",
				'Ci'=>"'$Ci'",
				'CiExt'=>"'$CiExt'",
				'Zona'=>"LOWER('$Zona')",
				'Calle'=>"LOWER('$Calle')",
				'Numero'=>"'$Numero'",
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
				//'FechaIns'=>"'$FechaInsc'",
				//'HoraIns'=>"'$HoraIns'",
				'UsuarioAlumno'=>"'$CodUsuarioAlumno'",
				'CodBarra'=>"'$CodBarra'",
				'Password'=>"'$Password'",
				'PasswordP'=>"'$PasswordP'",
				'UsuarioPadre'=>"'$UsuarioPadre'"
			);
	

	$fechaCuota=date("Y-m-d H:i:s");
	for($i=1;$i<=10;$i++){
		if($i==1){
			$valuesCuota=array(
							'MontoPagar'=>$MontoGeneral,
							);
		}else{
			$valuesCuota=array(
							'MontoPagar'=>$MontoPagar,
							);	
		}
		//echo "<br>";
//		print_r($valuesCuota);echo "<br>";
		$cuota->actualizarCuota($valuesCuota," CodAlumno=$CodAlumno and Numero=$i");
	}
	if($NombreFoto=subirArchivo($_FILES['Foto'],"imagenes/alumnos/")){
		$valuesAl=array_merge(array("Foto"=>"'$NombreFoto'"),$valuesAl);	
	}
	$al->actualizarDatosAlumno($valuesAl,$CodAlumno);
	$doc->actualizarDocumento($valuesDoc,$CodAlumno);
	header("Location:../alumno/datosalumno/?CodAlumno=".$CodAlumno);
}
?>