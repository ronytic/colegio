$(document).on("ready",function(){
	mostrar();	
	$(document).on("click",".eliminar",function(e){
		e.preventDefault();
		if(confirm(MensajeEliminar)){
			var CodObservacionesFrecuentes=$(this).attr("rel");
			$.post("eliminar.php",{'CodObservacionesFrecuentes':CodObservacionesFrecuentes},function(data){mostrar();});
		}
	});
	$(document).on("click",".modificar",function(e){
		e.preventDefault();
		if(confirm(MensajeModificar)){
			cargandoG("#configuracion");
			var CodObservacionesFrecuentes=$(this).attr("rel");
			$.post("modificar.php",{'CodObservacionesFrecuentes':CodObservacionesFrecuentes},function(data){$(".configuracion").html(data);});
		}
	});
	$(document).on("click","#nuevo",function(e){
		e.preventDefault();
		cargandoG("#configuracion");
		var CodObservacionesFrecuentes=$(this).attr("rel");
		$.post("nuevo.php",{'CodObservacionesFrecuentes':CodObservacionesFrecuentes},function(data){$(".configuracion").html(data);});
	});
});
function mostrar(){
	cargandoG("#listadocursos");
	$.post("mostrar.php","",function(data){$("#listadocursos").html(data)});	
}