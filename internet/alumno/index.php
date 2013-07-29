<?php
include_once("../../login/check.php");
$titulo="NAgendaAlumnos";
include_once("../../class/config.php");
include_once("../../class/alumno.php");
include_once("../../class/cursomateria.php");
include_once("../../class/materias.php");
include_once("../../class/cuota.php");
include_once("../../class/observaciones.php");
include_once("../../class/curso.php");
include_once("../../class/tarea.php");
include_once("../../class/agenda.php");
include_once("../../class/tarea.php");
include_once("../../class/registronotas.php");
include_once("../../class/casilleros.php");
$alumno=new alumno;
$config=new config;
$curso=new curso;
$tarea=new tarea;
$materia=new materias;
$cuota=new cuota;
$agenda=new agenda;
$tarea=new tarea;
$cursomateria=new cursomateria;
$observaciones=new observaciones;
$registronotas=new registronotas;
$casilleros=new casilleros;
$CodAlumno=$_SESSION['CodUsuarioLog'];
$al=$alumno->mostrarTodoDatos($CodAlumno);
$al=array_shift($al);
$cur=$curso->mostrarCurso($al['CodCurso']);
$cur=array_shift($cur);
$cnf=($config->mostrarConfig("FechaCuota1"));
$FechaCuota1=$cnf['Valor'];
$cnf=($config->mostrarConfig("FechaCuota2"));
$FechaCuota2=$cnf['Valor'];
$cnf=($config->mostrarConfig("FechaCuota3"));
$FechaCuota3=$cnf['Valor'];
$cnf=($config->mostrarConfig("FechaCuota4"));
$FechaCuota4=$cnf['Valor'];
$cnf=($config->mostrarConfig("FechaCuota5"));
$FechaCuota5=$cnf['Valor'];
$cnf=($config->mostrarConfig("FechaCuota6"));
$FechaCuota6=$cnf['Valor'];
$cnf=($config->mostrarConfig("FechaCuota7"));
$FechaCuota7=$cnf['Valor'];
$cnf=($config->mostrarConfig("FechaCuota8"));
$FechaCuota8=$cnf['Valor'];
$cnf=($config->mostrarConfig("FechaCuota9"));
$FechaCuota9=$cnf['Valor'];
$cnf=($config->mostrarConfig("FechaCuota10"));
$FechaCuota10=$cnf['Valor'];

