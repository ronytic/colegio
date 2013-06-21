function lanzadorC(CodCurso){
	$.post("mostrar.php",{"CodCurso":CodCurso},respuesta2);
}
function respuesta1(data){
	$("#configuracion").html(data);
	buscadorLista($(),$("select[name=materias]"));
	$("#guardar").click(function(e) {
        var CodMateria=$("select[name=materias]").val()
		$.post("guardar.php",{'CodCurso':CodCurso,'CodMateria':CodMateria},guardar);
    });
}
function guardar(data){
	if(data!=""){
		alert(data);
	}else{
		$.post("mostrar.php",{"CodCurso":CodCurso},respuesta2);	
	}
}
function respuesta2(data){
	$("#respuesta").html(data);
	$(".opcion").change(function(e) {
		var Cod=$(this).attr("rel");
		var Val=$(this).val();
        $.post("cambiarnombre.php",{'Cod':Cod,'Val':Val});
    });
	$(".eliminar").click(function(e) {
        var Cod=$(this).attr("rel");
		if(confirm("¿Desea eliminar esta materia?")){
			$.post("eliminar.php",{'Cod':Cod},eliminar);
		}else
		e.preventDefault();
    });
}
function eliminar(data){
	$.post("mostrar.php",{"CodCurso":CodCurso},respuesta2);
}