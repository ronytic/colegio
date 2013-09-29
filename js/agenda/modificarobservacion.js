$(document).on("ready",function(){
	mostrar();	
	$(document).on("click",".eliminar",function(e){
		e.preventDefault();
		if(confirm(MensajeEliminar)){
			var CodObservacion=$(this).attr("rel");
			$.post("eliminar.php",{'CodObservacion':CodObservacion},function(data){mostrar();});
		}
	});
	$(document).on("click",".modificar",function(e){
		e.preventDefault();
		if(confirm(MensajeModificar)){
			cargandoG("#configuracion");
			var CodObservacion=$(this).attr("rel");
			$.post("modificar.php",{'CodObservacion':CodObservacion},function(data){$(".configuracion").html(data);$("#Usuario")});
		}
	});
	$(document).on("click","#nuevo",function(e){
		e.preventDefault();
		cargandoG("#configuracion");
		var CodObservacion=$(this).attr("rel");
		$.post("nuevo.php",{'CodObservacion':CodObservacion},function(data){$(".configuracion").html(data);$("#Usuario")});
	});
});
function mostrar(){
	cargandoG("#listadocursos");
	$.post("mostrar.php","",function(data){$("#listadocursos").html(data)});	
}