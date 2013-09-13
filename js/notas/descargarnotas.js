$(document).ready(function(e) {
	$("#respuesta").ajaxStart(function() {
			$("#resultadosubida").html('');
            $("#imagencargador").show("fast");
        });
    $("#subir").click(function(e) {
        $.post("descargar.php",function(data){
			$("#imagencargador").hide("fast");
			if(data==""){
				$("#resultadosubida").html("<h1>"+correcto+"</h1>"+data);
			}else{
				$("#resultadosubida").html("<h1>"+incorrecto+"</h1>"+data);
			}
		});
		e.preventDefault();
		e.stopPropagation();
		return false;
    });
});