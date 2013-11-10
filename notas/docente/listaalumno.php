<?php
include_once("../../login/check.php");
include_once("../../class/config.php");
include_once("../../class/alumno.php");
include_once("../../class/casilleros.php");
include_once("../../class/docentemateriacurso.php");
include_once("../../class/registronotas.php");
include_once("../../class/curso.php");
include_once("../../class/materias.php");
//include_once("../fn.php");
if(!empty($_POST)){
	$CodCurso=$_POST['CodCurso'];
	$CodMateria=$_POST['CodMateria'];
	$CodDocente=$_SESSION['CodDocente'];
	$CodPeriodo=$_POST['CodPeriodo'];
	$alumnos=new alumno;
	$docentemateriacurso=new docentemateriacurso;
	$casilleros=new casilleros;
	$registroNotas=new registronotas;
	$config=new config;
	$curso=new curso;
	$materias=new materias;
	$mat=$materias->mostrarMateria($CodMateria);
	$mat=array_shift($mat);
	$cur=$curso->mostrarCurso($CodCurso);
	$cur=array_shift($cur);
	
	$casillas=$casilleros->mostrarDocenteMateriaCursoTrimestre($CodDocente,$CodMateria,$CodCurso,$CodPeriodo);
	$casillas=array_shift($casillas);
	
	$CodCasilleros=$casillas['CodCasilleros'];
	$Sexo=$casillas['SexoAlumno'];
	$numcasilleros=$casillas['Casilleros'];
	$Dps=$casillas['Dps'];
	$FormulaCalificaciones=$dcasillas['FormulaCalificaciones'];
	
	$cnf=$config->mostrarConfig("RegistroNotaHabilitado");
	$RegistroNotaHabilitado=$cnf["Valor"];
	$cnf=$config->mostrarConfig("PeriodoNotaHabilitado");
	$PeriodoNotaHabilitado=$cnf["Valor"];
	if($RegistroNotaHabilitado==1){
		if($CodPeriodo!=$PeriodoNotaHabilitado)
		{$restringir='readonly="readonly" disabled="disabled"';}
		else{$restringir='';}
	}else{
		$restringir='readonly="readonly" disabled="disabled"';	
	}
	
	for($i=1;$i<=15;$i++){
		$Etiquetas[$i]=$docMat['NombreCasilla'.$i];
	}
	if(count($casillas)<=0){?>
    <span class="resaltar"><?php echo $idioma['NoExisteCasillerosRegistradosParaEste']?> <?php echo $idioma['Docente']?>, <?php echo $idioma['Curso']?>, <?php echo $idioma['Materia']?> <?php echo $idioma['Y']?> <?php echo $cur['Bimestre']?$idioma['Bimestre']:$idioma['Trimestre']?></span>
    <?php exit();}
	?>
    <input type="hidden" name="NotaAprobacion" value="<?php echo $cur['NotaAprobacion']?>"/>
    <a id="exportarexcel" class="btn btn-success btn-mini"><?php echo $idioma['ExportarExcel']?></a>
	<table class="table table-bordered table-striped table-hover table-condensed">
    	<thead>
        <tr>
        	<th colspan="<?php echo $numcasilleros+7?>">
			<?php echo $idioma['Curso']?>: <?php echo $cur['Nombre']?> | 
			<?php echo $idioma['Materia']?>: <?php echo $mat['Nombre']?> |
            <?php echo $cur['Bimestre']?$idioma['Bimestre']:$idioma['Trimestre']?>:<?php echo $CodPeriodo?> | 
            <?php echo $idioma['NotaCalifcacion']?>: <?php echo $cur['NotaTope']?> |
            <?php echo $idioma['NotaAprobacion']?>: <?php echo $cur['NotaAprobacion']?> 
            </th>
		</tr>
		<tr><th>Nº</th><th>Paterno</th><th>Materno</th><th>Nombres</th>
        	<?php for($i=1;$i<=$numcasilleros;$i++){?>
     		<th style="width:10px"><span title="<?php echo $casillas['NombreCasilla'.$i];?>, <?php echo $idioma['LimiteMinimo'].": ".$casillas['LimiteMinCasilla'.$i];?> <?php echo $idioma['Limite'].": ".$casillas['LimiteCasilla'.$i];?>" rel="<?php echo $casillas['LimiteCasilla'.$i];?>" rel-min="<?php echo $casillas['LimiteMinCasilla'.$i];?>" id="t<?php echo $i;?>"><?php echo sacarIniciales($casillas['NombreCasilla'.$i])?>-<?php echo $casillas['LimiteCasilla'.$i];?></span></th>
     <?php }?>
        	<th class="" style="width:10px"><?php echo $idioma['Resultado']?></th>
			<?php if($Dps){?><th style="width:10px"><?php echo $idioma['Dps']?></th><?php }?>
            <th style="width:10px"><?php echo $idioma['Final']?></th>
	    </tr> 
		</thead>
	<?php
	$na=0;
	$numero=0;
	foreach($alumnos->mostrarAlumnosCurso($CodCurso,$Sexo) as $al){
		$na++;
		$regNota=$registroNotas->mostrarRegistroNotas($CodCasilleros,$al['CodAlumno'],$CodPeriodo);
		$regNota=array_shift($regNota);
		?>
       
        <tr class="contenido" style="height:35px;"  rel="<?php echo $al['CodAlumno']?>">
        	<td><?php echo $na;?></td>
            <td><?php echo capitalizar($al['Paterno']);?></td>
            <td><?php echo capitalizar($al['Materno']);?></td>
            <td><?php echo capitalizar($al['Nombres']);?></td>
            <?php for($i=1;$i<=$numcasilleros;$i++){$numero++;?>
            <td style="text-align:center">
            <input type="text" size="3" maxlength="<?php echo strlen($cur['NotaTope'])?>" class="input-mini nota <?php echo($i==$numcasilleros)?'final':'';?>" value="<?php echo $regNota['Nota'.$i]?>" id="al[<?php echo $na;?>][n<?php echo $i;?>]" rel="<?php echo $al['CodAlumno']?>" data-col="<?php echo $i;?>" data-row="<?php echo $al['CodAlumno'];?>" data-cod="<?php echo $CodCasilleros;?>" <?php echo $restringir?> style="max-width:30px !important" tabindex="<?php echo $numero?>"/></td>
            <?php
			}
			?>
            <td style="text-align:center" class="amarillo"><input type="text" size="1" maxlength="2" readonly class="nota" value="<?php echo $regNota['Resultado']?>" id="resultado<?php echo $al['CodAlumno']?>" style="max-width:30px !important"/></td>
            <?php
				if($Dps){
			?>
            <td style="text-align:center" class="amarillo"><input type="text" size="1" maxlength="2" readonly class="nota" value="<?php echo $regNota['Dps']?>" id="dps<?php echo $al['CodAlumno']?>" style="max-width:30px !important"/></td>
            <?php
				}
			?>
            <td style="text-align:center" class="celeste"><input type="text" size="1" maxlength="2" readonly class="nota <?php echo $regNota['NotaFinal']<$cur['NotaAprobacion']?"crojo reprobado":"";?>" value="<?php echo $regNota['NotaFinal']?>" id="notaf<?php echo $al['CodAlumno']?>" style="max-width:30px !important"/></td>
        </tr>
	<?php
	}
	?> 
    </table>
    <hr />
	<input type="submit" value="<?php echo $idioma["GuardarNota"]?>" class="btn" id="guardarNotas"/>
	<?php
}
?>