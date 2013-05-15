$(document).on("ready",inicio);
function inicio(){
	//buscadorLista($("#buscar"),$("#listado"));
	$("#reporte").click(function(e) {
        $.post("reporte.php",{"listado":$("#listado").val()},function(data){$("#respuesta").html(data)});
    });	
	$("#reporteimpresion").click(function(e) {
        $.post("reporteimpresion.php",{"listado":$("#listado").val()},function(data){$("#respuesta").html(data)});
    });	
}