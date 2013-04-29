function lanzadorC(CodCurso){
	$.post('formulario.php',{"CodCurso":CodCurso},respuesta1);
}
function respuesta1(data){
	var Sexo;
	$("#configuracion").html(data);
	$("#formulario").submit(function(e) {
        e.preventDefault();
		Sexo=$("select[name=sexo]").val();
		
		$.post("ver.php",{'CodCurso':CodCurso,"Sexo":Sexo},function(data){
			$("#respuesta").html(data);	
		});
		
		
    });	
}