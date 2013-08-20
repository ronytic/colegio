$(document).on("ready",function(){
	mostrar();	
	$(document).on("click",".eliminar",function(e){
		e.preventDefault();
		if(confirm(MensajeEliminar+"\n"+NotaEliminar)){
			var CodCurso=$(this).attr("rel");
			$.post("eliminar.php",{'CodCurso':CodCurso},function(data){mostrar();});
		}
	});
	$(document).on("click",".modificar",function(e){
		e.preventDefault();
		if(confirm(MensajeModificar+"\n"+NotaModificar)){
			cargandoG("#configuracion");
			var CodCurso=$(this).attr("rel");
			$.post("modificar.php",{'CodCurso':CodCurso},function(data){$(".configuracion").html(data)});
		}
	});
	$(document).on("click","#nuevo",function(e){
		e.preventDefault();
		cargandoG("#configuracion");
		var CodCurso=$(this).attr("rel");
		$.post("nuevo.php",{'CodCurso':CodCurso},function(data){$(".configuracion").html(data)});
	});
});
function mostrar(){
	cargandoG("#listadocursos");
	$.post("mostrar.php","",function(data){$("#listadocursos").html(data)});	
}