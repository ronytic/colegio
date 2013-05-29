<?php
include_once("../login/check.php");
$folder="../";
$titulo="NAgendaActividades";
$prioridadvalor=array("-1"=>$idioma['Bajo'],"0"=>$idioma['Normal'],"1"=>$idioma['Importante']);
$estadovalor=array("0"=>$idioma['Pendiente'],"1"=>$idioma["Completado"]);
$paraquien=array("0"=>$idioma["SoloParaMi"]);
switch($_SESSION['Nivel']){
	case 1:{$paraquien=array_merge($paraquien,array(1=>$idioma['Administrador'],2=>$idioma['Director'],3=>$idioma['Docentes'],4=>$idioma['Secretaria'],5=>$idioma['Regente'],6=>$idioma['PadreFamilia'],7=>$idioma['Alumnos']));}break;
	case 2:{$paraquien=array_merge($paraquien,array(2=>$idioma['Director'],3=>$idioma['Docentes'],4=>$idioma['Secretaria'],5=>$idioma['Regente'],6=>$idioma['PadreFamilia'],7=>$idioma['Alumnos']));}break;
	case 3:{$paraquien=array_merge($paraquien,array(3=>$idioma['Docentes']));}break;
	case 4:{$paraquien=array_merge($paraquien,array(3=>$idioma['Docentes'],4=>$idioma['Secretaria'],5=>$idioma['Regente'],6=>$idioma['PadreFamilia'],7=>$idioma['Alumnos']));}break;
	case 5:{$paraquien=array_merge($paraquien,array(5=>$idioma['Regente'],6=>$idioma['PadreFamilia'],7=>$idioma['Alumnos']));}break;
}
array("1"=>$idioma['Administrador'],2=>$idioma['Director'],3=>$idioma['Docente'],4=>$idioma['Secretaria'],5=>$idioma['Regente'],6=>$idioma['PadreFamilia'],7=>$idioma['Alumnos'])
?>
<?php include_once($folder."cabecerahtml.php");?>
<script type="text/javascript" src="../js/core/plugins/jquery.chosen.min.js" language="javascript"></script>
<script type="text/javascript" src="../js/agendaactividades/calendario.js"></script>
<?php include_once($folder."cabecera.php");?>
<div class="span8">
	<div class="box">
        <div class="box-header"><h2><i class="icon-calendar"></i><span class="break"></span><?php echo $idioma['CalendarioActividades']?></h2></div>
        <div class="box-content">
            <div class="calendario" style=""></div>
        </div>
    </div>
</div>
<div class="span4 box">
	<div class="box-header"><h2><i class="icon-tasks"></i><span class="break"></span><?php echo $idioma['Actividad']?></h2></div>
    <div class="box-content">
    	<div id="respuestaformulario"></div>
    	<form action="guardaractividad.php" class="formulario" method="post">
    	<table class="tabla table-hover">
        	<tr>
            	<td><?php echo $idioma['FechaActividad']?></td><td><?php echo campo("FechaActividad","text",date("d-m-Y"),"span12 der",1,"",0,array("readonly"=>"readonly"))?>
                <?php echo campo("CodAgendaActividades","hidden","")?>
                </td>
            </tr>
            <tr>
            	<td><?php echo $idioma['HoraInicio']?></td><td><?php echo campo("HoraInicio","time",date("H:i"),"span12 der",1)?></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['HoraFin']?></td><td><?php echo campo("HoraFin","time",date("H:i"),"span12 der",1,"",0,array("min"=>date("H:i")))?></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['Prioridad']?></td><td><?php echo campo("Prioridad","select",$prioridadvalor,"span12",1,"",0,"",0)?></td>
            </tr>
<!--            <tr>
            	<td><?php echo $idioma['Estado']?></td><td><?php echo campo("Estado","select",$estadovalor,"span12",1,"",0,"",0)?></td>
            </tr>-->
            <tr>
            	<td colspan="2"><?php echo $idioma['ParaQuien']?><br>
                	<select name="ParaQuien[]" id="ParaQuien" multiple="multiple" required>
                    
                    <?php foreach($paraquien as $pqk=>$pqv){?>
                    	<option value="<?php echo $pqk?>"<?php echo $pqk==0?'selected':''?>><?php echo $pqv?></option>
                	<?php }?>
                	</select>
                </td>
            </tr>
            <tr>
            	<td><?php echo $idioma['Detalle']?></td><td><?php echo campo("Detalle","textarea","","span12",1,$idioma["IngreseSu"].$idioma['Detalle'],0,array("rows"=>3))?></td>
            </tr>
        </table>
        <input type="submit" class="btn btn-success" value="<?php echo $idioma['GuardarActividad']?>" id="Guardar"> <a  class="btn" id="vaciar" href="./"><?php echo $idioma['Cancelar']?></a>
        </form>
    </div>
</div>
</div>
<div class="row-fluid">
<div class="box">
    	<div class="box-header"><h2><i class="icon-tasks"></i><span class="break"></span><?php echo $idioma['ListaActividades']?></h2></div>
        <div class="box-content">
        	<a name="mostraractividades"></a>
            <div id="listadoactividades" style=""></div>
        </div>
    </div>
</div>
<?php include_once($folder."pie.php");?>