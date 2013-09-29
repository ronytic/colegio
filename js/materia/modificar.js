$(document).on("ready",function(){
	mostrar();	
	$(document).on("click",".eliminar",function(e){
		e.preventDefault();
		if(confirm(MensajeEliminar)){
			var CodMateria=$(this).attr("rel");
			$.post("eliminar.php",{'CodMateria':CodMateria},function(data){mostrar();});
		}
	});
	$(document).on("click",".modificar",function(e){
		e.preventDefault();
		if(confirm(MensajeModificar)){
			cargandoG("#configuracion");
			var CodMateria=$(this).attr("rel");
			$.post("modificar.php",{'CodMateria':CodMateria},function(data){$(".configuracion").html(data);$("#Usuario")});
		}
	});
	$(document).on("click","#nuevo",function(e){
		e.preventDefault();
		cargandoG("#configuracion");
		var CodMateria=$(this).attr("rel");
		$.post("nuevo.php",{'CodMateria':CodMateria},function(data){$(".configuracion").html(data);$("#Usuario")});
	});
});
function mostrar(){
	cargandoG("#listadocursos");
	$.post("mostrar.php","",function(data){$("#listadocursos").html(data)});	
}