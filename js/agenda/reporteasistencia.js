function lanzadorC(){
	
}
function respuesta1(data){
	$("#configuracion").html(data);
	$(document).on("click","#verreporte",function(){
		$.post("vergeneralimprimir.php",{'CodCurso':CodCurso},function(data){$("#respuesta").html(data)})
	});
}