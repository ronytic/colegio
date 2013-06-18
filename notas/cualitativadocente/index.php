<?php
include_once("../../login/check.php");
include_once("../../class/config.php");
include_once("../../class/curso.php");
include_once("../../class/docente.php");
include_once("../../class/docentemateriacurso.php");
include_once("../../class/materias.php");
$titulo="NRegistroNotasCualitativas";
$folder="../../";
$docente=new docente;
$curso=new curso;
$docMateriaCurso=new docentemateriacurso;
$materias=new materias;
$config=new config;
$CodDocente=$_SESSION['CodUsuarioLog'];
$_SESSION['CodDocente']=$CodDocente;
$cnf=($config->mostrarConfig("TotalPeriodo"));
$TotalPeriodo=$cnf['Valor'];
$cnf=($config->mostrarConfig("PeriodoActual"));
$PeriodoActual=$cnf['Valor']
?>
<?php include_once($folder."cabecerahtml.php");?>
<script language="javascript" type="text/javascript" src="../../js/notas/cualitativo.js"></script>
<script language="javascript">
$(document).ready(function(e) {

});
</script>
<?php include_once($folder."cabecera.php");?>
<div class="span12 box">
<div class="box-header"><h2><i class="icon-cog"></i><span class="break"></span><?php echo $idioma['Configuracion']?></h2></div>
<div class="box-content">
    <div class="row-fluid">
        <div class="span3">
            <div class="box-header"><?php echo $idioma['Curso']?></div>    
            <div class="box-content">
                <?php campo("tcurso","search","","span12",0,$idioma['BusquePor'])?>
                <select class="span12" name="Curso">
                <?php foreach($docMateriaCurso->mostrarDocenteOrdenCurso($CodDocente) as $cur){
                        $c=$curso->mostrarCurso($cur['CodCurso']);
                        $c=$c=array_shift($c);
                        ?>
                        <option  value="<?php echo $c['CodCurso'];?>"><?php echo $c['Nombre'];?></option>
                <?php }?>
                </select>
            </div>
        </div>
        <div class="span3">
            <div class="box-header"><?php echo $idioma['Materia']?></div>    
            <div class="box-content">
                <?php campo("tmateria","search","","span12",0,$idioma['BusquePor'])?>
                <select name="Materia" class="span12">
                <?php foreach($docMateriaCurso->mostrarDocenteMateria($CodDocente) as $docMat){
                        $m=$materias->mostrarMateria($docMat['CodMateria']);
                        $m=array_shift($m);
                        ?>
                        <option value="<?php echo $m['CodMateria'];?>"><?php echo $m['Nombre'];?></option>
                <?php }?>
                </select>
            </div>
        </div>
        <div class="span2">
            <div class="box-header"><?php echo $idioma['Periodo']?></div>    
            <div class="box-content">
                <?php campo("tperiodo","search","","span12",0,$idioma['BusquePor'])?>
                <select name="Periodo" class="span12">
                <?php
                for($i=1;$i<=$TotalPeriodo;$i++){?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                <?php }?>
                </select>
            </div>
        </div>
        <div class="span4">
        	<div class="box-header"><h2><?php echo $idioma['Acciones']?></h2></div>
            <div class="box-content">
            	<input type="button" class="btn btn-inverse" value="<?php echo $idioma['NotasCualitativas']?>" id="notascualitativa"/>
            </div>
        </div>
	</div>
</div>
</div>
</div><?php // fin row?>
<div class="row-fluid">
<div class="span12">
    <div class="box-header"><?php echo $idioma['Alumnos']?></div>
    <div class="box-content" id="casilleros">
        
    </div>
</div>
<?php
	$cnf=($config->mostrarConfig("CodigoSeguimientoNotasDocente"));
	echo $cnf['Valor'];
?>
<?php include_once($folder."pie.php");?>