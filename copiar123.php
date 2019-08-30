<?php


$rl=mysql_connect("localhost","root","admina");
$l1=mysql_select_db("slg2015",$rl);
$res=mysql_query("select * from slg2015.alumno",$rl);
echo mysql_num_rows($res);

include_once("../colegio/class/alumno.php");
$alumno=new alumno;
include_once("../colegio/class/cuota.php");
$cuota=new cuota;
include_once("../colegio/class/documento.php");
$documento=new documento;
include_once("../colegio/class/rude.php");
$rude=new rude;

while($regal=mysql_fetch_assoc($res)){
	echo "<pre>";
	//print_r($regal);
	echo "</pre>";
	$autoIncrement=$alumno->estadoTabla();
	$CodAlumno=$autoIncrement['Auto_increment'];
	echo $CodAlumno;
	$valal=array("CodAlumno"=>"'$CodAlumno'",
	"Paterno"=>"'{$regal['Paterno']}'",
	"Materno"=>"'{$regal['Materno']}'",
	"Nombres"=>"'{$regal['Nombres']}'",
	"LugarNac"=>"'{$regal['LugarNac']}'",
	"FechaNac"=>"'{$regal['FechaNac']}'",
	"Ci"=>"'{$regal['Ci']}'",
	"CiExt"=>"'{$regal['CiExt']}'",
	"Sexo"=>"'{$regal['Sexo']}'",
	"Zona"=>"'{$regal['Zona']}'",
	"Calle"=>"'{$regal['Calle']}'",
	"Numero"=>"'{$regal['Numero']}'",
	"TelefonoCasa"=>"'{$regal['TelefonoCasa']}'",
	"Celular"=>"'{$regal['Celular']}'",
	"CelularSMS"=>"'{$regal['CelularSMS']}'",
	"ActivarSMS"=>"'{$regal['ActivarSMS']}'",
	"CodCurso"=>"'{$regal['CodCurso']}'",
	"Procedencia"=>"'{$regal['Procedencia']}'",
	"Repitente"=>"'{$regal['Repitente']}'",
	"Traspaso"=>"'{$regal['Traspaso']}'",
	"Becado"=>"'{$regal['Becado']}'",
	"MontoBeca"=>"'{$regal['MontoBeca']}'",
	"PorcentajeBeca"=>"'{$regal['PorcentajeBeca']}'",
	"Retirado"=>"'{$regal['Retirado']}'",
	"FechaRetiro"=>"'{$regal['FechaRetiro']}'",
	"Rude"=>"'{$regal['Rude']}'",
	"Observaciones"=>"'{$regal['Observaciones']}'",
	"ApellidosPadre"=>"'{$regal['ApellidosPadre']}'",
	"NombrePadre"=>"'{$regal['NombrePadre']}'",
	"CiPadre"=>"'{$regal['CiPadre']}'",
	"CiExtP"=>"'{$regal['CiExtP']}'",
	"OcupPadre"=>"'{$regal['OcupPadre']}'",
	"CelularP"=>"'{$regal['CelularP']}'",
	"ApellidosMadre"=>"'{$regal['ApellidosMadre']}'",
	"NombreMadre"=>"'{$regal['NombreMadre']}'",
	"CiMadre"=>"'{$regal['CiMadre']}'",
	"CiExtM"=>"'{$regal['CiExtM']}'",
	"OcupMadre"=>"'{$regal['OcupMadre']}'",
	"CelularM"=>"'{$regal['CelularM']}'",
	"Email"=>"'{$regal['Email']}'",
	"Nit"=>"'{$regal['Nit']}'",
	"FacturaA"=>"'{$regal['FacturaA']}'",
	"UsuarioAlumno"=>"'{$regal['UsuarioAlumno']}'",
	"UsuarioPadre"=>"'{$regal['UsuarioPadre']}'",
	"PasswordP"=>"'{$regal['PasswordP']}'",
	"Password"=>"'{$regal['Password']}'",
	"CodBarra"=>"'{$regal['CodBarra']}'",
	"Foto"=>"'{$regal['Foto']}'",
	"FechaIns"=>"'{$regal['FechaIns']}'",
	"HoraIns"=>"'{$regal['HoraIns']}'",
	"Activo"=>"'{$regal['Activo']}'",
	);
	echo "<pre>";
	print_r($valal);
	echo "</pre>";
	$alumno->insertarAlumno($valal);
	
	$rescouta=mysql_query("SELECT * from slg2015.cuota WHERE CodAlumno=".$regal['CodAlumno'],$rl);
	while($regcuota=mysql_fetch_assoc($rescouta)){
		echo "<pre>";
		//print_r($regcuota);
		echo "</pre>";
		$valcuota=array("CodCuota"=>'NULL',
		"CodAlumno"=>"'$CodAlumno'",
		"Numero"=>"'{$regcuota['Numero']}'",
		"MontoPagar"=>"'{$regcuota['MontoPagar']}'",
		"Factura"=>"'{$regcuota['Factura']}'",
		"Cancelado"=>"'{$regcuota['Cancelado']}'",
		"Fecha"=>"'{$regcuota['Fecha']}'",
		"Observaciones"=>"'{$regcuota['Observaciones']}'",
		);
		
		echo "<pre>";
		print_r($valcuota);
		echo "</pre>";
		$cuota->guardar($valcuota);
	}
	
	$resdoc=mysql_query("SELECT * from slg2015.documento WHERE CodAlumno=".$regal['CodAlumno']);
	while($regdoc=mysql_fetch_assoc($resdoc)){
		echo "<pre>";
		//print_r($regdoc);
		echo "</pre>";
		
		$valdoc=array("CodDocumento"=>'NULL',
			"CodAlumno"=>"'$CodAlumno'",
			"CertificadoNac"=>"'{$regdoc['CertificadoNac']}'",
			"LibretaEsc"=>"'{$regdoc['LibretaEsc']}'",
			"LibretaVac"=>"'{$regdoc['LibretaVac']}'",
			"CedulaId"=>"'{$regdoc['CedulaId']}'",
			"CedulaIdP"=>"'{$regdoc['CedulaIdP']}'",
			"CedulaIdM"=>"'{$regdoc['CedulaIdM']}'",
			"Observaciones"=>"'{$regdoc['Observaciones']}'",
		);
		echo "<pre>";
		print_r($valdoc);
		echo "</pre>";
		$documento->guardarDocumento($valdoc);
	}
	
	$resrude=mysql_query("SELECT * from slg2015.rude WHERE CodAlumno=".$regal['CodAlumno']);
	while($regrude=mysql_fetch_assoc($resrude)){
		echo "<pre>";
		//print_r($regrude);
		echo "</pre>";
		$valrude=array("CodRude"=>'NULL',
			"CodAlumno"=>"'$CodAlumno'",
			"PaisN"=>"'{$regrude['PaisN']}'",
			"ProvinciaN"=>"'{$regrude['ProvinciaN']}'",
			"LocalidadN"=>"'{$regrude['LocalidadN']}'",
			"Documento"=>"'{$regrude['Documento']}'",
			"CertOfi"=>"'{$regrude['CertOfi']}'",
			"CertLibro"=>"'{$regrude['CertLibro']}'",
			"CertPartida"=>"'{$regrude['CertPartida']}'",
			"CertFolio"=>"'{$regrude['CertFolio']}'",
			"Paralelo"=>"'{$regrude['Paralelo']}'",
			"Turno"=>"'{$regrude['Turno']}'",
			"CodigoSie"=>"'{$regrude['CodigoSie']}'",
			"NombreUnidad"=>"'{$regrude['NombreUnidad']}'",
			"ProvinciaE"=>"'{$regrude['ProvinciaE']}'",
			"MunicipioE"=>"'{$regrude['MunicipioE']}'",
			"ComunidadE"=>"'{$regrude['ComunidadE']}'",
			"LenguaMater"=>"'{$regrude['ComunidadE']}'",
			"CastellanoI"=>"'{$regrude['CastellanoI']}'",
			"AymaraI"=>"'{$regrude['AymaraI']}'",
			"InglesI"=>"'{$regrude['InglesI']}'",
			"PerteneceA"=>"'{$regrude['PerteneceA']}'",
			"CentroSalud"=>"'{$regrude['CentroSalud']}'",
			"VecesCentro"=>"'{$regrude['VecesCentro']}'",
			"Discapacidad"=>"'{$regrude['Discapacidad']}'",
			"AguaDomicilio"=>"'{$regrude['AguaDomicilio']}'",
			"Electricidad"=>"'{$regrude['Electricidad']}'",
			"Alcantarillado"=>"'{$regrude['Alcantarillado']}'",
			"InternetCasa"=>"'{$regrude['InternetCasa']}'",
			"Transporte"=>"'{$regrude['InternetCasa']}'",
			"TiempoLlegada"=>"'{$regrude['TiempoLlegada']}'",
			"InstruccionP"=>"'{$regrude['InstruccionP']}'",
			"IdiomaP"=>"'{$regrude['IdiomaP']}'",
			"ParentescoP"=>"'{$regrude['ParentescoP']}'",
			"InstruccionM"=>"'{$regrude['InstruccionM']}'",
			"IdiomaM"=>"'{$regrude['IdiomaM']}'",
			"Lugar"=>"'{$regrude['Lugar']}'",
			"FechaReg"=>"'{$regrude['FechaReg']}'",
		);
		echo "<pre>";
		print_r($valrude);
		echo "</pre>";
		$rude->insertarAlumno($valrude);
	}
	
}

/*include_once("../colegio/class/alumno.php");
$alumno=new alumno;
$al=$alumno->mostrarTodoRegistro("",0);
echo count($al);
print_r($al);*/
?>