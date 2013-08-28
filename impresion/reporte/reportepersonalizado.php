<?php
include_once '../../login/check.php';
include_once("../pdf.php");
include_once("../../class/alumno.php");
include_once("../../class/curso.php");
$cur=new curso;
$alumno=new alumno;
$titulo=$idioma['NominaAlumnos'];
$CodCurso=$_GET['CodCurso'];
$Campo1=$_GET['Campo1'];
$Campo2=$_GET['Campo2'];
$Campo3=$_GET['Campo3'];
$Borde=$_GET['Borde'];
$Blanco=$_GET['Blanco'];
$Cantidad=$_GET['Cantidad'];
$Sombreado=$_GET['Sombreado'];
$Sexo=2;
if($Borde=="checked"){$Borde=1;}else{$Borde=0;}
if($Blanco=="checked"){$Blanco=true;}else{$Blanco=false;}
if($Sombreado=="checked"){$Sombreado=true;}else{$Sombreado=false;}
$curso=array_shift($cur->mostrarCurso($CodCurso));
class PDF extends PPDF
{
	function Cabecera(){
		global $curso,$Campo1,$Campo2,$Campo3,$Cantidad,$Borde,$Blanco,$idioma;
		$this->CuadroCabecera(15,$idioma['Curso'].":",30,$curso['Nombre']);
		$this->Pagina();
		$this->ln();
		$this->TituloCabecera(5,"Nº");
		$this->TituloCabecera(30,$idioma["Paterno"]);
		$this->TituloCabecera(30,$idioma["Materno"]);
		$this->TituloCabecera(45,$idioma["Nombres"]);
		if(!$Blanco){
			$this->TituloCabecera(35,$idioma[$Campo1],"10",$Borde);
			$this->TituloCabecera(35,$idioma[$Campo2],"10",$Borde);
			$this->TituloCabecera(35,$idioma[$Campo3],"10",$Borde);
			$this->TituloCabecera(35,$idioma[$Campo4],"10",$Borde);
		}else{
			switch($Cantidad)
					{
						case "1":{$this->TituloCabecera(140,"","10",$Borde);}break;
						case "2":{$this->TituloCabecera(70,"","10",$Borde);
								  $this->TituloCabecera(70,"","10",$Borde);}break;
						case "3":{$this->TituloCabecera(47,"","10",$Borde);
								  $this->TituloCabecera(47,"","10",$Borde);
								  $this->TituloCabecera(46,"","10",$Borde);}break;
						case "4":{$this->TituloCabecera(35,"","10",$Borde);
								  $this->TituloCabecera(35,"","10",$Borde);
								  $this->TituloCabecera(35,"","10",$Borde);
								  $this->TituloCabecera(35,"","10",$Borde);}break;
					}
		}
	}	
}
$pdf=new PDF("L","mm","letter");//612,792
$pdf->AddPage();


/*Fin de Cabeceras*/
/*Datos*///,"","","",true
$i=0;
$Somb=0;
foreach($alumno->mostrarAlumnosCurso($CodCurso,$Sexo) as $al)
{	
	$i++;
	if($Sombreado==true){
		if($i%2==0){$Somb=1;}else{$Somb=0;}
	}
		$pdf->CuadroCuerpo(5,$i,$Somb,"R",$Borde);
		$pdf->CuadroCuerpo(30,capitalizar($al['Paterno'],"utf8"),$Somb,"",$Borde);
		$pdf->CuadroCuerpo(30,capitalizar($al['Materno'],"utf8"),$Somb,"",$Borde);
		$pdf->CuadroCuerpo(45,capitalizar($al['Nombres'],"utf8"),$Somb,"",$Borde);
		if(!$Blanco){
			if($Campo1!=""){
				if($Campo1=="FechaNac"){
					$pdf->CuadroCuerpo(35,fecha2Str($al[$Campo1]),$Somb,"R",$Borde);
				}else{
					$pdf->CuadroCuerpo(35,capitalizar($al[$Campo1]),$Somb,"",$Borde,9);
				}
			}else{
				$pdf->CuadroCuerpo(35,"",$Somb,"",$Borde);
			}
			if($Campo2!=""){
				if($Campo2=="FechaNac"){
					$pdf->CuadroCuerpo(35,fecha2Str($al[$Campo2]),$Somb,"R",$Borde);
				}else{
					$pdf->CuadroCuerpo(35,capitalizar($al[$Campo2]),$Somb,"",$Borde,9);
				}
			}else{
				$pdf->CuadroCuerpo(35,"",$Somb,"",$Borde);
			}
			if($Campo3!=""){
				if($Campo3=="FechaNac"){
					$pdf->CuadroCuerpo(35,fecha2Str($al[$Campo3]),$Somb,"R",$Borde);
				}else{
					$pdf->CuadroCuerpo(35,capitalizar($al[$Campo3]),$Somb,"",$Borde,9);
				}
			}else{
				$pdf->CuadroCuerpo(35,"",$Somb,"",$Borde);
			}
			if($Campo4!=""){
				if($Campo3=="FechaNac"){
					$pdf->CuadroCuerpo(35,fecha2Str($al[$Campo3]),$Somb,"R",$Borde);
				}else{
					$pdf->CuadroCuerpo(35,capitalizar($al[$Campo3]),$Somb,"",$Borde,9);
				}
			}else{
				$pdf->CuadroCuerpo(35,"",$Somb,"",$Borde);
			}
		}else{
			switch($Cantidad)
			{
				case "1":{$pdf->CuadroCuerpo(140,"",$Somb,"",1);}break;
				case "2":{$pdf->CuadroCuerpo(70,"",$Somb,"",1);
						$pdf->CuadroCuerpo(70,"",$Somb,"",1);}break;
				case "3":{$pdf->CuadroCuerpo(47,"",$Somb,"",1);
						$pdf->CuadroCuerpo(47,"",$Somb,"",1);
						$pdf->CuadroCuerpo(46,"",$Somb,"",1);}break;
				case "4":{$pdf->CuadroCuerpo(35,"",$Somb,"",1);
						$pdf->CuadroCuerpo(35,"",$Somb,"",1);
						$pdf->CuadroCuerpo(35,"",$Somb,"",1);
						$pdf->CuadroCuerpo(35,"",$Somb,"",1);}break;		
			}
			
		}
	$pdf->ln();

}

$pdf->Output();
?>