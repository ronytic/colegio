<?php
if(!empty($_POST['CodDocente'])){
	include_once("../../class/materias.php");
	include_once("../../class/curso.php");
	include_once("../../class/docentemateriacurso.php");
    include_once("../../class/config.php");
	$CodDocente=$_POST['CodDocente'];
    $config=new configuracion;
    $cnf=array_shift($config->mostrarConfig("TrimestreActual"));
    $trimestre=$cnf['Valor'];
	$materias=new materias;
	$curso=new curso;
	$docentemateriacurso=new docentemateriacurso;
	$docmateriaCurso=array_shift($docentemateriacurso->mostrarDocenteGrupo($CodDocente,"SexoAlumno"));
	?>
    <table class="tabla">
    	<tr class="cabecera"><td>Opción</td><td>Valor</td></tr>
        <tr class="contenido">
            <td>Trimestre Actual:</td>
            <td><?php switch($trimestre){
					case 1:{echo "1º Trimestre";}break;
					case 2:{echo "2º Trimestre";}break;
					case 3:{echo "3º Trimestre";}break;
				}
			
			?></td>
        </tr>
        <tr class="contenido"><td>Curso</td><td><select name="curso">
        					<?php
                            	foreach($docentemateriacurso->mostrarDocenteOrdenCurso($CodDocente) as $docmateriaCurso){
									$cur=array_shift($curso->mostrarCurso($docmateriaCurso['CodCurso']));
									?>
                                    <option value="<?php echo $cur['CodCurso']?>" rel="<?php echo $cur['Dps']?>" data-tope="<?php echo $cur['NotaTope'];?>" data-aprobacion="<?php echo $cur['NotaAprobacion'];?>"><?php echo $cur['Nombre']?></option>
                                    <?php
								}
							?></select></td></tr>
        <tr class="contenido"><td>Materia</td><td><select name="materia">
        					<?php
                            	foreach($docentemateriacurso->mostrarDocenteGrupo($CodDocente,"CodMateria") as $docmateriaCurso){
									$ma=array_shift($materias->mostrarMateria($docmateriaCurso['CodMateria']));
									?>
                                    <option value="<?php echo $ma['CodMateria']?>"><?php echo $ma['Nombre']?></option>
                                    <?php
								}
							?></select>
        </td></tr>
        
        <tr class="contenido"><td>Alumnos</td><td><select name="alumno" disabled="disabled"><option value="2" <?php echo $docmateriaCurso['SexoAlumno']==2?'selected="selected"':'';?>>Ambos Sexos</option><option value="1" <?php echo $docmateriaCurso['SexoAlumno']==1?'selected="selected"':'';?>>Solo Varones</option><option value="0" <?php echo $docmateriaCurso['SexoAlumno']==0?'selected="selected"':'';?>>Solo Mujeres</option></select></td></tr>
        <tr class="contenido"><td>Número de Casillas</td><td><select name="casillas">
        								<?php for($i=3;$i<=15;$i++){?>
                                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
            							<?php }?>
			                   </select>
                            </td></tr>
        <tr class="contenido"><td>Formúla de Calificación</td><td><textarea name="formula" class="nocap" rows="5" readonly="readonly"></textarea><a class="botonSec" id="formula">Promedio por Defecto</a></td></tr>
        <tr class="contenido"><td>Dps</td><td><select name="dps"><option value="0">No</option><option value="1">Si</option></select></td></tr>
        <tr class="contenido"><td>Nota Tope de Casillero</td><td><input type="text" name="tope" class="nocap" value="70"></td></tr>
        <tr class="contenido"><td>Nota Aprobación</td><td><input type="text" name="aprobacion" class="nocap" value="70" readonly="readonly"></td></tr>
        <tr><td></td><td><input type="submit" value="Guardar" class="corner-all guardar"></td></tr>
    </table>
    <?php
}
?>