<?php
include_once("../../login/check.php");
//print_r($_POST);
if(!empty($_POST)){
	include_once("../../class/alumno.php");
	include_once("../../class/casilleros.php");
	include_once("../../class/docentemateriacurso.php");
	include_once("../../class/registronotas.php");
	include_once("../../class/curso.php");
	include_once("../../class/materias.php");
	include_once("../../class/docente.php");
	$curso=new curso;
	$materias=new materias;
	$docente=new docente;
	$alumno=new alumno;
	$casilleros=new casilleros;
	$docentemateriacurso=new docentemateriacurso;
	$casillas=$casilleros->estadoTabla();
	
	
	
	//$docM=array_shift($docM);
	$registroNotas=new registronotas;
	$Periodo=$_POST['Periodo'];
	$CodDocente=$_POST['CodDocente'];
	$CodMateria=$_POST['CodMateria'];
	$CodCurso=$_POST['CodCurso'];
	$SexoAlumno=$_POST['SexoAlumno'];
	$Casillas=$_POST['Casillas'];
	$Formula=$_POST['Formula'];
	$Dps=$_POST['Dps'];
	$Tope=$_POST['Tope'];
	//print_r($docM);
	$docmateriacurso=array_shift($docentemateriacurso->mostrarDocenteMateriaCursoSexo($CodDocente,$CodMateria,$CodCurso,$SexoAlumno));
	
	//echo "<br>$CodDocenteMateria<br>";
	$casi=$casilleros->mostrarTrimestre($docmateriacurso['CodDocenteMateriaCurso'],$Periodo);
	
	/*Sacando Datos de tablas*/
	$ma=array_shift($materias->mostrarMateria($docmateriacurso['CodMateria']));
	$doc=array_shift($docente->mostrarDocente($docmateriacurso['CodDocente']));
	$cur=array_shift($curso->mostrarCurso($docmateriacurso['CodCurso']));
	
	
	if(count($casi)){
		?>
        <strong>
		<?php echo $idioma['CasillerosRegistrado'];?>
		<br />
		<?php echo $idioma['ReviseLosDatos'];?>
        </strong>
        <?php
		
		exit();
	}

	$CodCasilleros=$casillas['Auto_increment'];
	$valDM=array('CodCasilleros'=>$CodCasilleros,
				'CodDocenteMateriaCurso'=>$docmateriacurso['CodDocenteMateriaCurso'],
				'Casilleros'=>$Casillas,
				'Trimestre'=>$Periodo,
				'FormulaCalificaciones'=>"'$Formula'",
				'Dps'=>$Dps
				);
				
	for($i=1;$i<=15;$i++){
		if($i<=$Casillas){
			if($cur['Bimestre']){//Sacando para Cursos por Bimestre
				switch($i){
					case 1:{$valDM['NombreCasilla'.$i]="'Ser'";$valDM['LimiteCasilla'.$i]=20;}break;
					case 2:{$valDM['NombreCasilla'.$i]="'Saber'";$valDM['LimiteCasilla'.$i]=30;}break;
					case 3:{$valDM['NombreCasilla'.$i]="'Hacer'";$valDM['LimiteCasilla'.$i]=30;}break;
					case 4:{$valDM['NombreCasilla'.$i]="'Decidir'";$valDM['LimiteCasilla'.$i]=20;}break;
				}
			}else{//Sacnado para Fines de Bimestre
				$valDM['NombreCasilla'.$i]="'Casilla $i'";
				$valDM['LimiteCasilla'.$i]=$Tope;
			}
			
		}else{
			$valDM['NombreCasilla'.$i]="'Casilla $i'";
			$valDM['LimiteCasilla'.$i]=0;
		}
	}
	$casilleros->insertarRegistro($valDM);
	//print_r($valDM);
	//print_r($valDM);
	foreach($alumno->mostrarAlumnosCurso($CodCurso,$SexoAlumno) as $al){
		$valRN=array('CodRegistroNotas'=>'NULL',
					'CodCasilleros'=>$CodCasilleros,
					'CodAlumno'=>$al['CodAlumno'],
					'Trimestre'=>$Periodo,
					);
		for($i=1;$i<=15;$i++){
			$valRN['Nota'.$i]=0;	
		}
//		print_r($valRN);
		$valRN['Resultado']=0;
		$valRN['Dps']=0;
		$valRN['NotaFinal']=0;
		$registroNotas->insertarRegistro($valRN);
	}
	//print_r($_POST);
	
	//Sacar Datos para mostrar
	
	?>
    
	<strong><?php echo $idioma["CasillerosRegistradosCorrectamente"];?></strong>
    <br />
    <strong><?php echo $idioma["ConLosSiguientesDatos"];?>:</strong>
    <br />
    <table class="table table-striped table-bordered table-hover">
    	<tr><td><?php echo $idioma["Curso"];?>:</td><td><?php echo $cur['Nombre']?></td></tr>
        <tr><td><?php echo $idioma["Materia"];?>:</td><td><?php echo $ma['Nombre']?></td></tr>
        <tr><td><?php echo $idioma["Docente"];?>:</td><td><?php echo ucwords($doc['Paterno'])?> <?php echo ucwords($doc['Materno'])?> <?php echo ucwords($doc['Nombres'])?></td></tr>
        <tr><td><?php echo $idioma["Casilleros"];?></td><td><?php echo $Casillas?></td></tr>
        <tr><td><?php echo $cur['Bimestre']?$idioma['Bimestre']:$idioma["Trimestre"];?></td><td><?php echo $Periodo?></td></tr>
        <tr><td><?php echo $idioma["NotaTopeCasilleros"];?>:</td><td><?php echo $Tope?></td></tr>
        <tr><td><?php echo $idioma["Dps"];?>:</td><td><?php echo $Dps?$idioma['Si']:$idioma['No'];?></td></tr>
    </table>
    <?php
}
?>