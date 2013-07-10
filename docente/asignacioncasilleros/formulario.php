<?php
include_once("../../login/check.php");
if(!empty($_POST['CodDocente'])){
	include_once("../../class/materias.php");
	include_once("../../class/curso.php");
	include_once("../../class/docentemateriacurso.php");
	include_once("../../class/config.php");
	$CodDocente=$_POST['CodDocente'];
    $config=new config;
    $cnf=($config->mostrarConfig("PeriodoActual"));
    $PeriodoActual=$cnf['Valor'];
	$materias=new materias;
	$curso=new curso;
	$docentemateriacurso=new docentemateriacurso;
	$docmateriaCurso=$docentemateriacurso->mostrarTodoDocente($CodDocente);
	//print_r($docmateriaCurso);
	?>
  
        
<!--    <select class="span12">-->
    <table class="table table-bordered">
        <thead>
            <tr>
            	<th></th><th><span title="<?php echo $idioma['Curso']?>"><?php echo ($idioma['Curso'])?></span></th>
                <th><span title="<?php echo $idioma['Materia']?>"><?php echo recortarTexto($idioma['Materia'],3,"")?></span></th><th><?php echo $idioma['Dps']?></th></tr>
        </thead>
    <?php
	foreach($docmateriaCurso as $dmc){
		$cur=$curso->mostrarCurso($dmc['CodCurso']);
		$cur=array_shift($cur);
		$ma=($materias->mostrarMateria($dmc['CodMateria']));
		$ma=array_shift($ma);
		?>
        <tr>
        <td>
        <input type="radio" name="CodDocenteMateriaCurso" value="<?php echo $dmc['CodDocenteMateriaCurso']?>">
        </td>
        <td><?php echo $cur['Abreviado']?></td>
        <td><?php echo $ma['Abreviado']?></td>
        <td><?php echo $cur['Dps']?$idioma['Si']:$idioma['No']?></td>
        </tr>
        <?php
	}
	?>
    <tr><td></td></tr>
    </table>
   <!-- </select>-->
    <table class="table table-bordered table-hover">
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
            <?php foreach($docentemateriacurso->mostrarDocenteOrdenCurso($CodDocente) as $docmateriaCurso){
                    $cur=$curso->mostrarCurso($docmateriaCurso['CodCurso']);
					$cur=array_shift($cur);
                    ?>
                    <option value="<?php echo $cur['CodCurso']?>" data-dps="<?php echo $cur['Dps']?>" data-tope="<?php echo $cur['NotaTope'];?>" data-aprobacion="<?php echo $cur['NotaAprobacion'];?>" data-bimestre="<?php echo $cur['Bimestre'];?>"><?php echo $cur['Nombre']?></option>
                    <?php
                }
            ?></select>
            </td>
		</tr>
        <tr>
        	<td><?php echo $idioma['Materia']?>:<br />
            <select name="materia" class="span12">
            <?php foreach($docentemateriacurso->mostrarDocenteGrupo($CodDocente,"CodMateria") as $docmateriaCurso){
                    $ma=array_shift($materias->mostrarMateria($docmateriaCurso['CodMateria']));
                    ?>
                    <option value="<?php echo $ma['CodMateria']?>"><?php echo $ma['Nombre']?></option>
                    <?php
                }
            ?></select>
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
        	<td><?php echo $idioma['NumeroCasillas']?>:<br />
            <select name="casillas" class="span12">
				<?php for($i=3;$i<=15;$i++){?>
                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                <?php }?>
            </select>
			</td>
        </tr>
        <tr>
        	<td><?php echo $idioma['FormulaCalificacion']?><br />
            <textarea name="formula" class="nocap span12" rows="4" readonly></textarea>
            <a class="btn btn-mini" id="formula"><?php echo $idioma['PromedioPorDefecto']?></a>
            </td>
		</tr>
        <tr>
        	<td><?php echo $idioma['Dps']?>:<br />
            <select name="dps" class="span12">
            	<option value="0"><?php echo $idioma['No']?></option>
                <option value="1"><?php echo $idioma['Si']?></option>
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
    <input type="submit" value="<?php echo $idioma['Guardar']?>" class="btn btn-success guardar">
    <?php
}
?>
<script language="javascript" type="text/javascript">
var GuardarConfiguracionCasilleros="<?php echo $idioma['GuardarConfiguracionCasilleros']?>";
var NoSePodraModificar="<?php echo $idioma['NoSePodraModificar']?>";
</script>