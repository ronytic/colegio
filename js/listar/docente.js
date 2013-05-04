var CodDocente;
$(document).on("ready",inicio);
function inicio(){
	buscadorLista($("#tdocente"),$('select[name=docente]'))
	var doc=$('select[name=docente]');
	CodDocente=doc.val();
	
	$('select[name=docente]').change(function(){
			CodDocente=$(this).val();
			lanzadorC(CodDocente);
	});
	lanzadorC(CodDocente);
}