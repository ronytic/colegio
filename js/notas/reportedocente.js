var CodCurso;
var CodMateria;
var CodPeriodo;
$(document).on("ready",function(){
	buscadorLista($("#tCurso"),$("select[name=Curso]"));
	buscadorLista($("#tMateria"),$("select[name=Materia]"));
	buscadorLista($("#tPeriodo"),$("select[name=Periodo]"));
	
	CodCurso=$("select[name=Curso]").val();
	CodMateria=$("select[name=Materia]").val();
	CodPeriodo=$("select[name=Periodo]").val();

	mostrarAlumnosImprimir()
	$('select[name=Curso]').change(function(e){
		CodCurso=$(this).val();
		mostrarAlumnosImprimir()
	});
	$('select[name=Materia]').change(function(e){
		CodMateria=$(this).val();
		mostrarAlumnosImprimir()
	});
	$('select[name=Periodo]').change(function(e){
		CodPeriodo=$(this).val();
		mostrarAlumnosImprimir()
	});
	

});
function mostrarAlumnosImprimir(){
	cargando()
	$.post("listaalumno.php",{'CodCurso':CodCurso,'CodMateria':CodMateria,'CodPeriodo':CodPeriodo},alumnosnotas);	
}
function cargando(){
	$("#alumnos").html('<img src="'+folder+'imagenes/cargador/cargador.gif"/>');	
}
function alumnosnotas(data){
	$("#alumnos").html(data)
	$("html,body").animate({scrollTop:$("#alumnos").position().top-40},750);
}