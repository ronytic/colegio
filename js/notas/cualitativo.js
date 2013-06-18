var CodCurso;
var CodMateria;
var CodPeriodo;
$(document).ready(function(){
	buscadorLista($("#tcurso"),$("select[name=Curso]"));
	buscadorLista($("#tmateria"),$("select[name=Materia]"));
	buscadorLista($("#tperiodo"),$("select[name=Periodo]"));

	CodCurso=$("select[name=Curso]").val();
	CodMateria=$("select[name=Materia]").val();
	CodPeriodo=$("select[name=Periodo]").val();
	
	
	mostrasNotasCualitativas();
	$('select[name=Curso]').change(function(e){
		CodCurso=$("select[name=Curso]").val();
		mostrasNotasCualitativas();
	});
	$('select[name=Materia]').change(function(e){
		CodMateria=$("select[name=Materia]").val();
		mostrasNotasCualitativas();
	});
	$('select[name=Periodo]').change(function(e){
		CodPeriodo=$("select[name=Periodo]").val();
		mostrasNotasCualitativas();
	});
	$('#notascualitativa').click(function(e) {
        e.preventDefault();
		mostrasNotasCualitativas();
    });
});
function mostrasNotasCualitativas(){
	cargando()
	$.post("listacasilleros.php",{'CodCurso':CodCurso,'CodMateria':CodMateria,'CodPeriodo':CodPeriodo},alumnosnotas);	
}
function cargando(){
	$("#alumnos").html('<img src="'+folder+'imagenes/cargador/cargador.gif"/>');	
}
function alumnosnotas(data){
	$("#casilleros").html(data);
	cortar();
	function cortar(){
		$(".mayusculas").each(function(index, element) {
           var maximo=parseInt($(this).attr("rel"));
		   var contenido=$(this).val();
		   $(this).val(contenido.substr(0,maximo));
			var longitud=parseInt($(this).val().length);
			var nombre=$(this).attr("name");
			var resto=maximo-longitud;
			$("#cantidad"+nombre).html(resto); 
        });
	}
	
	$(".mayusculas").on("keyup paste keypress",function(e) {
		var contenido=$(this).val();
        var longitud=parseInt($(this).val().length);
		var nombre=$(this).attr("name");
		var maximo=parseInt($(this).attr("rel"));
		var resto=maximo-longitud;
		if(resto<=0){
			$(this).attr("maxlength", maximo);
		}
		$(this).val(contenido.substr(0,maximo));
		$("#cantidad"+nombre).html(resto);
    });
	$("#guardarNotasCualitativa").click(function(e) {
        var CodNotasCualitativa=$("#CodNotasCualitativa").val();
		var rango1=$("#rango1").val();
		var rango2=$("#rango2").val();
		var rango3=$("#rango3").val();
		var rango4=$("#rango4").val();
		$.post("guardarnota.php",{'CodNotasCualitativa':CodNotasCualitativa,Rango1:rango1,Rango2:rango2,Rango3:rango3,Rango4:rango4},function(data){alert(data);});
    });
}