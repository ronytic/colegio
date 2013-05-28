function lanzadorC(CodDocente){
	
}
function respuestaInicial(data){
	$("#contenido1").html(data);
	$(document).on("click","#vernotas",function(){
		location.href="docente.php?CodDocente="+CodDocente+"&lock=dce7c4174ce9323904a934a486c41288";
	}).on("click","#modificarnotas",function(){
		location.href="../modificarnotasadministrativo/docente.php?CodDocente="+CodDocente+"&lock=dce7c4174ce9323904a934a486c41288";
	});
}