$v=$config->mostrarConfig("LogoIcono");
$LogoIcono=$v['Valor'];
$folder="../../";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $idioma['NSistemaInternet']?></title>
<link href="<?php echo $folder?>css/bootstrap.css" type="text/css" rel="stylesheet" />
<link href="../../css/internet.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="<?php echo $folder?>imagenes/logos/<?php echo $LogoIcono?>" />
</head>
<body>
<div class="row-fluid" class="wrapper">
	<div class="span12">
    	<a name="datos"></a>
    	 <div class="cuerpo">
         	<img src="../../imagenes/alumnos/<?php echo $al['Sexo'].".png"?>" class="foto"/>
         	<div class="datos">
            	
        		<h1 class="nombre"><?php echo ucwords($al['Paterno']." ".$al['Materno']." ".$al['Nombres'])?></h1>
                <p class="otrosdatos"><?php echo $cur['Nombre']?></p>
                <p class="otrosdatos"><?php echo $al['Sexo']?$idioma['Hombre']:$idioma['Mujer'];?></p>
                <p class="otrosdatos"><?php echo $al['Ci']?></p>
                <p class="otrosdatos"><?php echo ucwords($al['Zona']." ".$al['Calle']." ".$al['Numero'])?></p>
            </div>
            <div class="acciones">
            	<div class="botones">
    	        	<a href="../../" class="inicio"><?php echo $idioma["Inicio"]?></a>
	                <a href="../../login/logout.php" class="salir"><?php echo $idioma["Salir"]?></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row-fluid" class="wrapper">
    <div class="span3">
    	<div class="cuerpo">
        	<h2><a name="cuotas"></a><?php echo $idioma["Cuotas"]?></h2>
            <table class="tabla">
            	<?php
				$total=0;
				$totalDeuda=0;
				foreach($cuota->mostrarCuotas($al['CodAlumno']) as $cuo){
					?>
                    <tr>
                    	<td class="div"><?php echo $cuo['Numero'];?></td>
                        <td  class="div"><?php echo $cuo['MontoPagar'];?> Bs.</td>
                        <td><?php echo $cuo['Cancelado']?$idioma['Cancelado']:$idioma['Pendiente'];?></td>
                        <td><i class="icon-ok"></i></td>
                    </tr>
                    <?php
					$total+=$cuo['MontoPagar'];
					if($cuo['Cancelado']){$totalDeuda+=$cuo['MontoPagar'];}
				}
				?>
            </table>
            <div class="msgA"><?php echo $idioma['MontoAdeudado']?>: <?php echo $total-$totalDeuda;?> Bs.</div>
        </div>
    </div>
    <div class="span9">
    	<div class="cuerpo">
        	<h2><a name="agenda"></a><?php echo $idioma['Agenda']?></h2>
            <?php echo $idioma['OrdenObservaciones']?>
            <table class="tabla">
          	  <tr class="cabecera"><td width="25">Nº</td><td width="90"><?php echo $idioma['Fecha']?></td><td width="120"><?php echo $idioma['Materia']?></td><td width="150"><?php echo $idioma['Observacion']?></td><td width="300"><?php echo $idioma['Detalle']?></td></tr>
            	<?php
                $i=0;
                foreach($agenda->mostrarRegistros($al['CodAlumno']) as $ag){
					$i++;
					$ma=$materia->mostrarMateria($ag['CodMateria']);
					$ma=array_shift($ma);
					$obs=$observaciones->mostrarObser($ag['CodObservacion']);
					$obs=array_shift($obs);
					?>
                    <tr><td class="div"><?php echo $i;?></td><td class="div"><?php echo date("d-m-Y",strtotime($ag['Fecha']));?></td><td class="div"><?php echo $ma['Nombre'];?></td><td class="div"><?php echo $obs['Nombre'];?></td><td><?php echo $ag['Detalle']?></td></tr>
                    <?php
				}
				if($i==0){
				?>
                	<tr><td colspan="5" class="centrar"><?php echo $idioma['NoCuentaConAnotacionesALaFecha']?></td></tr>
                <?php
				}
				?>
            </table>
        </div>
   </div>
