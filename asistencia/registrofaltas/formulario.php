<?php
include_once("../../login/check.php");

?>
<?php echo $idioma['FechaRevisar']?>:
<input type="text" name="FechaFalta" id="FechaFalta" class="span12 fechatope" value="<?php echo fecha2Str()?>">
<input type="submit" value="<?php echo $idioma['Revisar']?>" class="btn btn-success" id="revisar">
<script language="javascript" type="text/javascript">
var SeguroRegistrarFaltas="<?php echo $idioma['SeguroRegistrarFaltas']?>";
</script>