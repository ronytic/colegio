var CodCurso;
$(document).on("ready",inicio);
function inicio(){
	CodCurso=$("#selectcurso").val();
	$("#selectcurso").chosen();
	$("#selectcurso").change(function(e) {
		var valor=$(this).val();
        CodCurso=valor;
		lanzadorC(CodCurso);
    });
	lanzadorC(CodCurso);
}