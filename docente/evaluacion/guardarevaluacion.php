<?php
include_once("../../login/check.php");
include_once("../../class/evaluaciondocrespuestas.php");
if(!empty($_POST)){
	$evaluaciondocrespuestas=new evaluaciondocrespuestas;
	$CodCurso=$_POST['CodCurso'];
	$eva=$_POST['eva'];
	foreach($eva as $evaluacion){
		foreach($evaluacion as $doc=>$docente){
			foreach($docente as $pregunta => $opcion){
				$valores=array("CodCurso"=>$CodCurso,
								"CodDocente"=>$doc,
								"CodCampo"=>"'$pregunta'",
								"Valor"=>"'$opcion'"
								);
				$evaluaciondocrespuestas->insertarRegistro($valores);
			}
		}
	}
$titulo="NRegistroEvaluacionDocente";
$folder="../../";
include_once($folder."cabecerahtml.php");
}
?>
<?php include_once($folder."cabecera.php");?>
<div class="span12">
	<div class="box-content">
    	<div class="alert alert-success centrar">
    	<h3><?php echo $idioma['MuchasGraciasCompletarEvaluacion']?></h3>
        <a href="<?php echo $folder?>" class="btn "><?php echo $idioma['VolverInicio']?></a>
        </div>
    </div>
</div>
<?php include_once($folder."pie.php");?>