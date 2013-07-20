var file="formularioAsignacion.php";
var fileP="../../";
function respuesta(data){
	$("#respuesta").html(data);
	$("#formuCodigo").submit(function(e) {
		e.preventDefault();
        var Codigo=$("input[name=Codigo]").val();
		$.post("guardarCodigo.php",{'CodAlumno':CodAlumno,'CodBarra':Codigo},respuesta);
		
    });
}