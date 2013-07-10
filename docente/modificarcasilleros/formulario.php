<?php
include_once("../../login/check.php");
if(!empty($_POST['Cod'])){
	include_once("../../class/materias.php");
	include_once("../../class/curso.php");
	include_once("../../class/docente.php");
	include_once("../../class/docentemateriacurso.php");
	include_once("../../class/config.php");
	include_once("../../class/casilleros.php");
	$Cod=$_POST['Cod'];
    $config=new config;
    $cnf=($config->mostrarConfig("PeriodoActual"));
    $PeriodoActual=$cnf['Valor'];
	$materias=new materias;
	$curso=new curso;
	$casilleros=new casilleros;
	$docente=new docente;
	$docentemateriacurso=new docentemateriacurso;
	$cas=$casilleros->mostrar($Cod);
	$cas=array_shift($cas);
	$docmateriacurso=($docentemateriacurso->mostrarCodDocenteMateriaCurso($cas['CodDocenteMateriaCurso']));
	$docmateriacurso=array_shift($docmateriacurso);
	$mat=$materias->mostrarMateria($docmateriacurso['CodMateria']);
	$mat=array_shift($mat);
	$cur=$curso->mostrarCurso($docmateriacurso['CodCurso']);
	$cur=array_shift($cur);
	$doc=$docente->mostrarDocente($docmateriacurso['CodDocente']);
	$doc=array_shift($doc);
	?>
    <div id="respuestaformulario"></div>
    <table class="table table-bordered table-hover">
    <thead>
    	<tr><th><?php echo $idioma['Docente']?></th><th><?php echo $idioma['Curso']?></th><th><?php echo $idioma['Materia']?></th><th><?php echo $idioma['Periodo']?></th></tr>
        <tr><th><?php echo capitalizar($doc['Paterno'])?> <?php echo capitalizar($doc['Materno'])?> <?php echo capitalizar($doc['Nombres'])?></th><th><?php echo $cur['Nombre']?></th><th><?php echo $mat['Nombre']?></th><th><?php echo $cas['Trimestre']?></th></tr>
    </thead>
    </table>
    <table class="table table-bordered oculto">
        <tr>
            <td><?php echo $idioma['PeriodoActual']?>:<br />
            	<select name="Periodo" class="span12">
            	<?php for($i=1;$i<=4;$i++){?>
					<option value="<?php echo $i;?>" <?php echo ($i==$PeriodoActual)?'selected="selected"':'';?>>
						<?php echo $i;?>
                        <?php switch($i){
							case 1:{echo $idioma["Bimestre"]." - ".$idioma["Trimestre"];}break;
							case 2:{echo $idioma["Bimestre"]." - ".$idioma["Trimestre"];}break;
							case 3:{echo $idioma["Bimestre"]." - ".$idioma["Trimestre"];}break;
							case 4:{echo $idioma["Bimestre"];}break;
						}?>
					</option>
                <?php }?>
                </select>
			</td>
        </tr>
        <tr>
        	<td><?php echo $idioma['Curso']?>:<br />
			<select name="curso" class="span12">
				<option value="<?php echo $cur['CodCurso']?>" data-dps="<?php echo $cur['Dps']?>" data-tope="<?php echo $cur['NotaTope'];?>" data-aprobacion="<?php echo $cur['NotaAprobacion'];?>" data-bimestre="<?php echo $cur['Bimestre'];?>"><?php echo $cur['Nombre']?></option>
			</select>
            </td>
		</tr>
        <tr>
        	<td><?php echo $idioma['Materia']?>:<br />
            <select name="materia" class="span12">
				<option value="<?php echo $mat['CodMateria']?>"><?php echo $mat['Nombre']?></option>
			</select>
        	</td>
		</tr>
        <tr>
        	<td><?php echo $idioma['Alumnos']?>:<br />
            <select name="alumno" disabled="disabled" class="span12">
            	<option value="2" <?php echo $docmateriaCurso['SexoAlumno']==2?'selected="selected"':'';?>><?php echo $idioma['AmbosSexos']?></option>
                <option value="1" <?php echo $docmateriaCurso['SexoAlumno']==1?'selected="selected"':'';?>><?php echo $idioma['SoloVarones']?></option>
                <option value="0" <?php echo $docmateriaCurso['SexoAlumno']==0?'selected="selected"':'';?>><?php echo $idioma['SoloMujeres']?></option>
			</select>
            </td>
		</tr>
        
        <tr>
        	<td><?php echo $idioma['Dps']?>:<br />
            <select name="dps" class="span12">
            	<option value="0" <?php echo $cur['Dps']==0?'selected':''?>><?php echo $idioma['No']?></option>
                <option value="1" <?php echo $cur['Dps']==1?'selected':''?>><?php echo $idioma['Si']?></option>
			</select>
           	</td>
		</tr>
        <tr>
        	<td><?php echo $idioma['NotaTopeCasilleros']?>:<br />
            	<input type="text" name="tope" class="nocap span12" value="70" maxlength="3" size="3">
            </td>
		</tr>
        <tr>
        	<td><?php echo $idioma['NotaAprobacion']?>:<br />
            	<input type="text" name="aprobacion" class="nocap span12" value="70" readonly maxlength="3" size="3">
            </td>
		</tr>
    </table>
    <form class="formulario" method="post" action="modificar.php">
    <?php if($cur['Bimestre']){?><input name="casillas" value="4" type="hidden"><?php }?>
    <input type="hidden" name="CodCasilleros"  value="<?php echo $Cod?>">
    <table class="table table-bordered">
    	<tr>
        	<td><?php echo $idioma['NumeroCasillas']?>:<br />
            <select name="casillas" class="span12">
				<?php for($i=3;$i<=15;$i++){?>
                <option value="<?php echo $i;?>" <?php echo $i==$cas['Casilleros']?'selected':''?>><?php echo $i;?></option>
                <?php }?>
            </select>
			</td>
        </tr>
        <tr>
        	<td><?php echo $idioma['FormulaCalificacion']?><br />
            <textarea name="formula" class="nocap span12" rows="4" readonly><?php echo $cas['FormulaCalificaciones']?></textarea>
            <a class="btn btn-mini" id="formula"><?php echo $idioma['PromedioPorDefecto']?></a>
            </td>
		</tr>
    </table>
    
    <table class="table table-bordered table-hover table-striped">
    <thead>
	<tr><th>N</th><th><?php echo $idioma['NotaTope']?></th><th><?php echo $idioma['NombreCasillero']?></th></tr>
    </thead>
    
    <?php for($i=1;$i<=15;$i++){?>
        <tr class="filanota <?php echo $i>$cas['Casilleros']?'oculto':''?>" rel="<?php echo $i?>">
        	<td><?php echo $i ?></td>
    		<td><input type="text" class="span12" name="limite[]" value="<?php echo $cas['LimiteCasilla'.$i];?>"></td>
            <td><input type="text" class="span12" name="nombre[]" value="<?php echo $cas['NombreCasilla'.$i];?>"></td>
		</tr>
        <?php
	}?>
    
    </table>
    <input type="submit" value="<?php echo $idioma['Modificar']?>" class="btn btn-success guardar">
    </form>
    <?php
}
?>
<script language="javascript" type="text/javascript">
var GuardarConfiguracionCasilleros="<?php echo $idioma['GuardarConfiguracionCasilleros']?>";
var NoSePodraModificar="<?php echo $idioma['NoSePodraModificar']?>";
</script>