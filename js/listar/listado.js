var CodCurso;
var CodAlumno;
$(document).on("ready",inicio);
function inicio(){
	buscadorLista($("#icurso"),$("#selectcurso"),0);
//	buscadorLista($("#ialumno"),$("#selectalumno"));
	
		
	$("#selectcurso").change(function(e) {
		var valor=$(this).val();
        CodCurso=valor;
		$.post(folder+"listar/alumnos.php",{"CodCurso":CodCurso},alumnos);
    });
	var valor=$("#selectcurso").val();
	CodCurso=valor;
	if(CodAlumno!=""){
		$.post(folder+"listar/alumnos.php",{"CodCurso":CodCurso,"CodAlumno":CodAlumno},alumnos);		
	}else{
		$.post(folder+"listar/alumnos.php",{"CodCurso":CodCurso},alumnos);	
	}
	
	$("#selectalumno").on("change",function(){
		var valor=$(this).val();
        CodAlumno=valor;
		if(file!="#"){
			$.post(file,{'CodAlumno':CodAlumno,'CodCurso':CodCurso},respuesta);
		}else{
			lanzador(CodAlumno);	
		}
	});
}
function alumnos(data){
	$("#selectalumno").html(data)//.trigger("liszt:updated");
	buscadorLista($("#ialumno"),$("#selectalumno"));
	var valor=$("#selectalumno:first").val();
    CodAlumno=valor;
	if(file!="#"){
		$.post(file,{'CodAlumno':CodAlumno,'CodCurso':CodCurso},respuesta);
	}
}