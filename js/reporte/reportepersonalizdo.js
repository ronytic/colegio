function lanzadorC(CodCurso){
	//$.post('formulario.php',{"CodCurso":CodCurso},respuesta1);
}
function respuesta1(data){
	$("#configuracion").html(data);
	$("#formulario").submit(function(e) {
        e.preventDefault();
		//Sexo=$("select[name=sexo]").val();
		Campo1=$("select[name=campo1]").val();
		Campo2=$("select[name=campo2]").val();
		Campo3=$("select[name=campo3]").val();
		Borde=$("input[name=borde]").attr("checked");
		Blanco=$("input[name=blanco]").attr("checked");
		Sombreado=$("input[name=sombreado]").attr("checked");
		Cantidad=$("select[name=cantidad]").val();
		$.post("ver.php",{"CodCurso":CodCurso,"Campo1":Campo1,"Campo2":Campo2,"Campo3":Campo3,"Borde":Borde,"Blanco":Blanco,"Cantidad":Cantidad,"Sombreado":Sombreado},function(data){
			$("#respuesta").html(data);
		});
	
    });	
}