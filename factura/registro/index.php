<?php
include_once("../../login/check.php");
$titulo="RegistrarFactura";
$folder="../../";
include_once($folder."cabecerahtml.php");
?>
<style type="text/css">
	th{vertical-align:top !important;}
</style>
<?php include_once($folder."cabecera.php");?>
<div class="span12 box">
	<div class="box-header"><h2><?php echo $idioma['RegistrarFactura']?></h2></div>
    <div class="box-content">
    	<table class="table table-bordered">
        	<thead>
        		<tr>
                	<th><?php echo $idioma['Fecha']?>:<br><input type="text" class="fecha"></th>
                	<th><?php echo $idioma['N']?>: <input type="text" class=""></th>
                    <th><?php echo $idioma['NReferencia']?>: <input type="text" class="" readonly></th>
                </tr>
                <tr>
                	<th><?php echo $idioma['Alumno']?>:
                    <input type="text" id="" readonly>
                    <br><input type="button" class="btn btn-info buscar" value="<?php echo $idioma['Buscar']?>"></th>
                	<th><?php echo $idioma['Nit']?>: <input type="text" class=""></th>
                    <th><?php echo $idioma['Senores']?>: <input type="text" class="" readonly></th>
                    <th></th>
                </tr>
            </thead>

        </table>
    	
        
    </div>
</div>
<?php include_once($folder."pie.php");?>