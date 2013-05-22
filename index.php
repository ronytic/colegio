<?php include_once("login/check.php");?>
<?php include_once("cabecerahtml.php");?>
<?php include_once("cabecera.php");?>
    <div class="box-small span3">
        <a data-rel="tooltip" title="55% visits growth." class="box-small-link" href="#">
            <div id="visits-count">465<br><br>alumnos</div>
        </a>
        <div class="box-small-title">Asistencia</div>
        <span id="visits-count-n"class="notification green">+ 65%</span>
    </div>
	<div class="box-small span3">
        <a data-rel="tooltip" title="1586 new members." class="box-small-link" href="#">
            <div id="members-count">45<br><br>Alumnos</div>
        </a>
        <div class="box-small-title">Atrasos</div>
        <span id="members-count-n" class="notification yellow">25%</span>
    </div>
    <div class="box-small span3">
        <a data-rel="tooltip" title="1586 new members." class="box-small-link" href="#">
            <div id="members-count">10<br><br>Alumnos</div>
        </a>
        <div class="box-small-title">Faltas</div>
        <span id="members-count-n" class="notification red">10%</span>
    </div>
</div>

<div class="row-fluid">
	<div class="span6 box">
    	<div class="box-header">Estadisticas de Pago Cuotas Diario</div>
        <div class="box-content">Muy Pronto...</div>
    </div>
    <div class="span6 box">
    	<div class="box-header">Observaciones de Agenda del Día de Hoy</div>
        <div class="box-content">Muy Pronto...</div>
    </div>
</div>
<div class="row-fluid">
	<div class="span8 box">
    	<div class="box-header">Agenda de Actividades - Semana</div>
        <div class="box-content">
        	<table class="table table-bordered table-striped table-hover">
            	<thead>
                	<tr><th>Estado</th><th>Prioridad</th><th>Fecha</th><th>Hora</th><th>Actividad</th></tr>
                </thead>
            	<tr><td><span class="label label-info">Pendiente</span></td><td><span class="label label-success">Normal</span></td><td>17-05-2013</td><td class="der">9:00</td><td>Revisar Agenda</td></tr>
                <tr><td><span class="label label-info">Pendiente</span></td><td><span class="label label-important">Importante</span></td><td>18-05-2013</td><td class="der">16:00</td><td>Ir a Reunion a la Distrital</td></tr>
                <tr><td><span class="label label-info">Pendiente</span></td><td><span class="label label-warning">Bajo</span></td><td>19-05-2013</td><td class="der">15:00</td><td>Revisar Caso Docente </td></tr>
                <tr><td><span class="label label-info">Pendiente</span></td><td><span class="label label-success">Normal</span></td><td>20-05-2013</td><td class="der">10:00</td><td>Revisar Agenda</td></tr>
            </table>
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