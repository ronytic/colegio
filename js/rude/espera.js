$(document).on("ready",function(){
	$("input[name=Fecha]").datepicker({dateFormat:"dd-mm-yy",maxDate:'0D'});
	
	$("#ver").click(actualizar);
	$("#ver").click();
});
$(document).ready(function(e) {

    $("form.formulario").submit();
});
function actualizar(){
var Fecha=$("input[name=Fecha]").val();
var Estado=$("select[name=Estado]").val();
	$.post("ver.php",{"Fecha":Fecha,"Estado":Estado},function(data){
		$("#respuestaformulario").html(data)
	});
//setTimeout("actualizar()",20000);
}