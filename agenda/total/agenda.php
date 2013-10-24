<?php
include_once("../../login/check.php");
if(!empty($_GET['CodAl'])){
	include_once("../../class/materias.php");
	include_once("../../class/alumno.php");
	include_once("../../class/curso.php");
	include_once("../../class/observaciones.php");
	include_once("../../class/observacionesfrecuentes.php");
	include_once("../../class/config.php");
	$titulo="AgendaDigital";
	$folder="../../";
	$CodAlumno=$_GET['CodAl'];
	$_SESSION['CodAl']=$CodAlumno;
	$materia=new materias;
	$observaciones=new observaciones;
	$observacionesfrecuentes=new observacionesfrecuentes;
	$alumno=new alumno;
	$curso=new curso;
	$config=new config;
	if($Internet==1){
		$EstadoSms="NoEnviar";	
	}else{
		$EstadoSms=$config->mostrarConfig("EstadoSms",1);
	}
	$al=$alumno->mostrarTodoDatos($CodAlumno);
	$al=array_shift($al);
	$cur=$curso->mostrarCurso($al['CodCurso']);
	$cur=array_shift($cur);
	$ima=$folder."imagenes/alumnos/".$al['Foto'];
	if(!file_exists($ima) || empty($al['Foto'])){
	 $ima=$folder."imagenes/alumnos/0.jpg";	
}
	?>
    <?php include_once($folder."cabecerahtml.php");?>
    <script language="javascript" type="text/javascript" src="../../js/agenda/registro.js"></script>
    <script language="javascript">var CodCurso
	$(document).ready(function(e) {
    CodCurso=<?php echo $al['CodCurso']?>;   
	Error="<?php echo $idioma['Error']?>"; 
	FalloRegistro="<?php echo $idioma['FalloRegistro']?>"; 
	EstadoSms="<?php echo $EstadoSms?>";
	MensajeEnvioSMS="<?php echo $idioma['MensajeEnvioSMS']?>";
    });
	
    </script>
    <?php include_once($folder."cabecera.php");?>
    <div class="span9 box">
     	<div class="box-header"><?php echo $idioma['DatosPersonales']?></div>
     	<div class="box-content">
            	<table class="tabla">
                    <tr>
                    	<td rowspan="4"><img src="<?php echo $ima?>" class="img-polaroid" width="100"/></td><td><?php echo $idioma['Nombre']?>:</td>
                        <td colspan="3" class="text-info x2"><?php echo capitalizar($al['Paterno']." ".$al['Materno']." ".$al['Nombres'])?></span></td></tr>
                    <tr>
                    	<td><?php echo $idioma['Curso']?>:</td><td class="text-info"><?php echo $cur['Nombre']?></span></td>
                    <td><?php echo $idioma['Telefono']?>:</td><td class="text-info"><?php echo $al['TelefonoCasa']?> <?php echo $al['Celular']?></span></td></tr>
                    <tr><td><?php echo $idioma['CelularMadre']?>:</td><td class="text-info"><?php echo $al['CelularM']?></td><td><?php echo $idioma['CelularPadre']?>:</td><td class="text-info"><?php echo $al['CelularP']?></td></tr>
                </table>
        </div>
     </div>
      
     <div class="span3 box" >
     
       	<div class="" style="">
        	<div class="box-header"><?php echo $idioma['Acciones']?></div>
            <div class="box-content">
            	<a class="btn btn-danger registrar"><?php echo $idioma['Registrar']?></a> <a class="btn terminar"><?php echo $idioma['Terminar']?></a><br /><br />
                <a class="btn reportegeneral"><?php echo $idioma['ReporteGeneral']?></a>
                <a class="btn btn-info reporteimprimir"><?php echo $idioma['ReporteImprimir']?></a>
                <div class="alert alert-info">
                <label for="Busqueda"  class="pequeno"><?php echo $idioma["BusquedaEspecificaPorMateria"]?>:<?php campo("Busqueda","checkbox","1","")?></label> 
                </div>
            </div>
        </div>
     </div>
</div>
<div class="sortable row-fluid">
     <div class="span3">
     	<div class="box-header"><?php echo $idioma['Materias']?></div>
		<div class="box-content">
        	<input type="search" name="sMateria" class="span12" placeholder="<?php echo $idioma['BuscarMateriaPor']?>"/>
        	<select name="Materia" class="span12">
        	<?php
            	foreach($materia->mostrarMaterias() as $m){
				?>
                <option value="<?php echo $m['CodMateria'];?>" ><?php echo $m['Nombre'];?></option>
                <?php
				}
			?>
            </select>
        </div>
     </div>
     
     <div class="span3">
     	<div class="">
     	<div class="box-header"><?php echo $idioma['Observaciones']?></div>
        <div class="box-content">
        <input type="search" name="sObservaciones" class="span12" placeholder="<?php echo $idioma['BuscarObservacionesPor']?>"/>
        	<select name="Observaciones">
        	<?php
            	foreach($observaciones->mostrarObservaciones() as $o){
				?>
                <option value="<?php echo $o['CodObservacion'];?>"><?php echo $o['Nombre'];?></option>
                <?php
				}
			?>
            </select>
        </div>
        </div>
        <div class="box-header"><?php echo $idioma['Detalle']?></div>
        <div class="box-content">
        	<?php echo $idioma['Fecha']?>:
            <?php campo("fecha","text",date("Y-m-d"),"span6",1,$idioma['IngreseFecha'])?>
            <div id="fechac"></div>
            <?php echo $idioma['Detalle']?>: <br />
            <?php foreach($observacionesfrecuentes->mostrarObservacionesFrecuentes() as $of){?>
            <a class="btn btn-mini completar" rel="<?php echo $of['Valor']?>"><?php echo $of['Nombre']?></a>
            <?php }?>
            <br />
        	<textarea name="detalle" cols="22" rows="3" class="span12" placeholder="<?php echo $idioma['IngreseDetalle']?>"></textarea>
            <div class="alert alert-error">
            <label for="im" class="checkbox text-error"><?php echo $idioma['Importante']?><input type="checkbox" id="im" name="importante" /></label>
            </div>
        </div>
        <div class="box-content">
            	<a class="btn btn-danger registrar" id=""><?php echo $idioma['Registrar']?></a> <a class="btn terminar"><?php echo $idioma['Terminar']?></a>
            </div>
     </div>
     <div class="span6">
        <div class="box-header"><?php echo $idioma['ListaObservaciones']?></div>
        <div class="box-content" id="respuesta">
			
        </div>
     </div>
     <div class="clear"></div>

     <?php	include_once($folder."pie.php");?>
    <?php
}
?>