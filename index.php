<?php include_once("login/check.php");?>
<?php include_once("cabecerahtml.php");?>
<script language="javascript" type="text/javascript" src="js/inicio.js"></script>
<?php include_once("cabecera.php");?>
    <div class="box-small span3">
        <a data-rel="tooltip" title="65% de asistentes" class="box-small-link" href="#">
            <div id="visits-count">465<br><br>Alumnos</div>
        </a>
        <div class="box-small-title">Asistencia</div>
        <span id="visits-count-n"class="notification green">+ 65%</span>
    </div>
	<div class="box-small span3">
        <a data-rel="tooltip" title="25% de Atrasos" class="box-small-link" href="#">
            <div id="members-count">45<br><br>Alumnos</div>
        </a>
        <div class="box-small-title">Atrasos</div>
        <span id="members-count-n" class="notification yellow">25%</span>
    </div>
    <div class="box-small span3">
        <a data-rel="tooltip" title="10% de Faltas" class="box-small-link" href="#">
            <div id="members-count">10<br><br>Alumnos</div>
        </a>
        <div class="box-small-title">Faltas</div>
        <span id="members-count-n" class="notification red">10%</span>
    </div>
</div>

<div class="row-fluid">
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
    <div class="span6 box">
    	<div class="box-header"><?php echo $idioma['ObservacionesAgenda']?> - <?php echo $idioma['DiaHoy']?><div class="box-icon"><a href="#" title="<?php echo $idioma['Actualizar']?>" id="actualizaragenda"><i class="icon-refresh"></i></a></div></div>
        <div class="box-content">
        <?php echo $idioma['FechaAgenda']?>
            <?php campo("FechaAgenda","text",date("d-m-Y"),"input-medium")?>
            <a href="agenda/total/" class="btn btn-mini"><i class="icon-plus"></i><?php echo $idioma['RegistrarNuevaObservacion']?></a>
            <div id="listadoagenda" style="max-height:400px;overflow-y:auto;position:relative"></div>
        </div>
    </div>
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
    <div class="span4 box">
    	<div class="box-header">Accesos de Usuarios al Sistema</div>
        <div class="box-content"><ul class="dashboard-list">
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
						</ul></div>
    </div>
</div>
<?php include_once("pie.php");?>