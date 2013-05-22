<?php
include_once("../../login/check.php");
include_once("../../class/config.php");
include_once("../../class/curso.php");
include_once("../../class/docente.php");
include_once("../../class/docentemateriacurso.php");
include_once("../../class/casilleros.php");
include_once("../../class/materias.php");
$titulo="Impresión de Registro de Notas";
$folder="../../";
$docente=new docente;
$curso=new curso;
$casilleros=new casilleros;
$docentemateriacurso=new docentemateriacurso;
$materias=new materias;
$config=new config;
$CodDocente=$_SESSION['CodDocente'];
$cnf=($config->mostrarConfig("TotalPeriodo"));
$TotalPeriodo=$cnf["Valor"];
//$cnf=($config->mostrarConfig("TrimestreActual");
//$trimestreActual=$cnf["Valor"];

?>
<?php include_once($folder."cabecerahtml.php");?>
<script language="javascript" type="application/javascript" src="../../js/notas/verregistrodenotas.js"></script>
<script language="javascript">
$(document).ready(function(e) {

});
</script>

<?php include_once($folder."cabecera.php");?>
<div class="span12 box">
	<div class="box-header"><h2><i class="icon-cog"></i><span class="break"></span><?php echo $idioma['Configuracion']?></h2></div>
    <div class="box-content">
        <div class="row-fluid">
            <div class="span4 box">
                <div class="box-header"><h2><?php echo $idioma["Curso"]?></h2></div>    
                <div class="box-content">
                    <select name="Curso" class="span12">
                    <?php foreach($docentemateriacurso->mostrarDocenteOrdenCurso($CodDocente) as $cur){
                        $c=$curso->mostrarCurso($cur['CodCurso']);
                        $c=array_shift($c);
                    ?><option value="<?php echo $c['CodCurso'];?>"><?php echo $c['Nombre'];?></option>
                    <?php }?>
                    </select>
                </div>
            </div>
            <div class="span4 box">
                <div class="box-header"><h2><?php echo $idioma["Materia"]?></h2></div>    
                <div class="box-content">
                <select name="Materia" class="span12">
                    <?php foreach($docentemateriacurso->mostrarDocenteMateria($CodDocente) as $docMat){
                        $m=$materias->mostrarMateria($docMat['CodMateria']);
                        $m=array_shift($m);
                    ?>
                    <option value="<?php echo $m['CodMateria'];?>"><?php echo $m['Nombre'];?></option>
                    <?php }?>
                </select>
                </div>
            </div>
            <div class="span4 box">
                <div class="box-header"><h2><?php echo $idioma["Periodo"]?></h2></div>
                <div class="box-content">
                    <select name="Periodo" class="span12">
                    <?php for($i=1;$i<=$TotalPeriodo;$i++){?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php }?>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="span12 box">
    	<div class="box-header">Reporte para impresión</div>
        El reporte de impresión esta en formato PDF,<span class="resaltar">HAGA CLICK DERECHO SOBRE EL INFORME y SELECCIONE IMPRIMIR, el Reporte esta en tamaño CARTA</span> 
        <div class="box-content" id="alumnos">
        	
        </div>
    </div>
    
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-31441392-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<?php include_once($folder."pie.php");?>

