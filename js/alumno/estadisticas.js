file="estadisticas.php";
function respuesta(data){
	$("#respuesta").html(data);
	/*$('#cantidades').dataTable({
			"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
			"sLengthMenu": "_MENU_ records per page"
			}
		} );
	*/
	//$("table").dataTable();
	$(".vermasnuevo").toggle(function(e) {
		var CodCurso=$(this).attr("rel");
        $(this).find("i").removeClass("icon-chevron-down").addClass("icon-chevron-up");
		$.post("alumnosnuevos.php",{"CodCurso":CodCurso},function(data){
			$("#alumnosnuevos").html(data);
			$(".alumnosnuevos").slideDown();
		})
    },function(e) {
        $(this).find("i").removeClass("icon-chevron-up").addClass("icon-chevron-down");
		$(".alumnosnuevos").slideUp();
		$("#alumnosnuevos").html("");
			
    });
}
