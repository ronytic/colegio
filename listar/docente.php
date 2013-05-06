<?php
include_once($folder."login/check.php");
include_once($folder."class/docente.php");
$docente=new docente;
	?>
	<?php include_once($folder."cabecerahtml.php");?>
	<script language="javascript" type="text/javascript" src="<?php echo $folder;?>js/listar/docente.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo $folder;?>js/<?php echo $jsFile;?>"></script>
    <script language="javascript" type="text/javascript">
    	<?php
		if(!empty($archivoInicial) || $archivoInicial!=""){
			?>
			$(document).ready(function(e) {
	            $.post('<?php echo $archivoInicial;?>',{'CodDocente':CodDocente},respuestaInicial);	    
            });
			<?php
		}
		?>
    </script>
	<?php include_once($folder."cabecera.php");?>
		<div class="span3">
			<div class="box">
				<div class="box-header"><h2><i class="icon-user"></i><span class="break"></span><?php echo $idioma['Docente']?></h2></div>
				<div class="box-content">
                <input type="search" id="tdocente" placeholder="<?php echo $idioma['BuscarDocentePor']?>" class="span12"/>
                <select name="docente" id="docente" class="span12">
				<?php
					foreach($docente->listar() as $doc){
						?>
						<option value="<?php echo $doc ['CodDocente'];?>" ><?php echo $doc['Paterno'];?> <?php echo $doc['Materno'];?> <?php echo $doc['Nombres'];?></option>
						<?php	
					}
				?>
				</select>
				</div>
			</div>
		</div>
		<?php if ($uno==1): ?>
		<div class="span9 box">
			<div class="Alumnos">
				<div class="box-header"><h2><i class="icon-cog"></i><span class="break"></span><?php echo $idioma[$subtitulo1];?></h2></div>
				<div class="box-content" id="contenido1">
				</div>
			</div>
		</div>
		<?php else: ?>
		<div class="span3 box">
			<div class="box-header"><h2><i class="icon-cog"></i><span class="break"></span><?php echo $idioma[$subtitulo1];?></h2></div>
			<div class="box-content" id="contenido1">
			</div>
		</div>
		<div class="span6 box">
            <div class="box-header"><h2><i class="icon-cog"></i><span class="break"></span><?php echo $idioma[$subtitulo2];?></h2></div>
            <div class="box-content" id="contenido2">
            </div>
		</div>
		<?php endif ?>
	<?php include_once($folder."pie.php");?>