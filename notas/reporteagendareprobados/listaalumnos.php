<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	$CodCurso=$_POST['CodCurso'];
	$CodMateria=$_POST['CodMateria'];
	$Periodo=$_POST['Periodo'];	///cambiar
	include_once("../../class/alumno.php");
	include_once("../../class/curso.php");
	include_once("../../class/config.php");
	include_once("../../class/materias.php");
	include_once("../../class/casilleros.php");
	include_once("../../class/registronotas.php");
	include_once("../../class/agenda.php");
	include_once("../../class/observaciones.php");
	$alumno=new alumno;
	$curso=new curso;
	$agenda=new agenda;
	$materias=new materias;
	$casilleros=new casilleros;
	$registronotas=new registronotas;
	$observaciones=new observaciones;
	$config=new config;
	$cur=$curso->mostrarCurso($CodCurso);
	$cur=array_shift($cur);
	$notareprobacion=$cur['NotaAprobacion'];
	$ini=($cur['Bimestre'])?'Bimestre':'Trimestre';
	$fin=($cur['Bimestre'])?'Bimestre':'Trimestre';
	$PeriodoInicio=($config->mostrarConfig('Inicio'.$ini.$Periodo,1));
	$PeriodoFin=($config->mostrarConfig('Fin'.$fin.$Periodo,1));
	$casillas=$casilleros->mostrarMateriaCursoTrimestre($CodMateria,$CodCurso,$Periodo);
	$casillas=array_shift($casillas);
	$RN=$registronotas->notasCentralizadorAgenda($casillas['CodCasilleros'],$Periodo,$notareprobacion);
	if(!count($RN)){?><div class="alert alert-success"><?php echo $idioma['NoExistenReprobadosParaEstaMateria']?></div><?php exit();}
	?>
    <table class="table table-bordered table-striped table-condensed">
    	<thead>
	    <tr><th>N</th><th><?php echo $idioma['Paterno']?></th><th><?php echo $idioma['Materno']?></th><th><?php echo $idioma['Nombres']?></th><th>Prom</th><th>Dps</th><th>N. F.</th><th>Anotaciones</th>
    </tr>
    </thead>

                <?php
				$i=0;
				foreach($RN as $registroN){$i++;
					$al=$alumno->mostrarDatosPersonales($registroN['CodAlumno']);
					$al=array_shift($al);
					if($al['CodAlumno']!=""){
						$ag=$agenda->mostrarCodMateriaCodAlumnoRango($CodMateria,$al['CodAlumno'],$PeriodoInicio,$PeriodoFin);
					?>
					<tr>
                        <td class="der"><?php echo $i;?></td>
                        <td><?php echo capitalizar($al['Paterno'])?></td>
                        <td><?php echo capitalizar($al['Materno'])?></td>
                        <td><?php echo capitalizar($al['Nombres'])?></td>
                        <td class="der amarillo"><?php echo $registroN['Resultado']?></td>
                        <td class="der amarillo"><?php echo $registroN['Dps']?></td>
                        <td class="der verde"><?php echo $registroN['NotaFinal']?></td>
                        <td class="der"><span class="badge badge-important"><?php echo count($ag)?></span> <a href="#" class="btn btn-mini ver"><i class="icon-chevron-down"></i></a></td>
					</tr>
                    <tr class="ocultar">
                    	<td colspan="8">
                        	<a href="../../agenda/total/agenda.php?CodAl=<?php echo $al['CodAlumno']?>" class="btn btn-mini pull-right" target="_blank"><?php echo $idioma['VerAgenda']?></a>
                        	<table class="table table-bordered table-hover">
                                <thead>
                                    <tr><th><?php echo $idioma['Observacion']?></th><th><?php echo $idioma['Detalle']?></th><th><?php echo $idioma['Fecha']?></th></tr>
                                </thead>
								<?php foreach($ag as $a){
                                $o=$observaciones->mostrarObser($a['CodObservacion']);
                                $o=array_shift($o);
                                ?>
                                <tr>
                                    <td><?php echo $o['Nombre']?></td>
                                    <td width="180"><?php echo $a['Detalle'];?></td>
                                    <td width="70" class="pequeno"><?php echo fecha2Str($a['Fecha']);?></td>
                                </tr>
                                <?php }?>
                            </table>
                        </td>
					</tr>
					<?php
					}			
				}
			?>
    </table>
    <?php
}
?>