var CodAlumno
var CodCurso
var CodMateria
var Busqueda
$(document).ready(function(){
	buscadorLista($("#tcurso"),$("select[name=Curso]"));
	buscadorLista($("#tmateria"),$("select[name=Materia]"));
	buscadorLista($("#tobservacion"),$("select[name=Observacion]"));
	CodCurso=$("select[name=Curso]").val();
	CodMateria=$("select[name=Materia]").val();
	$("#fecha").datepicker({dateFormat: 'dd-mm-yy',maxDate:"0 D"});
	$.post("listaalumno.php",{'CodCurso':CodCurso,'CodMateria':CodMateria},alumnos);
	$.post("mostrarAgenda.php",{'CodCurso':CodCurso,'CodMateria':CodMateria,'rand':Math.random()},reporteAgenda);
	$('select[name=Curso]').change(function(){
		CodCurso=$(this).val();
		$.post("listaalumno.php",{'CodCurso':CodCurso,'CodMateria':CodMateria},alumnos);
		mostrarAgenda();
	});
	$('select[name=Materia]').change(function(){
		mostrarAgenda();
		CodMateria=$(this).val();
	});
	$('select[name=Alumnos]').change(function(){
		mostrarAgenda();
		CodAlumno=$(this).val();
	});
	$("#Busqueda").change(function(e) {
		mostrarAgenda();
    });
	
	$("#registrar").click(function(e) {
		CodAlumno=$("#alumnos").val();
		Fecha=$("#Fecha").val();
		Detalle=$("#Detalle").val();
		Citacion=($("#Urgente").attr("checked"))?"1":"0";
		CodObservacion=$("select[name=Observacion]").val();
		$.post("registraragenda.php",{'CodCurso':CodCurso,'CodMateria':CodMateria,'CodAlumno':CodAlumno,'CodObservacion':CodObservacion,'Fecha':Fecha,'Detalle':Detalle,'Citacion':Citacion,'rand':Math.random()},function (data){
			$("#respuestaformulario").html(data);
			mostrarAgenda();	
		});
		
    });
		
});
function mostrarAgenda(){
	Busqueda=$("#Busqueda").attr("checked")?true:false;
	CodAlumno=$("#alumnos").val();
	if(Busqueda){
		$.post("mostraragenda.php",{'CodCurso':CodCurso,'CodMateria':CodMateria,'CodAlumno':CodAlumno,'rand':Math.random()},reporteAgenda);
	}else{
		$.post("mostraragenda.php",{'CodCurso':CodCurso,'CodMateria':CodMateria,'rand':Math.random()},reporteAgenda);
	}
}
function alumnos(data){
	$("#alumnos").html(data);
	buscadorLista($("#talumnos"),$("select[name=Alumnos]"));
}

function reporteAgenda(data){
	$("#Agenda").html(data)
}