$(document).ready(function(){
	buscadorLista($("#tcurso"),$("select[name=Curso]"));
	buscadorLista($("#tmateria"),$("select[name=Materia]"));
	var CodCurso=$("select[name=Curso]").val();
	var CodMateria=$("select[name=Materia]").val();
	$('select[name=Curso]').change(function(){
			CodCurso=$(this).val();
			mostrar()
	});
	$('select[name=Materia]').change(function(){
			CodMateria=$(this).val();
			mostrar()
	});
	$("#FechaTarea").datepicker({dateFormat: 'dd-mm-yy'});
	$("#guardar").click(function(e) {
        var NombreTarea=$("#NombreTarea").val();
		var DescripcionTarea=$("#DescripcionTarea").val();
		var FechaTarea=$("#FechaTarea").val();
		
		if(NombreTarea!=""){
			if(DescripcionTarea!=""){
				if(FechaTarea!=""){
					$.post("guardartarea.php",{'CodCurso':CodCurso,'CodMateria':CodMateria,'Nombre':NombreTarea,'Descripcion':DescripcionTarea,'FechaTarea':FechaTarea},function(){$.post("mostrarTarea.php",{'CodCurso':CodCurso,'CodMateria':CodMateria},tarea);});
				}
				else{alert(CompleteFechaPresentacion);$("#FechaTarea").focus()}
			}else{alert(CompleteDescripcionTarea);$("#DescripcionTarea").focus()}
		}else{alert(CompleteNombreTarea);$("#NombreTarea").focus()}
		
    });
	mostrar();
	function mostrar(){
		$.post("mostrartarea.php",{'CodCurso':CodCurso,'CodMateria':CodMateria},tarea);
	}
	$(document).on("click",".eliminar",function(){
		CodTarea=$(this).attr("rel");
		if(confirm(mensajeg['EliminarRegistro'])){
			$.post("eliminartarea.php",{"CodTarea":CodTarea},function(){
				mostrar();	
			});
		}
	})
});
function tarea(data){
	$("#tareaGuardada").html(data);
}