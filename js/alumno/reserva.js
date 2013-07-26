file="formulario.php";
fileP="../../";
$(document).ready(function(e) {
    $("#respuesta").on("click","#guardar",function(e){
		var montoreserva=$("#montoreserva").val();
		e.preventDefault();
		$.post("guardar.php",{"MontoReserva":montoreserva,"CodAlumno":CodAlumno},function(){mostrar();});
	});
	$(document).on("click",".eliminar",function(e){
		e.preventDefault();
		if(confirm(mensajeg['EliminarRegistro'])){
			var CodReserva=$(this).attr("rel");
			$.post("eliminar.php",{"CodReserva":CodReserva},function(data){mostrar();});
		}
	});
});
function mostrar(){
		$.post("mostrar.php",{"CodAlumno":CodAlumno},function(data){$("#listado").html(data)})	
		
	}
function respuesta(data){
	$("#respuesta").html(data);
	mostrar();
}