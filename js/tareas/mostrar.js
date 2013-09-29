function lanzadorC(CodCurso){
	$.post("materias.php",{"CodCurso":CodCurso},function(data){$("select[name=CodMateria]").html(data)});
};
function respuesta1(data){
	$("#configuracion").html(data);

	$("#ver").click(function(e) {
		var CodMateria=$("select[name=CodMateria]").val();
    	$.post("listatareas.php",{'CodCurso':CodCurso,'CodMateria':CodMateria},respuesta2);    
    });
	/*$(document).on("click",".ver",function(e){
		e.preventDefault();
			
	});*/
}
function respuesta2(data){
	$("#respuesta").html(data);
	$(".ver").toggle(function(e){
		e.preventDefault();
		$(this).find('i').removeClass('icon-chevron-down').addClass('icon-chevron-up');
		$(this).parent().parent().next().show();
	},function(e){
		e.preventDefault();
		$(this).find('i').removeClass('icon-chevron-up').addClass('icon-chevron-down');
		$(this).parent().parent().next().hide();
	});
}