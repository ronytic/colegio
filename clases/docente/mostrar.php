<?php
include_once("../../login/check.php");
if(isset($_POST)){
	$r="../../documentos/clases/";
	$CodCurso=$_POST['CodCurso'];
	$CodMateria=$_POST['CodMateria'];
	$CodDocente=$_SESSION['CodUsuarioLog'];
	include_once("../../class/curso.php");
	include_once("../../class/materias.php");
	include_once("../../class/alumno.php");
	include_once("../../class/clases.php");
	include_once("../../class/clasesarchivos.php");
	$clases=new clases;
	$materas=new materias;
	$curso=new curso;
	$alumno=new alumno;
	$cur=$curso->mostrarCurso($CodCurso);
	$cur=array_shift($cur);
	$mat=$materas->mostrarMateria($CodMateria);
	$mat=array_shift($mat);
	$clasesarchivos=new clasesarchivos;
	$cl=$clases->mostrarClasesMateriaCurso($CodMateria,$CodCurso);
	?>
    <!--<a id="exportarexcel" class="btn btn-success btn-mini"><?php echo $idioma['ExportarExcel']?></a>-->
    <table class="table table-striped table-hover table-bordered">
    	<thead>
        	<tr><th colspan="2"><?php echo $idioma['Curso']?>: <?php echo $cur['Nombre']?></th><th colspan="2"><?php echo $idioma['Materia']?>: <?php echo $mat['Nombre']?></th></tr>
        	<tr><th>N</th><th><?php echo $idioma['Comentario']?></th><th><?php echo $idioma['Archivos']?></th><th></th></tr>
        </thead>
    <?php if(count($cl)){?>
		<?php foreach($cl as $c){$i++;	
            $clasea=$clasesarchivos->mostrarClases($c['CodClases']);
			if($c['CodAlumno']!="0"){
				$al=$alumno->mostrarDatosPersonales($c['CodAlumno']);	
				$al=array_shift($al);
			}
        ?>
            <tr class="<?php echo $c['CodDocente']==$CodDocente?'info':''?>">
                <td><?php echo $i;?></td>
                <td><div class="pequeno">
                    <?php echo $c['Comentario']?>
                    </div>
                </td>
                <td><?php ?>
                <?php foreach($clasea as $ca){?>
                    <a class="btn btn-inverse btn-mini" href="descargar.php?c=<?php echo $ca['CodClasesArchivos']?>"><?php echo ($ca['NombreArchivo'])?></a>
                    <?php	
                }?>
                <hr class="separador">
                    <div class="mostrarHora centrar" title="<?php echo $idioma['FechaRegistro']?>"><?php echo fecha2Str($c['FechaRegistro'])." ".hora2Str($c['HoraRegistro'])?><?php if($c['CodAlumno']!="0"){?> - <?php echo capitalizar($al['Paterno']." ".$al['Materno']." ".$al['Nombres']);}?></div>
                </td>
                <td>
                	<?php if($c['CodDocente']==$CodDocente){?><a class="btn btn-mini eliminar" rel="<?php echo $c['CodClases']?>" title="<?php echo $idioma['Eliminar']?>">x</a><?php }?>
                </td>
            </tr>
        <?php }
		}else{//Si no hay archivos?>
        <tr><td colspan="3"><?php echo $idioma['NoExistenArchivosGuardados']?></td></tr>	
	<?php }
	?>
    </table>
    <?php
}
?>