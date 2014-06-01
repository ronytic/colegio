var CodAlumno;
$(document).on("ready",inicio);
function inicio(){
	
	buscadorLista($("#ialumno"),$("#CodAlumno"),0);
	CodAlumno=$("#CodAlumno").val();
	$("#CodAlumno").change(function(e) {
		CodAlumno=$(this).val();
		
		
        $.post("listadomenu.php",{CodAlumno:CodAlumno},function(data){
			$("#respuesta").html(data)	
		});
    });
	$("#CodAlumno").change();

}
