function lanzadorC(CodCurso){
	
}
$(document).on("ready",function(){
    $.post('formulario.php',{"CodCurso":CodCurso},respuesta1);
    $("#FechaFalta").datepicker({maxDate:"0 D",changeMonth: true,changeYear: true,dateFormat: 'dd-mm-yy'});
});
function respuesta1(data){
    
    //$("#FechaFalta").datepicker({maxDate:"0 D",changeMonth: true,changeYear: true,dateFormat: 'dd-mm-yy'});
    
	$("#configuracion").html(data);
	$("#revisar").click(function(e) {
        e.preventDefault();
		FechaFalta=$("#FechaFalta").val();
		$.post("ver.php",{'CodCurso':CodCurso,"FechaFalta":FechaFalta},function(data){
			$("#respuesta").html(data);	
            
		});
    });	
    $(document).on("submit",".formulariofaltas",function(e){
        if(!confirm(SeguroRegistrarFaltas)){
            e.preventDefault();
            return false;
        }    
    })
}