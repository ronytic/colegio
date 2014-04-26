<?php
include_once("../../login/check.php");
include_once("../../class/asesor.php");
include_once("../../class/curso.php");


$asesor=new asesor;
$curso=new curso;

$CodDocente=$_SESSION['CodUsuarioLog'];
$ase=$asesor->mostrarTodoRegistro("CodDocente=".$CodDocente);

include_once("../../class/config.php");
$config=new config;
$TotalPeriodo=($config->mostrarConfig("TotalPeriodo",1));

$folder="../../";
$titulo="NAsesor";
include_once("../../cabecerahtml.php");
?>
<script language="javascript" type="text/javascript" src="../../js/docente/asesor.js"></script>
<?php include_once("../../cabecera.php");?>
<div class="span3">
	<div class="box-header"><h2><?php echo $idioma['Informacion'] ?></h2></div>
    <div class="box-content">
    <?php if (count($ase)){
		?>
        <form class="formulario" action="verreporte.php" method="post">
        	<table class="table table-bordered">
            <tr>
            	<td>
					<?php echo $idioma['Curso'] ?>:
                    <select name="CodCurso" class="span12" id="CodCurso">
                    <?php foreach($ase as $a){
                    $cur=$curso->mostrarCurso($a['CodCurso']);
                    $cur=array_shift($cur);
                    ?>
                    <option value="<?php echo $a['CodCurso']?>"><?php echo $cur['Nombre']?></option>
                    <?php }?>
                    </select>
				</td>
            </tr>
        	<tr>
            	<td>
                <?php echo $idioma['TipoReporte'] ?>:
                <select name="TipoReporte" id="TipoReporte">
                    <option value="CentralizadorNotas"><?php echo $idioma['CentralizadorNotas'] ?></option>
                    <option value="Agenda"><?php echo $idioma['ReporteEstadisticoAgenda'] ?></option>
                </select>
                </td>
            </tr>
            <tr>
            	<td>
                <?php echo $idioma['Periodo'] ?>:
                <select name="Periodo" id="Periodo">
					<?php for($i=1;$i<=$TotalPeriodo;$i++){?>
                    <option <?php echo $i==$tipo?'selected="selected"':'';?> value="<?php echo $i;?>"  ><?php echo $i;?></option>
                    <?php }?>
                </select>
                </td>
            </tr>
          	<tr>
            	<td>
                <input type="submit" value="<?php echo $idioma['VerReporte']?>" class="btn btn-success">
                </td>
            </tr>
            
           
            </table>
        </form>
        <?php
	}else{
		?>
        <div class="alert alert-error"><?php echo $idioma['NoEsAsesor']?></div>
        <?php	
	} ?>
    </div>
</div>
<div class="span9">
	<div class="box-header"><h2><?php echo $idioma['Reporte'] ?></h2></div>
    <div class="box-content" id="respuestaformulario">
    </div>
</div>
<?php include_once("../../pie.php");?>