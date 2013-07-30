<?php include_once("login/check.php");
$titulo="NPaginaPrincipal";
?>
<?php include_once("cabecerahtml.php");?>
<script language="javascript" type="text/javascript" src="js/inicio.js"></script>
<?php include_once("cabecera.php");?>
<?php if($_SESSION['Nivel']==1 ||$_SESSION['Nivel']==2||$_SESSION['Nivel']==4||$_SESSION['Nivel']==5):?>
    <div id="asistenciarapida"></div>
    <div class="box-small span1">
    <a href="#" title="<?php echo $idioma['Actualizar']?>" id="actualizarasistencia" class="box-small-link"><i class="icon-refresh"></i></a>
    </div>
    <?php endif;?>
</div>

<div class="row-fluid">
	<?php if($_SESSION['Nivel']==1 ||$_SESSION['Nivel']==2):?>
	<div class="span6 box">
    	<div class="box-header"><h2><?php echo $idioma['EstadisticasInstantaneaPagoCuotas']?></h2><div class="box-icon"><a href="#" title="<?php echo $idioma['Actualizar']?>" id="actualizarcuotas"><i class="icon-refresh"></i></a></div></div>
        <div class="box-content">
        	<?php echo $idioma['FechaCuotas']?>
            <?php campo("FechaCuotas","text",date("d-m-Y"),"input-medium")?>
            <a href="cuotas/pagar/" class="btn btn-mini"><i class="icon-plus"></i><?php echo $idioma['RegistrarNuevosPagos']?></a>
            <hr>
            <div id="listadocuotas" style="max-height:400px;overflow-y:auto"></div>
        </div>
    </div>
    <?php endif;?>
    <?php if($_SESSION['Nivel']==1 ||$_SESSION['Nivel']==2 ||$_SESSION['Nivel']==4 ||$_SESSION['Nivel']==5 ):?>
    <div class="span6 box">
    	<div class="box-header"><?php echo $idioma['ObservacionesAgenda']?> - <?php echo $idioma['DiaHoy']?><div class="box-icon"><a href="#" title="<?php echo $idioma['Actualizar']?>" id="actualizaragenda"><i class="icon-refresh"></i></a></div></div>
        <div class="box-content">
        <?php echo $idioma['FechaAgenda']?>
            <?php campo("FechaAgenda","text",date("d-m-Y"),"input-medium")?>
            <a href="agenda/total/" class="btn btn-mini"><i class="icon-plus"></i><?php echo $idioma['RegistrarNuevaObservacion']?></a>
            <div id="listadoagenda" style="max-height:400px;overflow-y:auto;position:relative"></div>
        </div>
    </div>
    <?php endif;?>
    <?php if($_SESSION['Nivel']==6 ||$_SESSION['Nivel']==7):?><a href="internet/alumno/" class="btn btn-large btn-danger"><?php echo $idioma['VersionResumida']?></a><?php endif;?>
</div>
<div class="row-fluid">
	<div class="span8 box">
    	<div class="box-header"><h2><i class="icon-calendar"></i><span class="break"></span><?php echo $idioma['AgendaActividades']?></h2><div class="box-icon"><a href="#" title="<?php echo $idioma['Actualizar']?>" id="actualizaractividades"><i class="icon-refresh"></i></a></div></div>
        <div class="box-content">
        	<?php echo $idioma['FechaActividad']?>
            <?php campo("FechaActividad","text",date("d-m-Y"),"input-medium")?>
            <a href="agendaactividades/" class="btn btn-mini"><i class="icon-plus"></i><?php echo $idioma['RegistrarNuevaActividad']?></a>
            <hr>
            <div id="listadoactividades"></div>
        </div>
    </div>
    <?php if($_SESSION['Nivel']==1 ||$_SESSION['Nivel']==2):?>
    <div class="span4 box">
    	<div class="box-header">Accesos de Usuarios al Sistema</div>
        <div class="box-content">
        	<ul class="dashboard-list">
            <li>
                <a href="#">
                    <img class="dashboard-avatar" alt="Lucas" src="img/avatar.jpg">
                </a>
                <strong>Nombre:</strong> <a href="#">Jaime</a><br>
                <strong>Fecha:</strong> 17/05/2013<br>
                <strong>Estado:</strong> <span class="label label-success">En Linea</span>                                  
            </li>
            <li>
                <a href="#">
                    <img class="dashboard-avatar" alt="Bill" src="img/avatar.jpg">
                </a>
                <strong>Nombre:</strong> <a href="#">Marco</a><br>
                <strong>Fecha:</strong> 17/05/2013<br>
                <strong>Estado:</strong> <span class="label label-warning">Sin Uso</span>                                 
            </li>
            <li>
                <a href="#">
                    <img class="dashboard-avatar" alt="Jane" src="img/avatar.jpg">
                </a>
                <strong>Nombre:</strong> <a href="#">Reynaldo</a><br>
                <strong>Since:</strong> 17/05/2013<br>
                <strong>Estado:</strong> <span class="label label-important">Fuera de Linea</span>                                  
            </li>
            <li>
                <a href="#">
                    <img class="dashboard-avatar" alt="Kate" src="img/avatar.jpg">
                </a>
                <strong>Nombre:</strong> <a href="#">Marco</a><br>
                <strong>Fecha:</strong> 17/05/2013<br>
                <strong>Estado:</strong> <span class="label label-info">En Linea</span>                                  
            </li>
			</ul>
        </div>
    </div>
    <?php endif;?>
</div>
<script type="text/javascript">
</script><?php include_once("pie.php");?>