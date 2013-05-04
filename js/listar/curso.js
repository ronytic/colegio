var CodCurso;
$(document).on("ready",inicio);
function inicio(){
	buscadorLista($("#tcurso"),$("#selectcurso"));
	//$("#selectcurso").chosen();
	CodCurso=$("#selectcurso").val();
	$("#selectcurso").change(function(e) {
		var valor=$(this).val();
        CodCurso=valor;
		lanzadorC(CodCurso);
    });
	lanzadorC(CodCurso);
}