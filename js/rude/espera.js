$(document).on("ready",function(){
	$("input[name=Fecha]").datepicker({dateFormat:"dd-mm-yy",maxDate:'0D'});
	//actualizar();
});
function actualizar(){
	$("#ver").click();
	//setTimeout(actualizar(),2000);
}