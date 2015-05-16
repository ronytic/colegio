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
		if(confirm(DeseaEliminarMateria)){
			$.post("eliminar.php",{'Cod':Cod},eliminar);
		}else
		e.preventDefault();
    });
    $(".combinada").change(function(e) {
        var Cod=$(this).data("rel");
        var Val=$(this).val();
        //alert(Cod+" "+Val);
        $.post("cambiarcombinada.php",{'Cod':Cod,'Val':Val});
    });
}
function eliminar(data){
	$.post("mostrar.php",{"CodCurso":CodCurso},respuesta2);
}