$(document).on("ready",function(){
	mostrar();	
	$(document).on("click",".eliminar",function(e){
		e.preventDefault();
		if(confirm(MensajeEliminar)){
			var CodNotificaciones=$(this).attr("rel");
			$.post("eliminar.php",{'CodNotificaciones':CodNotificaciones},function(data){mostrar();});
		}
	});
	$(document).on("click",".modificar",function(e){
		e.preventDefault();
		if(confirm(MensajeModificar)){
			cargandoG("#configuracion");
			var CodNotificaciones=$(this).attr("rel");
			$.post("modificar.php",{'CodNotificaciones':CodNotificaciones},function(data){$(".configuracion").html(data);$("#Usuario").chosen({'width':'100%'})});
		}
	});
	$(document).on("click","#nuevo",function(e){
		e.preventDefault();
		cargandoG("#configuracion");
		var CodNotificaciones=$(this).attr("rel");
		$.post("nuevo.php",{'CodNotificaciones':CodNotificaciones},function(data){$(".configuracion").html(data);$("#Usuario").chosen({'width':'100%'})});
	});
});
function mostrar(){
	cargandoG("#listadocursos");
	$.post("mostrar.php","",function(data){$("#listadocursos").html(data)});	
}