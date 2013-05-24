<?php 
include_once("../../login/check.php");
if(!empty($_GET) && $_GET['lock']==md5('lock')){
	$titulo=$idioma['ReporteDatosAlumno'];
	
	$CodAlumno=$_SESSION['CodAlumno'];
	include_once("../../class/alumno.php");
	include_once("../../class/curso.php");
	include_once("../../class/documento.php");
	
	$alumno=new alumno;
	$curso=new curso;
	$documento=new documento;

	
	$al=$alumno->mostrarTodoDatos($CodAlumno);
	$al=array_shift($al);
	$cur=$curso->mostrarCurso($al['CodCurso']);
	$cur=array_shift($cur);
	$doc=$documento->mostrarDocumento($CodAlumno);
	$doc=array_shift($doc);
	
	$ima="../../imagenes/alumnos/".$al['Foto'];
	if(!file_exists($ima) || empty($al['Foto'])){
		 $ima="../../imagenes/alumnos/0.jpg";	
	}
	include_once("../pdf.php");
	class PDF extends PPDF{
		function Cabecera(){
			$this->Pagina();
			$this->ln();
		}
	}
	$pdf=new PDF("P","mm","letter");//612,792
	$pdf->AddPage();
	$borde=0;
	$pdf->Image($ima,164,60,30,30);
	$pdf->CuadroCuerpoPersonalizado(176,$idioma["DatosPersonales"],1,"",0,"B");
	$pdf->Ln();$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Curso"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,$cur['Nombre']);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Paterno"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($al['Paterno']));
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Materno"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($al['Materno']));
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Nombre"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($al['Nombres']));
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Sexo"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,$al['Sexo']?$idioma['Masculino']:$idioma['Femenino'],0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["LugarNacimiento"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($al['LugarNac']),0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["FechaNacimiento"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar(fecha2Str($al['FechaNac'])),0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["CedulaIdentidad"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($al['Ci']),0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Zona"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($al['Zona']),0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Calle"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($al['Calle']),0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Numero"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($al['Numero']),0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["TelefonoCasa"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($al['TelefonoCasa']),0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Celular"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($al['Celular']),0,"",$borde);
	$pdf->ln();$pdf->Ln();
	
	$pdf->CuadroCuerpoPersonalizado(176,$idioma["DatosAcademicos"],1,"",0,"B");
	$pdf->Ln();$pdf->Ln();
	
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Procedencia"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($al['Procedencia']),0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Repitente"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($al['Repitente']?$idioma['Si']:$idioma['No']),0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Traspaso"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($al['Traspaso']?$idioma['Si']:$idioma['No']),0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Becado"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($al['Becado']?$idioma['Si']:$idioma['No']),0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["MontoBeca"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($al['MontoBeca']),0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Retirado"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($al['Retirado']?$idioma['Si']:$idioma['No']),0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["FechaRetiro"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($al['FechaRetiro']),0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Rude"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($al['Rude']),0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Observaciones"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpoMulti(100,capitalizar($al['Observaciones']),0,"",$borde);
	$pdf->ln();
	
	$pdf->CuadroCuerpoPersonalizado(176,$idioma["DatosPadreFamilia"],1,"",0,"B");
	$pdf->Ln();$pdf->Ln();
	
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["ApellidosPadre"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($al['ApellidosPadre']),0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["NombrePadre"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($al['NombrePadre']),0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["CiPadre"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($al['CiPadre']),0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["OcupacionPadre"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($al['OcupPadre']),0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["CelularPadre"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($al['CelularP']),0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["ApellidosMadre"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($al['ApellidosMadre']),0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["NombreMadre"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($al['NombreMadre']),0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["CiMadre"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($al['CiMadre']),0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["OcupacionMadre"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($al['OcupMadre']),0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["CelularMadre"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($al['CelularM']),0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Email"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($al['Email']),0,"",$borde);
	$pdf->Ln();$pdf->Ln(20);
	
	$pdf->CuadroCuerpoPersonalizado(176,$idioma["DatosFactura"],1,"",0,"B");
	$pdf->Ln();$pdf->Ln();
	
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Nit"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($al['Nit']),0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["NombreFacturar"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($al['FacturaA']),0,"",$borde);
	$pdf->ln();$pdf->ln();
	
	$pdf->CuadroCuerpoPersonalizado(176,$idioma["Documentos"],1,"",0,"B");
	$pdf->Ln();$pdf->Ln();
	
	$pdf->CuadroCuerpoPersonalizado(50,$idioma["CertificadoNacimiento"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($doc['CertificadoNac']?$idioma['Si']:$idioma['No']),0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(50,$idioma["LibretaEscolar"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($doc['LibretaEsc']?$idioma['Si']:$idioma['No']),0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(50,$idioma["LibretaVacunas"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($doc['LibretaVac']?$idioma['Si']:$idioma['No']),0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(50,$idioma["CiAlumno"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($doc['CedulaId']?$idioma['Si']:$idioma['No']),0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(50,$idioma["CiPadre"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($doc['CedulaIdP']?$idioma['Si']:$idioma['No']),0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(50,$idioma["CiMadre"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,capitalizar($doc['CedulaIdM']?$idioma['Si']:$idioma['No']),0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(50,$idioma["ObservacionesDocumentos"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpoMulti(100,capitalizar($doc['Observaciones']),0,"",$borde);
	$pdf->ln();
	
	$pdf->Output();
}
?>