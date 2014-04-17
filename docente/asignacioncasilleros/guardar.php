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

	$registroNotas=new registronotas;
	$Periodo=$_POST['Periodo'];
	$CodDocenteMateriaCurso=$_POST['CodDocenteMateriaCurso'];
	$Casillas=$_POST['Casillas'];
	$Formula=$_POST['Formula'];
	$TipoNota=$_POST['TipoNota'];
	
	//print_r($_POST);
	//exit();
	$docmateriacurso=$docentemateriacurso->mostrarCodDocenteMateriaCurso($CodDocenteMateriaCurso);
	$docmateriacurso=array_shift($docmateriacurso);
	//echo "<br>$CodDocenteMateria<br>";
	$casi=$casilleros->mostrarTrimestre($docmateriacurso['CodDocenteMateriaCurso'],$Periodo);
	
	/*Sacando Datos de tablas*/
	$ma=array_shift($materias->mostrarMateria($docmateriacurso['CodMateria']));
	$doc=array_shift($docente->mostrarDocente($docmateriacurso['CodDocente']));
	$cur=array_shift($curso->mostrarCurso($docmateriacurso['CodCurso']));
	
	
	if(count($casi)){
		?>
        <div class="alert alert-error">
        <strong>
		<?php echo $idioma['CasillerosRegistrado'];?>
		<br />
		<?php echo $idioma['ReviseLosDatos'];?>
        </strong>
        </div>
        <?php
		exit();
	}
	if($TipoNota=="avanzado"){
		$Casillas=20;
	}
	$CodCasilleros=$casillas['Auto_increment'];
	$valDM=array('CodCasilleros'=>$CodCasilleros,
				'CodDocenteMateriaCurso'=>$docmateriacurso['CodDocenteMateriaCurso'],
				'Casilleros'=>$Casillas,
				'Trimestre'=>$Periodo,
				'FormulaCalificaciones'=>"'$Formula'",
				'Dps'=>$cur['Dps'],
				'TipoNota'=>"'$TipoNota'"
				);
				
	for($i=1;$i<=25;$i++){
		if($i<=$Casillas){
			if($cur['Bimestre']){//Sacando para Cursos por Bimestre
				if($TipoNota=="avanzado"){
					switch($i){
						case 1:{$valDM['NombreCasilla'.$i]="'".$idioma['Valor']." 1'";$valDM['LimiteCasilla'.$i]=100;$valDM['LimiteMinCasilla'.$i]=0;}break;
						case 2:{$valDM['NombreCasilla'.$i]="'".$idioma['Valor']." 2'";$valDM['LimiteCasilla'.$i]=100;$valDM['LimiteMinCasilla'.$i]=0;}break;
						case 3:{$valDM['NombreCasilla'.$i]="'".$idioma['Autoevaluacion']."'";$valDM['LimiteCasilla'.$i]=100;$valDM['LimiteMinCasilla'.$i]=0;}break;
						case 4:{$valDM['NombreCasilla'.$i]="'".$idioma['Ser']."'";$valDM['LimiteCasilla'.$i]=20;$valDM['LimiteMinCasilla'.$i]=0;}break;
						case 5:{$valDM['NombreCasilla'.$i]="'".$idioma['Valor']." 1'";$valDM['LimiteCasilla'.$i]=100;$valDM['LimiteMinCasilla'.$i]=0;}break;
						case 6:{$valDM['NombreCasilla'.$i]="'".$idioma['Valor']." 2"."'";$valDM['LimiteCasilla'.$i]=100;$valDM['LimiteMinCasilla'.$i]=0;}break;
						case 7:{$valDM['NombreCasilla'.$i]="'".$idioma['Valor']." 3'";$valDM['LimiteCasilla'.$i]=100;$valDM['LimiteMinCasilla'.$i]=0;}break;
						case 8:{$valDM['NombreCasilla'.$i]="'".$idioma['Valor']." 4'";$valDM['LimiteCasilla'.$i]=100;$valDM['LimiteMinCasilla'.$i]=0;}break;
						case 9:{$valDM['NombreCasilla'.$i]="'".$idioma['Autoevaluacion']."'";$valDM['LimiteCasilla'.$i]=100;$valDM['LimiteMinCasilla'.$i]=0;}break;
						case 10:{$valDM['NombreCasilla'.$i]="'".$idioma['Saber']."'";$valDM['LimiteCasilla'.$i]=30;$valDM['LimiteMinCasilla'.$i]=0;}break;
						case 11:{$valDM['NombreCasilla'.$i]="'".$idioma['Valor']." 1'";$valDM['LimiteCasilla'.$i]=100;$valDM['LimiteMinCasilla'.$i]=0;}break;
						case 12:{$valDM['NombreCasilla'.$i]="'".$idioma['Valor']." 2'";$valDM['LimiteCasilla'.$i]=100;$valDM['LimiteMinCasilla'.$i]=0;}break;
						case 13:{$valDM['NombreCasilla'.$i]="'".$idioma['Valor']." 3'";$valDM['LimiteCasilla'.$i]=100;$valDM['LimiteMinCasilla'.$i]=0;}break;
						case 14:{$valDM['NombreCasilla'.$i]="'".$idioma['Autoevaluacion']."'";$valDM['LimiteCasilla'.$i]=100;$valDM['LimiteMinCasilla'.$i]=0;}break;
						case 15:{$valDM['NombreCasilla'.$i]="'".$idioma['Hacer']."'";$valDM['LimiteCasilla'.$i]=30;$valDM['LimiteMinCasilla'.$i]=0;}break;
						case 16:{$valDM['NombreCasilla'.$i]="'".$idioma['Valor']." 1'";$valDM['LimiteCasilla'.$i]=100;$valDM['LimiteMinCasilla'.$i]=0;}break;
						case 17:{$valDM['NombreCasilla'.$i]="'".$idioma['Valor']." 2'";$valDM['LimiteCasilla'.$i]=100;$valDM['LimiteMinCasilla'.$i]=0;}break;
						case 18:{$valDM['NombreCasilla'.$i]="'".$idioma['Valor']." 3'";$valDM['LimiteCasilla'.$i]=100;$valDM['LimiteMinCasilla'.$i]=0;}break;
						case 19:{$valDM['NombreCasilla'.$i]="'".$idioma['Autoevaluacion']."'";$valDM['LimiteCasilla'.$i]=100;$valDM['LimiteMinCasilla'.$i]=0;}break;
						case 20:{$valDM['NombreCasilla'.$i]="'".$idioma['Decidir']."'";$valDM['LimiteCasilla'.$i]=20;$valDM['LimiteMinCasilla'.$i]=0;}break;
					}

				}else{
					switch($i){
						case 1:{$valDM['NombreCasilla'.$i]="'".$idioma['Ser']."'";$valDM['LimiteCasilla'.$i]=20;$valDM['LimiteMinCasilla'.$i]=10;}break;
						case 2:{$valDM['NombreCasilla'.$i]="'".$idioma['Saber']."'";$valDM['LimiteCasilla'.$i]=30;$valDM['LimiteMinCasilla'.$i]=15;}break;
						case 3:{$valDM['NombreCasilla'.$i]="'".$idioma['Hacer']."'";$valDM['LimiteCasilla'.$i]=30;$valDM['LimiteMinCasilla'.$i]=15;}break;
						case 4:{$valDM['NombreCasilla'.$i]="'".$idioma['Decidir']."'";$valDM['LimiteCasilla'.$i]=20;$valDM['LimiteMinCasilla'.$i]=10;}break;
					}
				}
			}else{//Sacnado para Fines de Bimestre
				$valDM['NombreCasilla'.$i]="'Casilla $i'";
				$valDM['LimiteCasilla'.$i]=$cur['NotaTope'];
				$valDM['LimiteMinCasilla'.$i]=0;
			}
			
		}else{
			$valDM['NombreCasilla'.$i]="'Casilla $i'";
			$valDM['LimiteCasilla'.$i]=0;
			$valDM['LimiteMinCasilla'.$i]=0;
		}
	}
	$casilleros->insertarRegistro($valDM);
	//print_r($valDM);
	//print_r($valDM);
	foreach($alumno->mostrarAlumnosCurso($docmateriacurso['CodCurso'],$docmateriacurso['SexoAlumno'],2) as $al){
		$valRN=array('CodRegistroNotas'=>'NULL',
					'CodCasilleros'=>$CodCasilleros,
					'CodAlumno'=>$al['CodAlumno'],
					'Trimestre'=>$Periodo,
					);
		for($i=1;$i<=25;$i++){
			$valRN['Nota'.$i]=0;	
		}
		//print_r($valRN);
		$valRN['Resultado']=0;
		$valRN['Dps']=0;
		$valRN['NotaFinal']=0;
		$registroNotas->insertarRegistro($valRN);
	}
	//print_r($_POST);
	
	//Sacar Datos para mostrar
	
	?>
    <div class="alert alert-success">
	<strong><?php echo $idioma["CasillerosRegistradosCorrectamente"];?></strong>
    <br />
    <strong><?php echo $idioma["ConLosSiguientesDatos"];?>:</strong>
    </div>
    <table class="table table-striped table-bordered table-hover">
    	<tr><td><?php echo $idioma["Curso"];?>:</td><td><?php echo $cur['Nombre']?></td></tr>
        <tr><td><?php echo $idioma["Materia"];?>:</td><td><?php echo $ma['Nombre']?></td></tr>
        <tr><td><?php echo $idioma["Docente"];?>:</td><td><?php echo ucwords($doc['Paterno'])?> <?php echo ucwords($doc['Materno'])?> <?php echo ucwords($doc['Nombres'])?></td></tr>
        <tr><td><?php echo $idioma["Casilleros"];?></td><td><?php echo $Casillas?></td></tr>
        <tr><td><?php echo $cur['Bimestre']?$idioma['Bimestre']:$idioma["Trimestre"];?></td><td><?php echo $Periodo?></td></tr>
        <tr><td><?php echo $idioma["NotaTopeCasilleros"];?>:</td><td><?php echo $cur['NotaTope']?></td></tr>
        <tr><td><?php echo $idioma["Dps"];?>:</td><td><?php echo $Dps?$idioma['Si']:$idioma['No'];?></td></tr>
    </table>
    <input type="button" class="btn btn-info" value="<?php echo $idioma['ActualizarListado']?>" id="actualizarlistado">
    <hr>
    <?php
}
?>