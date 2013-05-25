$(document).ready(function(e) {
	$("#respuesta").ajaxStart(function() {
			$("#resultadosubida").html('');
            $("#imagencargador").show("fast");
        });
    $("#subir").click(function(e) {
        $.post("subir.php",function(data){
			$("#imagencargador").hide("fast");
			if(data==""){
				$("#resultadosubida").html("<h1>"+correcto+"</h1>");
			}else{
				$("#resultadosubida").html("<h1>ERROR, INTENTELO NUEVAMENTE</h1>");
			}
		});
		e.preventDefault();
		e.stopPropagation();
		return false;
    });
});