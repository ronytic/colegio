<?php include_once($folder."login/check.php");?>
<?php
include_once(RAIZ."class/curso.php");
$curso=new curso;

include_once($folder."cabecerahtml.php");?>
<script language="javascript" src="<?php echo $folder?>js/listar/curso.js"></script>
<script language="javascript" src="<?php echo $folder?>js/<?php echo $jsFile?>"></script>
<script language="javascript" type="text/javascript">
/*		$(document).ready(function(e) {
            $().datepicker();
        });*/
    	<?php
		if($archivoInicial!="" || !empty($archivoInicial)){
			?>
			$(document).on("ready",function(e) {
	            $.post('<?php echo $archivoInicial;?>',{'CodCurso':CodCurso},respuesta1);	    
            });
			<?php
		}
		?>
    </script>
<?php include_once($folder."cabecera.php");?>
<div class="span3">
	<div class="box">
        <div class="box-header"><h2><?php echo $idioma['Curso']?></h2></div>
        <div class="box-content">
        	<!--<input type="search" id="tcurso" class="span12" placeholder="<?php echo $idioma['BuscarCursoPor']?>"/>-->
            <select class="span12" id="selectcurso" data-placeholder="<?php echo $idioma['BuscarCursoPor']?>">
            <?php
			$i=0;
            foreach($curso->mostrar() as $cu){$i++;
                ?><option value="<?php echo $cu['CodCurso'];?>" <?php echo $i==1?'selected="selected"':'';?> rel="<?php echo $cu['caArea']?>"><?php echo $cu['Nombre'];?></option><?php
            }
            ?>
            </select>
        </div>
    </div>
    <div class="box">
        <div class="box-header"><h2><?php if($icono1!=""){?><i class="<?php echo $icono1;?>"></i><span class="break"></span><?php }?> <?php echo $idioma[$subtitulo1];?></h2></div>
        <div class="box-content" id="configuracion">
            
        </div>
    </div>
</div>
<div class="span9">
	<div class="box">
    	<div class="box-header"><h2><?php if($icono2!=""){?><i class="<?php echo $icono2;?>"></i><span class="break"></span><?php }?> <?php echo $idioma[$subtitulo2];?></h2></div>
        <div class="box-content" id="respuesta"></div>
    </div>
</div>
<?php include_once($folder."pie.php");?>