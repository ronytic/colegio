$(document).ready(function(e) {
	//buscadorLista($("#ttablas"),$("#tablas"));
    $("#generar").click(function(e) {
		var tablas= $("#tablas").val();
	 	var estructura=$("select[name=estructura]").val();
		var vaciar=$("select[name=vaciar]").val();
		var eliminar=$("select[name=eliminar]").val();
		$.post("generarinternet.php",{'Tablas':tablas,'Estructura':estructura,'Vaciar':vaciar,'Eliminar':eliminar},respuestaI);
		$.post("generar.php",{'Tablas':tablas,'Estructura':estructura,'Vaciar':vaciar,'Eliminar':eliminar},respuesta);
    });
	//UrlInternet="http://localhost/";
	//Directory="csb2012";
	var Url=UrlInternet+Directory+"seguridad/actualizar/get.php";
	$("#subir").attr("src",Url);
	$("form[name=fsubir]").attr("action",Url);
	/*$("#subir").click(function(e) {
        var exportar=$("#salida").text();
		for(i=0;i<exportar.length;i++){
			if(exportar[i]=="\n"){
				alert("si");	
			}
		}
		exportar=exportar.replace(/\n/g,"");
		alert($("#salida").val())
		
		var Datos=exportar+"f4=&f=&md=&data=";
		//alert(Datos)
			$.ajax({ 
				data: Datos, 
				type: "GET", 
				dataType: "jsonp", 
				url: Url, 
				success: function(data){ restults(data); } 
			});
    });*/
	function respuesta(data){
		$("#salida").text(data);
	}
	function respuestaI(data){
		$("#data").text(data);
	}
});