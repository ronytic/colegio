<?php
include_once("../../login/check.php");
include_once("../../class/config.php");
include_once("../../class/alumno.php");
include_once("../../class/docentemateriacurso.php");
include_once("../../class/notascualitativa.php");
include_once("../../class/curso.php");
if(!empty($_POST)){
	$CodCurso=$_POST['CodCurso'];
	$CodMateria=$_POST['CodMateria'];
	$CodDocente=$_SESSION['CodDocente'];
	$CodPeriodo=$_POST['CodPeriodo'];
	$alumnos=new alumno;
	$docentemateriacurso=new docentemateriacurso;
	$notascualitativa=new notascualitativa;
	$config=new config;
	$curso=new curso;
	$cur=array_shift($curso->mostrarCurso($CodCurso));
	$notascuali=array_shift($notascualitativa->mostrarDocenteMateriaCursoTrimestre($CodDocente,$CodMateria,$CodCurso,$CodPeriodo));
	$CodNotasCualitativa=$notascuali['CodNotasCualitativa'];
	
	$cantidadmaxima=65;
	$cnf=array_shift($config->mostrarConfig("RegistroNotaHabilitado"));
	$registronotashabilitado=$cnf["Valor"];
	?>
    <div class="cuerpo"><?php echo $idioma["Curso"]?>: <span class="resaltar"><?php echo $cur['Nombre']?> </span> | <?php echo $cur['Bimestre']?$idioma['Bimestre']:$idioma['Trimestre']?>: <span class="resaltar"><?php echo $CodPeriodo?></span>
    </div>
    <?php if(empty($CodNotasCualitativa)){echo $idioma['NoSeEncontroMateria'];exit;}?>
    <input type="hidden" name="CodNotasCualitativa" value="<?php echo $CodNotasCualitativa;?>" id="CodNotasCualitativa"/>
	<table class="table table-bordered table-hover">
    	<thead>
		<tr>
			<th><?php echo $idioma["PrimerRango"]?></th>
			<th><?php echo $idioma["SegundoRango"]?></th>
			<th><?php echo $idioma["TercerRango"]?></th>
			<th><?php echo $idioma["CuartoRango"]?></th>
		</tr>
        </thead>
		<tr>
			<td class="centrar">
            	<span class="resaltar"><?php echo $idioma["NotaDe"]?> 1-35</span>
                <hr />
				<textarea name="rango1" id="rango1" cols="20" rows="5" class="mayusculas" rel="<?php echo $cantidadmaxima?>" autofocus="autofocus" maxlength=="<?php echo $cantidadmaxima?>"><?php echo $notascuali['PrimerRango'];?></textarea>
				<hr>
				<span class="resaltar"><?php echo $idioma['CantidadLetras']?></span>
				<span id="cantidadrango1"><?php echo $cantidadmaxima?></span>
			</td>
			<td class="centrar">
            	<span class="resaltar"><?php echo $idioma["NotaDe"]?> 36-49</span>
                <hr />
				<textarea name="rango2" id="rango2" cols="20" rows="5" class="mayusculas" rel="<?php echo $cantidadmaxima?>" maxlength=="<?php echo $cantidadmaxima?>"><?php echo $notascuali['SegundoRango'];?></textarea>
				<hr>
				<span class="resaltar"><?php echo $idioma['CantidadLetras']?></span>
				<span id="cantidadrango2"><?php echo $cantidadmaxima?></span>
			</td>
			<td class="centrar">
            	<span class="resaltar"><?php echo $idioma["NotaDe"]?> 50-60</span>
                <hr />
				<textarea name="rango3" id="rango3" cols="20" rows="5" class="mayusculas" rel="<?php echo $cantidadmaxima?>" maxlength=="<?php echo $cantidadmaxima?>"><?php echo $notascuali['TercerRango'];?></textarea>
				<hr>
				<span class="resaltar"><?php echo $idioma['CantidadLetras']?></span>
				<span id="cantidadrango3"><?php echo $cantidadmaxima?></span>
			</td>
			<td class="centrar">
	            <span class="resaltar"><?php echo $idioma["NotaDe"]?> 61-70</span>
                <hr />
				<textarea name="rango4" id="rango4" cols="20" rows="5" class="mayusculas" rel="<?php echo $cantidadmaxima?>" maxlength=="<?php echo $cantidadmaxima?>"><?php echo $notascuali['CuartoRango'];?></textarea>
				<hr>
				<span class="resaltar"><?php echo $idioma['CantidadLetras']?></span>
				<span id="cantidadrango4"><?php echo $cantidadmaxima?></span>
			</td>
		</tr>
	</table>
	<input type="button" value="<?php echo $idioma["GuardarNota"]?>" class="btn btn-success" id="guardarNotasCualitativa"/>
	<?php
}
?>