var file="formulario.php";

function respuesta(data){
	$("#respuesta").html(data);
	
	$(".completar").click(function(e) {
		e.preventDefault();
        var valor=$(this).attr("rel");
		$("textarea[name=Mensaje]").html(valor);
    });	

}