</div>
<div class="row-fluid">
    <div class="span6">
        <div class="cuerpo">
            <h2><a name="tareaspendientes"></a><?php echo $idioma['TareasPendientes']?></h2>
            <table class="tabla">
                <tr class="cabecera"><td width="15">Nº</td><td width="80"><?php echo $idioma['Materia']?></td><td width="160"><?php echo $idioma['Nombre']?></td><td width="130"><?php echo $idioma['Detalle']?></td><td width="80"><span title="<?php echo $idioma['FechaPresentacion']?>"><?php echo $idioma['Fecha']?></span></td></tr>
                <?php
            $i=0;
            $Fecha=date("Y-m-d");
            foreach($tarea->mostrarTareaCursoPendiente($al['CodCurso'],$Fecha) as $ta){
                $i++;
                $ma=$materia->mostrarMateria($ta['CodMateria']);
                $ma=array_shift($ma);
                ?>
                <tr><td class="div"><?php echo $i;?></td><td class="div"><?php echo $ma['Nombre'];?></td><td class="div"><?php echo ucfirst(mb_strtolower($ta['Nombre'],"UTF-8"));?></td><td class="div"><?php echo ucfirst(mb_strtolower($ta['Descripcion'],"UTF-8"));?></td><td><?php echo utf8_encode(strftime("%A, %d-%b",strtotime($ta['FechaPresentacion'])))?></td></tr>
                <?php
            }
            if($i==0){
            ?>
                <tr><td colspan="5" class="centrar"><?php echo $idioma['NoTieneTareasPendientes']?></td></tr>
            <?php
            }
            ?>
            </table>
        </div>
    </div>
    <div class="span6">
        <div class="cuerpo">
            <h2><a name="tareasrevisadas"></a><?php echo $idioma['TareasRevisadas']?></h2>
            <table class="tabla">
                <tr class="cabecera"><td width="15">Nº</td><td width="80"><?php echo $idioma['Materia']?></td><td width="160"><?php echo $idioma['Nombre']?></td><td width="130"><?php echo $idioma['Detalle']?></td><td width="80"><span title="<?php echo $idioma['FechaPresentacion']?>"><?php echo $idioma['Fecha']?></span></td></tr>
            <?php
            $i=0;
            $Fecha=date("Y-m-d");
            foreach($tarea->mostrarTareaCursoRevisadas($al['CodCurso'],$Fecha) as $ta){
                $i++;
                $ma=$materia->mostrarMateria($ta['CodMateria']);
                $ma=array_shift($ma);
                ?>
                <tr><td class="div"><?php echo $i;?></td><td class="div"><?php echo $ma['Nombre'];?></td><td class="div"><?php echo ucfirst(mb_strtolower($ta['Nombre'],"UTF-8"));?></td><td class="div"><?php echo ucfirst(mb_strtolower($ta['Descripcion'],"UTF-8"));?></td><td><?php echo utf8_encode(strftime("%A, %d-%b",strtotime($ta['FechaPresentacion'])))?></td></tr>
                <?php
            }if($i==0){
            ?>
                <tr><td colspan="5" class="centrar"><?php echo $idioma['NoTieneTareasRevisadas']?></td></tr>
            <?php
            }
            ?>
            </table>
        </div>
    </div>
