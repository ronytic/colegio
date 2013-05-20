$(document).ready(function(e) {
	$("#formrevisar").submit(function(e) {
		var Codigo=$("#Codigo").val();
		$.post("revisarCodigo.php",{'Codigo':Codigo},respuesta,"json");
    	e.preventDefault()
	});    
});
function respuesta(data){
	if(data.Msg=='OK'){
		location.href="../total/agenda.php?CodAl="+data.CodAlumno;	
	}else{
		alert(data.Error);
		$("#Codigo").val("").focus();
	}
}

