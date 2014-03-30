<?php
include_once("../../login/check.php");
?>
<?php echo $idioma['Mensaje']?>:
<textarea class="span12" id="Mensaje" rows="5" title="<?php echo $idioma['NotaSms']?>" data-orientiacion=""></textarea>
<input type="submit" value="<?php echo $idioma['EnviarMensajes']?>" class="btn btn-success" id="enviar">
<a href="./" class="btn"><?php echo $idioma['Cancelar']?></a>
<script language="javascript">
var SeguroDeseaEnviarSMSCurso="<?php echo $idioma['SeguroDeseaEnviarSMSCurso']?>"
var SeguroDeseaEnviarSMS="<?php echo $idioma['SeguroDeseaEnviarSMS']?>"
</script>