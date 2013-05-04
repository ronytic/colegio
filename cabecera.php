</head>

<body>
		<!-- inicio: Cabecera -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="<?php echo $url.$directory?>"> <img alt="<?php echo $Titulo?>" src="<?php echo $folder;?>imagenes/logos/<?php echo $LogoInicio;?>" width="50" height="50" style="width:50" class="logo"/> <span><?php echo $Titulo?></span></a>
								
				<!-- Inicio: Cabecera de Menu -->
				<div class="btn-group pull-right" >
					<a class="btn" href="#">
						<i class="icon-warning-sign"></i><span class="hidden-phone hidden-tablet"> <?php echo $idioma['Notificacion']?></span> <span class="label label-important hidden-phone">0</span> <span class="label label-success hidden-phone">0</span>
					</a>
					<a class="btn" href="#">
						<i class="icon-tasks"></i><span class="hidden-phone hidden-tablet"> <?php echo $idioma['Agenda']?></span> <span class="label label-warning hidden-phone">0</span>
					</a>
					<a class="btn" href="#">
						<i class="icon-envelope"></i><span class="hidden-phone hidden-tablet"> <?php echo $idioma['Mensajes']?></span> <span class="label label-success hidden-phone">0</span>
					</a>
                    
					<!-- Inicio: Menu de usuario -->
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#" title=" <?php echo $usu['Nick'];?>">
						<i class="icon-user"></i><span class="hidden-phone hidden-tablet"> <?php echo $usu['Nombres'];?></span>
						<span class="caret"></span>
					</a>
                    
					<ul class="dropdown-menu">
                    	<li><a><?php echo $usu['Nick'];?></a></li>
						<li><a href="<?php echo $folder;?>usuario/configuracion.php"><?php echo $idioma['Configuracion']?></a></li>
						<li class="divider"></li>
						<li><a href="<?php echo $folder;?>login/logout.php"><?php echo $idioma['Salir']?></a></li>
					</ul>
                    
					<!-- Fin: Menu Deslisable -->
				</div>
				<!-- Fin: Cabecera de Menu -->
				
			</div>
		</div>
	</div>
	<div id="under-header"></div>
	<!-- start: Header -->
	
		<div class="container-fluid">
		<div class="row-fluid">
				
			<!-- Inicio: Menu Principal -->
			<div class="span2 main-menu-span">
				<div class="nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked">
						<li class="nav-header hidden-tablet"><?php echo $idioma['Menu']?></li>
                        <li><a href="<?php echo $folder;?>index.php"><i class="icon-home"></i><span> <?php echo $idioma['Inicio']?></span></a>
                        </li>
                        <?php
                        	foreach($menu->mostrar($Nivel) as $m){
								?>
                                <li class="funo <?php if ($rmenu==$m['Url']){ echo'active';}?>">
                                	<a href="#" ><i class="<?php echo $m['Imagen'];?> "></i><span class=""> <?php echo $m['Nombre'];?></span></a>
            					<?php 
								$subm=$submenu->mostrar($Nivel,$m['CodMenu']);
								if(count($subm)){
									?>
										<ul class="oculto submenu">
									<?php
									foreach($subm as $sm){
										?>
                                        <li class="<?php echo $rsubmenu==$sm['Url']?'selecciona':'';?>"> <a href="<?php echo $folder;?><?php echo $m['Url'];?><?php echo $sm['Url'];?>"><i class="icon-chevron-right"></i><span><?php echo $sm['Nombre'];?></span></a></li>
                                        <?php		
									}
									?>
                                    </ul>
                                    <?php
								}
								?>                    
                        </li>
                                <?php
								
							}
						?>

					</ul>
				</div><!--/.well -->
			</div><!--/span-->
			<!-- Fin: Menu Principal-->
            
<div id="content" class="span10">
	<div>
		<ul class="breadcrumb">
            <li>
                <a href="<?php echo $folder;?>"><?php echo $idioma['Inicio']?></a> <span class="divider">/</span>
            </li>
            <?php /*?>
            <li>
                <a href="#">Dashboard</a> <span class="divider">/</span>
            </li>
			<?php */?>
			<?php echo $idioma[$titulo];?>
		</ul>
	</div>
<div class="sortable row-fluid">