var CodCurso;
var CodMateria;
var CodPeriodo;
$(document).ready(function(){
	buscadorLista($("#tCurso"),$("select[name=Curso]"));
	buscadorLista($("#tMateria"),$("select[name=Materia]"));
	buscadorLista($("#tPeriodo"),$("select[name=Periodo]"));
	
	CodCurso=$("select[name=Curso]").val();
	CodMateria=$("select[name=Materia]").val();
	CodPeriodo=$("select[name=Periodo]").val();
	
	
	mostrarCambioNombres()
	$('select[name=Curso]').change(function(e){
		CodCurso=$(this).val();
		mostrarCambioNombres()
	});
	$('select[name=Materia]').change(function(e){
		CodMateria=$(this).val();
		mostrarCambioNombres()
	});
	$('select[name=Periodo]').change(function(e){
		CodPeriodo=$(this).val();
		mostrarCambioNombres()
	});
});
function mostrarCambioNombres(){
	cargando()
	$.post("listanombres.php",{'CodCurso':CodCurso,'CodMateria':CodMateria,'CodPeriodo':CodPeriodo},alumnosnotas);	
}
function cargando(){
	$("#alumnos").html('<img src="'+folder+'imagenes/cargador/cargador.gif"/>');	
}
function alumnosnotas(data){
	$("#alumnos").html(data)
	//$("html,body").animate({scrollTop:$("#alumnos").position().top-40},750);
	$(".nombre").change(function(e) {
        var valor=$(this).val();
		var nombre=$(this).attr("name");
		var CodCasilleros=$("input[name=CodCasilleros]").val();
		$.post("guardarnombre.php",{'CodCasilleros':CodCasilleros,'Nombre':nombre,'Valor':valor})
    });
	$("#guardarNombre").click(function(e) {
       alert(NombresGuardadoCorrectamente); 
    });
}