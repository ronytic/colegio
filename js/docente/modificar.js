function lanzadorC(CodDocente){
	$.post('formulario.php', {CodDocente: CodDocente}, function(data, textStatus, xhr) {
		$("#contenido1").html(data);
	});
}
