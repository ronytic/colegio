$(document).on("ready",function(){
	mostrar();	
	$(document).on("click",".eliminar",function(e){
		e.preventDefault();
		if(confirm(MensajeEliminar)){
			var CodUsuario=$(this).attr("rel");
			$.post("eliminar.php",{'CodUsuario':CodUsuario},function(data){mostrar();});
		}
	});
	$(document).on("click",".modificar",function(e){
		e.preventDefault();
		if(confirm(MensajeModificar)){
			cargandoG("#configuracion");
			var CodUsuario=$(this).attr("rel");
			$.post("modificar.php",{'CodUsuario':CodUsuario},function(data){$(".configuracion").html(data);$("#Usuario")});
		}
	});
	$(document).on("click","#nuevo",function(e){
		e.preventDefault();
		cargandoG("#configuracion");
		var CodUsuario=$(this).attr("rel");
		$.post("nuevo.php",{'CodUsuario':CodUsuario},function(data){$(".configuracion").html(data);$("#Usuario")});
	});
});
function mostrar(){
	cargandoG("#listadocursos");
	$.post("mostrar.php","",function(data){$("#listadocursos").html(data)});	
}