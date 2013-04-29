$(document).ready(function(e) {
    $("#ver").click(function(e) {
        $.post("resumen.php",function(data){
			$("#contenidoreporte").html(data)	
		});
    });
});