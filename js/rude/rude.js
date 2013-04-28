var file="registroRude.php";
var fileP="../../";
function respuesta(data){
	$("#respuesta").html(data);
	$("#fechaNac").datepicker({changeMonth: true,changeYear: true,yearRange:"c-100:c+10"});
	/*$("input").focus(function(e) {
        $(this).select().mouseup(function (e) {
	        e.preventDefault();
    	    $(this).unbind("mouseup");
   		 });
    });*/
}