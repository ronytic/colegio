$(document).on("ready",function(){
	$("#files").change(cambioArchivo);
});
function cambioArchivo(evt) {
	$('#list').html('');
	var files = evt.target.files; 

	var output = [];
	for (var i = 0, f; f = files[i]; i++) {
		if (!f.type.match('image.*')) {
			var div = $('<div/>').addClass('enlinea');
			var contenido=['<img  class="thumb" src="'+folder+'imagenes/iconos/documento.png" title="', escape(f.name), '"/><br><span title="Peso del Archivo">',peso(f.size),'</span><br><span title="Fecha de Modificación">',f.lastModifiedDate.toLocaleDateString(),'</span>'].join('');
			div.html(contenido);
			$('#list').append(div);
		}else{

			var reader = new FileReader();
	
			// Cuando sea imagen
			reader.onload = (function(theFile) {
				return function(e) {
					// Render thumbnail.
					var div = $('<div/>').addClass('enlinea');
					var contenido=['<img  class="thumb" src="', e.target.result,
					'" title="', escape(theFile.name), '"/><br><span title="Peso del Archivo">',peso(theFile.size),'</span><br><span title="Fecha de Modificación">',theFile.lastModifiedDate.toLocaleDateString(),'</span>'].join('');
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