</div>
<div class="row-fluid">
	<div class="span12">
    	<div class="cuerpo">
        	<h2><a name="notas"></a><?php echo $idioma['Notas']?></h2>
            <table class="tabla">
            	<tr class="cabecera"><td width="150"><?php echo $idioma['Materias']?></td>
                <?php for($i=1;$i<=$cur['CantidadEtapas'];$i++){?>
                	<td colspan="3"><?php echo $i?> <?php echo $cur['Bimestre']?$idioma['Bimestre']:$idioma['Trimestre'];?></td>
                <?php }?>
                <td width="90"><?php echo $idioma['PromedioAnual']?></td><td><?php echo $idioma['Reforzamiento']?></td><td><?php echo $idioma['PromedioFinal']?></td></tr>
                <?php if($cur['Bimestre']){?>
					<tr></tr>
				<?php }else{?><tr><td></td><td>PC</td><td>DPS</td><td>PT</td><td>PC</td><td>DPS</td><td>PT</td><td>PC</td><td>DPS</td><td>PT</td><td></td><td></td><td></td></tr>
                <?php }?>
                <?php
				if(strtotime($Fecha)>strtotime($FechaCuota1)){
					
				}
				
				foreach($cursomateria->mostrarMaterias($al['CodCurso']) as $cm){
					$ma=array_shift($materia->mostrarMateria($cm['CodMateria']));
					$casillas=array_shift($casilleros->mostrarMateriaCursoSexoTrimestre($cm['CodMateria'],$al['CodCurso'],$al['Sexo'],1));
					$rn1=array_shift($registronotas->mostrarRegistroNotas($casillas['CodCasilleros'],$al['CodAlumno'],1));
					$casillas=array_shift($casilleros->mostrarMateriaCursoSexoTrimestre($cm['CodMateria'],$al['CodCurso'],$al['Sexo'],2));
					$rn2=array_shift($registronotas->mostrarRegistroNotas($casillas['CodCasilleros'],$al['CodAlumno'],2));
					$casillas=array_shift($casilleros->mostrarMateriaCursoSexoTrimestre($cm['CodMateria'],$al['CodCurso'],$al['Sexo'],3));
					$rn3=array_shift($registronotas->mostrarRegistroNotas($casillas['CodCasilleros'],$al['CodAlumno'],3));
					
					$casillas=array_shift($casilleros->mostrarMateriaCursoSexoTrimestre($cm['CodMateria'],$al['CodCurso'],$al['Sexo'],4));
					$rn3=array_shift($registronotas->mostrarRegistroNotas($casillas['CodCasilleros'],$al['CodAlumno'],4));
					if($cur['Bimestre']){
						$promedio=$registronotas->promedioBimestre($rn1['NotaFinal'],$rn2['NotaFinal'],$rn3['NotaFinal'],$rn4['NotaFinal']);	
					}else{
						$promedio=$registronotas->promedio($rn1['NotaFinal'],$rn2['NotaFinal'],$rn3['NotaFinal']);
					}
					?>
                    <tr>
                    	<td class="div"><?php echo $ma['Nombre'];?></td>
                        <?php if($cur['Bimestre']){
							?>
                            <td colspan="3" class="div der <?php echo $cur['NotaAprobacion']>$rn1['NotaFinal']?'rojo':'';?>"><?php echo $rn1['NotaFinal'];?></td>
                            <td colspan="3" class="div der <?php echo $cur['NotaAprobacion']>$rn1['NotaFinal']?'rojo':'';?>"><?php echo $rn2['NotaFinal'];?></td>
                            <td colspan="3" class="div der <?php echo $cur['NotaAprobacion']>$rn1['NotaFinal']?'rojo':'';?>"><?php echo $rn3['NotaFinal'];?></td>
                            <td colspan="3" class="div der <?php echo $cur['NotaAprobacion']>$rn1['NotaFinal']?'rojo':'';?>"><?php echo $rn4['NotaFinal'];?></td>
                            <?php
						}else{
						?>
                        <td class="div der <?php echo $cur['NotaAprobacion']>$rn1['NotaFinal']?'rojo':'';?>"><?php echo $rn1['Resultado'];?></td>
                        <td class="div der <?php echo $cur['NotaAprobacion']>$rn1['NotaFinal']?'rojo':'';?>"><?php echo $rn1['Dps'];?></td>
                        <td class="div der <?php echo $cur['NotaAprobacion']>$rn1['NotaFinal']?'rojo':'';?>"><?php echo $rn1['NotaFinal'];?></td>
                        <td class="div der <?php echo $cur['NotaAprobacion']>$rn2['NotaFinal']?'rojo1':'';?>"><?php echo $rn2['Resultado'];?></td>
                        <td class="div der <?php echo $cur['NotaAprobacion']>$rn2['NotaFinal']?'rojo1':'';?>"><?php echo $rn2['Dps'];?></td>
                        <td class="div der <?php echo $cur['NotaAprobacion']>$rn2['NotaFinal']?'rojo1':'';?>"><?php echo $rn2['NotaFinal'];?></td>
                        <td class="div der <?php echo $cur['NotaAprobacion']>$rn3['NotaFinal']?'rojo1':'';?>"><?php echo $rn3['Resultado'];?></td>
                        <td class="div der <?php echo $cur['NotaAprobacion']>$rn3['NotaFinal']?'rojo1':'';?>"><?php echo $rn3['Dps'];?></td>
                        <td class="div der <?php echo $cur['NotaAprobacion']>$rn3['NotaFinal']?'rojo1':'';?>"><?php echo $rn3['NotaFinal'];?></td>
                        <?php }?>
                        <td class="div der"><?php echo $promedio?></td>
                        <td class="div der">0</td>
                        <td class="der">0</td></tr>
                    <?php
				}
				?>
            </table>
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="span12">
    	<div class="cuerpo pie">
        	<?php echo $idioma['TituloSistema']?> &copy; <?php echo $idioma['DerechosReservados']?> 2011 - <?php echo date("Y")?>
            <p class="pull-right"><?php echo $idioma['DesarrolladoPor'];?>: <a href="http://fb.com/ronaldnina" title="http://fb.com/ronaldnina - 73230568" target="_blank" class="link">Ronald Nina Layme</a></p>
        </div>
    </div>
</div>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-30922203-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>