<?php
switch($Nivel){
	case 3:{include_once("class/docente.php");
			$docente1=new docente;
			$datosUsuario=$docente1->mostrarDocente($CodUsuario);
			$datosUsuario=array_shift($datosUsuario);
			$Apodo=$idioma["Docente"];	
			$ApellidoPSis=$datosUsuario['Paterno'];
			$ApellidoMSis=$datosUsuario['Materno'];
			$NombresSis=$datosUsuario['Nombres'];
	}break;
	case 6:{include_once("class/alumno.php");
			$alumnosis=new alumno;
			$datosUsuario=$alumnosis->mostrarDatosPersonales($CodUsuario);
			$datosUsuario=array_shift($datosUsuario);
			$Apodo=$idioma['PadreFamilia'];
			$ApellidoPSis=$datosUsuario['Paterno'];
			$ApellidoMSis=$datosUsuario['Materno'];
			$NombresSis=$datosUsuario['Nombres'];
	}break;
	case 7:{include_once("class/alumno.php");
			$alumnosis=new alumno;
			$datosUsuario=$alumnosis->mostrarDatosPersonales($CodUsuario);
			$datosUsuario=array_shift($datosUsuario);
			$Apodo=$idioma['Alumno'];
			$ApellidoPSis=$datosUsuario['Paterno'];
			$ApellidoMSis=$datosUsuario['Materno'];
			$NombresSis=$datosUsuario['Nombres'];
	}break;
	default:{
		//Usuario: 1,2,4,5
		$datosUsuario=$usuario->mostrarDatos($CodUsuario);
		$datosUsuario=array_shift($datosUsuario);
		$Apodo=$datosUsuario['Nick'];
		$ApellidoPSis=$datosUsuario['Paterno'];
		$ApellidoMSis=$datosUsuario['Materno'];
		$NombresSis=$datosUsuario['Nombres'];
	}break;
}?>
</head>

<body>
	<div id="contenedorcargando"><img src="<?php echo $folder?>imagenes/cargador/cargador.gif"></div>
		<!-- inicio: Cabecera -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="<?php echo $folder?>"> <img alt="<?php echo $Titulo?>" src="<?php echo $folder;?>imagenes/logos/<?php echo $LogoInicio;?>" width="50" height="50" style="width:50" class="logo"/> <span><?php echo $Titulo?></span></a>
								
				<!-- Inicio: Cabecera de Menu -->
				<div class="btn-group pull-right" >
					<a class="btn" href="#" id="noti" data-titulo="<?php echo $idioma['Notificacion']?>">
						<i class="icon-bell"></i><span class="hidden-phone hidden-tablet"> <?php echo $idioma['Notificacion']?></span> <span class="label label-important hidden-phone"><?php echo count($noti1)?></span> <span class="label label-success hidden-phone"><?php echo count($noti3)?></span>
					</a>
					
                    <?php foreach($menu->mostrar($Nivel,"Superior") as $m){?>
                    <a class="btn" href="<?php echo $folder?><?php echo $m['Url']?>">
						<i class="<?php echo $m['Imagen']?>"></i><span class="hidden-phone hidden-tablet"> <?php echo $idioma[$m['Nombre']]?></span> <span class="label label-<?php echo $m['Nombre']=='MisActividades'?"warning":"success";?> hidden-phone"><?php if($m['Nombre']=="MisActividades"){echo $cantagendaactividades['Cantidad'];}else{ echo "0";}?></span>
					</a>
                    <?php }?>
                    
					<!-- Inicio: Menu de usuario -->
					<a class="btn" data-toggle="dropdown" href="#" title=" <?php echo $Apodo;?>">
						<i class="icon-user"></i><span class="hidden-phone hidden-tablet"> <?php echo acortarPalabra(capitalizar($NombresSis));?></span>
						<span class="caret"></span>
					</a>
                    
					<ul class="dropdown-menu">
                    	<li class="disabled"><a><?php echo $Apodo;?></a></li>
						<?php if($_SESSION['Nivel']==1 || $_SESSION['Nivel']==2 || $_SESSION['Nivel']==4 || $_SESSION['Nivel']==5):?>
                        <li><a href="<?php echo $folder;?>usuario/configuracion/"><?php echo $idioma['Configuracion']?></a></li>
						<li class="divider"></li>
                        <li><a href="<?php echo $folder;?>../csb2012/"><?php echo $idioma['Sistema']?> 2012</a></li>
                        <?php endif;?>
                        <li class="divider"></li>
						<li><a href="<?php echo $folder;?>login/logout.php"><?php echo $idioma['SalirSistema']?></a></li>
					</ul>
                    <a class="btn" href="<?php echo $folder;?>login/logout.php" title="<?php echo $idioma['SalirSistema'];?>"><i class="icon-off"></i></a>
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
                        	foreach($menu->mostrar($Nivel,"Lateral") as $m){
								?>
                                <li class="funo <?php if ($rmenu==$m['Url']){ echo'active';}?>">
                                	<a href="#" ><i class="<?php echo $m['Imagen'];?> "></i><span class=""> <?php echo $idioma[$m['Nombre']];?></span></a>
            					<?php 
								$subm=$submenu->mostrar($Nivel,$m['CodMenu']);
								if(count($subm)){
									?>
										<ul class="oculto submenu">
									<?php
									foreach($subm as $sm){
										$UrlInternet="";
										if($sm['Internet']=="1" && $Internet==0){
											$UrlInternet="redirigir.php";	
										}
										?>
                                        <li class="<?php echo $rsubmenu==$sm['Url']?'selecciona':'';?>"> <a href="<?php echo $folder;?><?php echo $m['Url'];?><?php echo $sm['Url'];?><?php echo $UrlInternet?>"><i class="icon-chevron-right"></i><span><?php echo $idioma[$sm['Nombre']];?></span></a></li>
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