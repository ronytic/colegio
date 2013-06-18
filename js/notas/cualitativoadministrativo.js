$(document).on("ready",function(){
	
	$(document).on("click","#generar",function(){
		if(confirm(SeguroQueDeseaGenerar)){
			var Periodo=$("select[name=Periodo]").val();
			$.post("generar.php",{'Periodo':Periodo},function(data){$("#respuesta").html(data);});
		}
	});
});