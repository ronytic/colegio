var CodCurso;
var CodAlumno;
$(document).on("ready",inicio);
function inicio(){
	buscadorLista($("#icurso"),$("#selectcurso"),0,"cuadro");
//	buscadorLista($("#ialumno"),$("#selectalumno"));
	
	$("#selectcurso").change(function(e) {
		var valor=$(this).val();
        CodCurso=valor;
		cargandoG("#cargandoralumnos");
		$.post(folder+"listar/alumnostmp.php",{"CodCurso":CodCurso},alumnos);
    });
	var valor=$("#selectcurso").val();
	CodCurso=valor;
	
	if(CodAlumno!=""){
		$.post(folder+"listar/alumnostmp.php",{"CodCurso":CodCurso,"CodAlumno":CodAlumno},alumnos);		
	}else{
		$.post(folder+"listar/alumnostmp.php",{"CodCurso":CodCurso},alumnos);	
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
	$("#cargandoralumnos").html('');
	//$("html,body").animate({scrollTop:150},750);
	buscadorLista($("#ialumno"),$("#selectalumno"));
	$("#ialumno").change();
	var valor=$("#selectalumno:first").val();
    CodAlumno=valor;
	if(file!="#"){
		$.post(file,{'CodAlumno':CodAlumno,'CodCurso':CodCurso},respuesta);
	}
}