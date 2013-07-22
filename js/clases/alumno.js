$(document).on("ready",function(){
	buscadorLista($(),$("select[name=CodCurso]"))
	buscadorLista($(),$("select[name=CodMateria]"))
	actualizar(event);
	$("select[name=CodMateria]").change(actualizar);
	$("select[name=CodCurso]").change(actualizar);
	$("#files").change(cambioArchivo);
	$(document).on('submit','form#formulario', function(e) {
		e.preventDefault(); // prevent native submit
		var percent=$("#respuesta");
    	$(this).ajaxSubmit({
        	target: '#respuesta',
			beforeSend: function() {
				//status.empty();
				var percentVal = '0%';
				//bar.width(percentVal)
				percent.html(percentVal+'<div class="progress"><div class="bar" style="width: '+percentVal+';"></div></div>');
			},
			uploadProgress: function(event, position, total, percentComplete) {
				var percentVal = percentComplete + '%';
				//bar.width(percentVal)
				percent.html(percentVal+'<div class="progress"><div class="bar" style="width: '+percentVal+';"></div></div>');
			},
			complete: function(xhr) {
				$("#actualizar").click();
				//$("form#formulario").reset();
				$("#files").val('');
				$("textarea[name=comentario]").val('');
				$('#list').html('');
				$("#respuesta").html(xhr.responseText);
			}
    	});
	});
	$("#actualizar").click(actualizar);
	$(document).on("click",".eliminar",function(e){
		e.preventDefault();
		if(confirm(mensajeg['EliminarRegistro'])){
			var c=$(this).attr("rel");
			$.post("eliminar.php",{"Cod":c},function(){actualizar(event);});
		}
	});
});
function actualizar(e){
	cargandoG("#mostrar");
	e.preventDefault();
	var CodCurso=$("select[name=CodCurso]").val();
	var CodMateria=$("select[name=CodMateria]").val();
	$.post("mostrar.php",{'CodCurso':CodCurso,'CodMateria':CodMateria},function(data){
		$("#mostrar").html(data);	
		$(".mostrarHora").tooltip({'placement':'bottom'});
	});
}
function cambioArchivo(evt) {
	$('#list').html('');
	var files = evt.target.files; 

	var output = [];
	for (var i = 0, f; f = files[i]; i++) {
		//alert(f.type);
		if (f.type.match('word*')) {
			icono(f,"word.png")	
		}else if (f.type.match('excel*')) {
			icono(f,"excel.png")	
		}else if (f.type.match('presentation*')) {
			icono(f,"powerpoint.png")	
		}else if (f.type.match('access*')) {
			icono(f,"access.png")	
		}else if (f.type.match('pdf*')) {
			icono(f,"pdf.jpg")	
		}else if (f.type.match('audio*')) {
			icono(f,"audio.jpg")	
		}else if (f.type.match('video*')) {
			icono(f,"video.jpg")	
		}else if (tipoArchivo(f.name)=="rar") {
			icono(f,"winrar.jpg")	
		}else if (tipoArchivo(f.name)=="psd") {
			icono(f,"photoshop.png")	
		}else if (tipoArchivo(f.name)=="txt") {
			icono(f,"documento.jpg")	
		}else if (tipoArchivo(f.name)=="fla") {
			icono(f,"flash.png")	
		}else if (!f.type.match('image.*')) {
			icono(f,"archivo.png")
		}else{

			var reader = new FileReader();
			// Cuando sea imagen
			reader.onload = (function(theFile) {
				return function(e) {
					var div = $('<div/>').addClass('enlinea');
					var contenido=['<img  class="thumb" src="', e.target.result,
					'" title="', (theFile.name), '"/><br><span title="'+PesoArchivo+'" class="t">',peso(theFile.size),'</span><br><span title="'+FechaModificacion+'" class="t">',theFile.lastModifiedDate.toLocaleDateString(),'</span>'].join('');
					div.html(contenido);
					$('#list').append(div);
					$("span[title],img[title]").tooltip();
				};
			})(f);
			reader.readAsDataURL(f);
		}
	}
	$("span[title],img[title]").tooltip();
}
function tipoArchivo(nombre){
	var n=nombre.split('.');
	return n.pop();
}
function icono(f,nombre){
if(nombre==""){"documento.png"}
var div = $('<div/>').addClass('enlinea');
var contenido=['<img  class="thumb" src="'+folder+'imagenes/iconos/'+nombre+'" title="', (f.name), '"/><br><span title="'+PesoArchivo+'" class="t">',peso(f.size),'</span><br><span title="'+FechaModificacion+'" class="t">',f.lastModifiedDate.toLocaleDateString(),'</span>'].join('');
div.html(contenido);
$('#list').append(div);	
}

function peso(peso){
	var kb=peso/1000;
	kb=kb.toFixed(2);
	var mb=kb/1000;
	mb=mb.toFixed(2);
	if(mb=="0.00"){
		return kb+"KB";
	}else{
		return mb+"MB";
	}
}