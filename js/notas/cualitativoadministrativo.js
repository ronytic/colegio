$(document).on("ready",function(){
	
	$(document).on("click","#generar",function(e){
		e.preventDefault();
		if(confirm(SeguroQueDeseaGenerar)){
			var Periodo=$("select[name=Periodo]").val();
			$.post("generar.php",{'Periodo':Periodo},function(data){$("#respuesta").html(data);});
		}
	});
	$(document).on("click","#generarreemplazar",function(e){
		e.preventDefault();
		if(confirm(SeguroQueDeseaGenerar)){
			var Periodo=$(this).attr('rel');
			$.post("reemplazargenerar.php",{'Periodo':Periodo},function(data){$("#respuesta").html(data);});
		}
	});
});