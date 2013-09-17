function lanzadorC(CodCurso){
	//$.post("materias.php",{"CodCurso":CodCurso},function(data){$("select[name=CodMateria]").html(data)});
};
function respuesta1(data){
	$("#configuracion").html(data);
	
	$("#ver").click(function(e) {
		var NumeroCuotas=$("select[name=NumeroCuotas]").val();
    	$.post("listaalumnos.php",{'CodCurso':CodCurso,'NumeroCuotas':NumeroCuotas},respuesta2);    
    });
	/*$(document).on("click",".ver",function(e){
		e.preventDefault();
			
	});*/
}
function respuesta2(data){
	$("#respuesta").html(data);
}