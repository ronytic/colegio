<?php
include_once("../../login/check.php");
$titulo="Buscar Alumno por Codigo";
$folder="../../";
?>
	<?php include_once($folder."cabecerahtml.php");?>
    <script language="javascript" type="text/javascript" src="../../js/agenda/buscarCodigo.js"></script>
    <script language="javascript">
    $(document).ready(function(e) {
        $("#Codigo").val("").focus();
    });
    </script>
    <?php include_once($folder."cabecera.php");?>
     	<div class="container_12" id="cuerpo">
  			<div class="prefix_4 grid_4 suffix_4">
            	<div class="titulo corner-top">Ingrese el Codigo de Barra</div>
                <div class="cuerpo">
                	<form action="revisarCodigo.php" method="post" id="formrevisar">
                    	<label for="Codigo">Ingrese el Codigo de Barra:</label>
                    	<input type="text" name="Codigo" id="Codigo" autofocus placeholder="Codigo de Barra" value=""/>
                        <div class="clear"></div>
                        <input type="submit" value="Revisar" class="corner-all"/>
                    </form>
                </div>
                <div id="respuesta"></div>
            </div>  
     	<div class="clear"></div>
        </div>
    <?php include_once($folder."footer.php");?>