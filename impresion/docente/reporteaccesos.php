<?php 
include_once("../../login/check.php");
if(!empty($_GET) && $_GET['lock']==md5('lock')){
	include_once("../pdf.php");
	$titulo=$idioma['DatosDocente'];
	class PDF extends PPDF{
		function Cabecera(){
		}
	}
	
	include_once("../../class/docente.php");
	include_once("../../class/docentemateriacurso.php");
	include_once("../../class/curso.php");
	include_once("../../class/materias.php");
	$docente=new docente;
	$docentemateriacurso=new docentemateriacurso;
	$materias=new materias;
	$curso=new curso;
	extract($_GET);
	$doc=array_shift($docente->mostrarRegistro($CodDocente));
	$ima="../../imagenes/docentes/".$doc['Foto'];
	if(!file_exists($ima) || empty($doc['Foto'])){
		 $ima="../../imagenes/docentes/0.jpg";	
	}
	$pdf=new PDF("P","mm","letter");//612,792
	$pdf->AddPage();
	$borde=0;
	$pdf->Image($ima,164,60,30,30);
	$pdf->CuadroCuerpoPersonalizado(176,$idioma["DatosPersonales"],1,"",0,"B");
	$pdf->Ln();$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Nombre"].": ",0,"L",$borde,"B");
	$pdf->CuadroNombre(100,$doc['Paterno'],$doc['Materno'],$doc['Nombres'],1,$relleno);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Sexo"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,$doc['Sexo']?$idioma['Masculino']:$idioma['Femenino'],0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Ci"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,$doc['Ci'],0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Direccion"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,$doc['Direccion'],0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Telefono"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,$doc['Telefono'],0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Celular"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,$doc['Celular'],0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Email"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,$doc['Email'],0,"",$borde);
	
	$pdf->Ln();$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(176,$idioma["DatosAccesoSistema"],1,"",0,"B");
	
	$pdf->Ln();
	
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Usuario"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(40,minuscula($doc['Usuario']),0,"",$borde);
	$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Contrasena"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(40,minuscula($doc['Password']),0,"",$borde);

	$pdf->Ln();$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(176,$idioma["DatosAcademicos"],1,"",0,"B");
	$pdf->Ln();$pdf->Ln();$i=0;
	$pdf->CuadroCuerpo(5,"N",1,"R",1,"","B");
	$pdf->CuadroCuerpo(50,$idioma['Curso'],1,"C",1,"","B");
	$pdf->CuadroCuerpo(50,$idioma['Materia'],1,"C",1,"","B");
	$pdf->CuadroCuerpo(50,$idioma['Alumnos'],1,"C",1,"","B");
	$pdf->Ln();
	foreach($docentemateriacurso->mostrarDocenteGrupo($CodDocente,"") as $dmc){$i++;
		$relleno=$i%2==0?0:0;
		$cur=$curso->mostrarCurso($dmc['CodCurso']);
		$cur=array_shift($cur);
		$mat=$materias->mostrarMateria($dmc['CodMateria']);
		$mat=array_shift($mat);
		switch($dmc['SexoAlumno']){
			case 0:{$TextoSexo=$idioma['SoloMujeres'];}break;	
			case 1:{$TextoSexo=$idioma['SoloVarones'];}break;
			case 2:{$TextoSexo=$idioma['AmbosSexos'];}break;
		}
		$pdf->CuadroCuerpo(5,$i,$relleno,"R",1);
		$pdf->CuadroCuerpo(50,$cur['Nombre'],$relleno,"",1);
		$pdf->CuadroCuerpo(50,$mat['Nombre'],$relleno,"",1);
		$pdf->CuadroCuerpo(50,$TextoSexo,$relleno,"",1);
		$pdf->ln();
	}
	$pdf->Output($titulo." ".capitalizar($doc['Paterno']." ".$doc['Materno']." ".$doc['Nombres']),"I");
}
?>