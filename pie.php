    </div><?php //Fin Cuerpo Fluido?>
</div><?php //Fin Content?>
</div> <?php //Fin container-fluid?>
<div class="clearfix"></div>
<hr>
		
		<footer>
			<p class="pull-left"><?php echo $idioma['TituloSistema']?> - <?php echo $Sigla;?> &copy; <?php echo $idioma['DerechosReservados']?> 2011 - <?php echo date("Y");?></p>
			<p class="pull-right"><?php echo $idioma['DesarrolladoPor'];?>: <a href="http://fb.com/ronaldnina" class="enlacepie" target="_blank" title="">Ronald Nina Layme</a> </p>
		</footer>
				
	</div><!-- .fluid-container-->
<div id="noticerrar" class="oculto"><div class="pull-right"><a href="#" title="<?php echo $idioma['Cerrar']?>" class="btn btn-mini" id="cerrarnoti"><i class="icon-remove"></i></a></div></div>
<div id="cuerponotificacion" class="oculto">
<?php
$notitotal=count($noti1)+count($noti2)+count($noti3);
if($notitotal){
	?><ul class="unstyled listanotificacion"><?php
	foreach($noti1 as $no1){
		?><li class="pequeno"><span class="label label-important"><i class="icon-bullhorn"></i></span> <?php echo $no1['Mensaje']?></li><?php
	}
	foreach($noti2 as $no2){
		?><li class="pequeno"><span class="label label-warning"><i class="icon-bell"></i></span> <?php echo $no2['Mensaje']?></li><?php
	}
	?><?php
	foreach($noti3 as $no3){
		?><li class="pequeno"><span class="label label-success"><i class="icon-bell"></i></span> <?php echo $no3['Mensaje']?></li><?php
	}
	?></ul><?php
}else{
	echo $idioma['NoExitenNotificaciones'];
}
?>
</div>
<?php /* 	<!-- Inicio: JavaScript-->

		
		<!--<script src="js/jquery-ui-1.8.21.custom.min.js"></script>-->
		
	
		<!--<script src="js/jquery.cookie.js"></script>
	
		<script src='js/fullcalendar.min.js'></script>
	
		<script src='js/jquery.dataTables.min.js'></script>

		<script src="js/excanvas.js"></script>
	<script src="js/jquery.flot.min.js"></script>
	<script src="js/jquery.flot.pie.min.js"></script>
	<script src="js/jquery.flot.stack.js"></script>
	<script src="js/jquery.flot.resize.min.js"></script>-->
	
		
        <!--<script src="<?php echo $folder;?>js/jquery.dataTables.min.js"></script>
	
		<script src="js/jquery.uniform.min.js"></script>
		
		<script src="js/jquery.cleditor.min.js"></script>
	
		<script src="js/jquery.noty.js"></script>
	
		<script src="js/jquery.elfinder.min.js"></script>
	
		<script src="js/jquery.raty.min.js"></script>
	
		<script src="js/jquery.iphone.toggle.js"></script>
	
		<script src="js/jquery.uploadify-3.1.min.js"></script>
	
		<script src="js/jquery.gritter.min.js"></script>
	
		<script src="js/jquery.imagesloaded.js"></script>
	
		<script src="js/jquery.masonry.min.js"></script>
	
		<script src="js/custom.js"></script>-->

		<script type="text/javascript" language="JavaScript">
/*	
	function message_welcome1(){
		var unique_id = $.gritter.add({
			// (string | mandatory) the heading of the notification
			title: 'Welcome on Optimus Dashboard',
			// (string | mandatory) the text inside the notification
			text: 'I hope you like this template',
			// (string | optional) the image to display on the left
			image: 'img/avatar.jpg',
			// (bool | optional) if you want it to fade out on its own or just sit there
			sticky: false,
			// (int | optional) the time you want it to be alive for before fading out
			time: '',
			// (string | optional) the class name you want to apply to that specific message
			class_name: 'my-sticky-class'
		});
	}
	
	function message_welcome2(){
		var unique_id = $.gritter.add({
			// (string | mandatory) the heading of the notification
			title: 'Optimus is Amazing Theme',
			// (string | mandatory) the text inside the notification
			text: 'Optimus works on all devices, computers, tablets and smartphones. Optimus has lots of great features. Try It!',
			// (string | optional) the image to display on the left
			image: 'img/avatar.jpg',
			// (bool | optional) if you want it to fade out on its own or just sit there
			sticky: false,
			// (int | optional) the time you want it to be alive for before fading out
			time: '',
			// (string | optional) the class name you want to apply to that specific message
			class_name: 'my-sticky-class'
		});
	}
	
	function message_welcome3(){
		var unique_id = $.gritter.add({
			// (string | mandatory) the heading of the notification
			title: 'Buy Optimus!',
			// (string | mandatory) the text inside the notification
			text: 'This great template can be yours today.',
			// (string | optional) the image to display on the left
			image: 'img/avatar.jpg',
			// (bool | optional) if you want it to fade out on its own or just sit there
			sticky: false,
			// (int | optional) the time you want it to be alive for before fading out
			time: '',
			// (string | optional) the class name you want to apply to that specific message
			class_name: 'gritter-light'
		});
	}
	
	$(document).ready(function(){
		
		setTimeout("message_welcome1()",5000);
		setTimeout("message_welcome2()",10000);	
		setTimeout("message_welcome3()",15000);
		setInterval(f_visits, 100);
		setInterval(f_members, 2000);
		setInterval(f_income, 5000);
		setInterval(f_sales, 5000);
		setInterval(live_notifications_center, 5000);
		
	});		

	</script>
	*/?>
<script language="javascript">
	var folder="<?php echo $folder?>";
	var mensajeg=Array();
	mensajeg['EliminarRegistro']="<?php echo $idioma['EliminarRegistro']?>";
	var DispositivoMovil=0;
	
	<?php /*/*$(document).on("ready",function(){
		//alert(screen.width+"W - "+$(document).width()+" V");	
		//maximizar()
		var offset = (navigator.userAgent.indexOf("Mac") != -1 ||
		navigator.userAgent.indexOf("Gecko") != -1 ||
		navigator.appName.indexOf("Netscape") != -1) ? 0 : 4;
		window.moveTo(-offset, -offset);
		window.resizeTo(screen.availWidth + (2 * offset),
		screen.availHeight + (2 * offset));
	});
	
	function maximizar(){
	//window.moveTo(0,0);
	window.resizeTo(screen.width,screen.height);
	}*/ ?>
	$(document).on("ready",function(){
		if($(document).width()>750){
			//alert($(document).width());
			$('.btn-navbar').click();
		}
	});
</script>
<script src="<?php echo $folder;?>js/core/framework/bootstrap.js" language="javascript"></script>
<script src="<?php echo $folder;?>js/core/plugins/jquery.listado.js" language="javascript"></script>
<script src="<?php echo $folder;?>js/core/ui/jquery.ui.core.js" language="javascript"></script>
<script src="<?php echo $folder;?>js/core/ui/jquery.ui.datepicker.js" language="javascript"></script>		
<script src="<?php echo $folder;?>js/core/plugins/jquery.form.js" language="javascript"></script>
<script src="<?php echo $folder;?>js/core/plugins/jquery.stickytableheaders.min.js" language="javascript"></script>	

<script src="<?php echo $folder;?>js/core/cargadortotal.js?<?php echo rand()?>" language="javascript"></script>
<script src="<?php echo $folder;?>js/core/cargadortotalfinal.js" language="javascript"></script>
<?php /*<!-- Fin: JavaScript-->
<!--<iframe id="respuestaexcel"></iframe>-->*/?>
</body>
</html>