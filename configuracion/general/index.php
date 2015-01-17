<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="NConfiguracionGeneral";
include_once("../funciones.php");
include_once($folder."cabecerahtml.php");
?>
<script language="javascript" type="text/javascript" src="../../js/configuracion/general.js"></script>
<?php include_once($folder."cabecera.php");?>
<?php if($_GET['m']==1){?>
<div class="span12">
<div class="alert alert-success">
<?php echo $idioma['DatosGuardadosCorrectamente']?><a class="close" data-dismiss="alert" href="#">&times;</a>
</div>
</div>

<?php }?>
<form action="guardar.php" method="post">
<div class="span6 box">
	<div class="box-header"><h2><?php echo $idioma['Periodos']?> - <?php echo $idioma['Trimestre']?> - <?php echo $idioma['Bimestre']?><a name="periodos"></a></h2></div>
	<div class="box-content">
    	<table class="table table-hover table-bordered table-condensed">
        	<tr>
            	<td><?php echo $idioma['TotalPeriodo']?><div class="pequeno"><?php echo $idioma['TotalPeriodoE']?></div></td>
                <td width="150"><input type="number" class="span6 der" name="TotalPeriodo" value="<?php echo (dato("TotalPeriodo"))?>" readonly min="1"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['PeriodoActual']?><div class="pequeno"><?php echo $idioma['PeriodoActualE']?></div></td>
                <td><select class="span6" name="PeriodoActual">
                	<?php for($i=1;$i<=dato("TotalPeriodo");$i++){
					?><option value="<?php echo $i;?>" class="der" <?php echo dato("PeriodoActual")==$i?'selected':''?>><?php echo $i?></option><?php	
					}?>
                </select></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['PeriodoActualBimestre']?><div class="pequeno"><?php echo $idioma['PeriodoActualBimestreE']?></div></td>
                <td><select class="span6" name="PeriodoActualBimestre">
                	<?php for($i=1;$i<=dato("TotalPeriodo");$i++){
					?><option value="<?php echo $i;?>" class="der" <?php echo dato("PeriodoActualBimestre")==$i?'selected':''?>><?php echo $i?></option><?php	
					}?>
                </select></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['PeriodoActualTrimestre']?><div class="pequeno"><?php echo $idioma['PeriodoActualTrimestreE']?></div></td>
                <td><select class="span6" name="PeriodoActualTrimestre">
                	<?php for($i=1;$i<=dato("TotalPeriodo");$i++){
					?><option value="<?php echo $i;?>" class="der" <?php echo dato("PeriodoActualTrimestre")==$i?'selected':''?>><?php echo $i?></option><?php	
					}?>
                </select></td>
            </tr>
            <tr>
            	<td class="centrar" colspan="2"><input type="submit" class="btn btn-success" value="<?php echo $idioma['Guardar']?>"></td>
            </tr>
            <tr>
            	<td colspan="2" class="resaltar"><?php echo $idioma['FechasTrimestre']?></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['InicioTrimestre1']?></td>
                <td><input type="text" class="span8 fecha" name="InicioTrimestre1" value="<?php echo fecha2Str(dato("InicioTrimestre1"))?>" ></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['FinTrimestre1']?></td>
                <td><input type="text" class="span8 fecha" name="FinTrimestre1" value="<?php echo fecha2Str(dato("FinTrimestre1"))?>" ></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['InicioTrimestre2']?></td>
                <td><input type="text" class="span8 fecha" name="InicioTrimestre2" value="<?php echo fecha2Str(dato("InicioTrimestre2"))?>" ></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['FinTrimestre2']?></td>
                <td><input type="text" class="span8 fecha" name="FinTrimestre2" value="<?php echo fecha2Str(dato("FinTrimestre2"))?>" ></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['InicioTrimestre3']?></td>
                <td><input type="text" class="span8 fecha" name="InicioTrimestre3" value="<?php echo fecha2Str(dato("InicioTrimestre3"))?>" ></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['FinTrimestre3']?></td>
                <td><input type="text" class="span8 fecha" name="FinTrimestre3" value="<?php echo fecha2Str(dato("FinTrimestre3"))?>" ></td>
            </tr>
            <tr>
            	<td colspan="2" class="resaltar"><?php echo $idioma['FechasBimestre']?></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['InicioBimestre1']?></td>
                <td><input type="text" class="span8 fecha" name="InicioBimestre1" value="<?php echo fecha2Str(dato("InicioBimestre1"))?>" ></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['FinBimestre1']?></td>
                <td><input type="text" class="span8 fecha" name="FinBimestre1" value="<?php echo fecha2Str(dato("FinBimestre1"))?>" ></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['InicioBimestre2']?></td>
                <td><input type="text" class="span8 fecha" name="InicioBimestre2" value="<?php echo fecha2Str(dato("InicioBimestre2"))?>" ></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['FinBimestre2']?></td>
                <td><input type="text" class="span8 fecha" name="FinBimestre2" value="<?php echo fecha2Str(dato("FinBimestre2"))?>" ></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['InicioBimestre3']?></td>
                <td><input type="text" class="span8 fecha" name="InicioBimestre3" value="<?php echo fecha2Str(dato("InicioBimestre3"))?>" ></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['FinBimestre3']?></td>
                <td><input type="text" class="span8 fecha" name="FinBimestre3" value="<?php echo fecha2Str(dato("FinBimestre3"))?>" ></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['InicioBimestre4']?></td>
                <td><input type="text" class="span8 fecha" name="InicioBimestre4" value="<?php echo fecha2Str(dato("InicioBimestre4"))?>" ></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['FinBimestre4']?></td>
                <td><input type="text" class="span8 fecha" name="FinBimestre4" value="<?php echo fecha2Str(dato("FinBimestre4"))?>" ></td>
            </tr>
            <tr>
            	<td class="centrar" colspan="2"><input type="submit" class="btn btn-success" value="<?php echo $idioma['Guardar']?>"></td>
            </tr>
            <tr>
            	<td class="resaltar" colspan="2"><?php echo $idioma['DiasTrabajados']?></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['CantidadDiasTrabajado1']?></td>
                <td><input type="text" class="span8" name="CantidadDiasTrabajado1" value="<?php echo dato("CantidadDiasTrabajado1")?>" ></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['CantidadDiasTrabajado2']?></td>
                <td><input type="text" class="span8" name="CantidadDiasTrabajado2" value="<?php echo dato("CantidadDiasTrabajado2")?>" ></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['CantidadDiasTrabajado3']?></td>
                <td><input type="text" class="span8" name="CantidadDiasTrabajado3" value="<?php echo dato("CantidadDiasTrabajado3")?>" ></td>
            </tr>
            <tr>
            	<td class="centrar" colspan="2"><input type="submit" class="btn btn-success" value="<?php echo $idioma['Guardar']?>"></td>
            </tr>
        </table>
    </div>
	<div class="box-header"><h2><?php echo $idioma['Cuotas']?><a name="cuotas"></a></h2></div>
    <div class="box-content">
    	<table class="table table-hover table-bordered">
        	<tr>
            	<td><?php echo $idioma['Moneda']?></td>
                <td><input type="text" class="span10" name="Moneda" value="<?php echo dato("Moneda")?>"></td>
            </tr>
			<tr>
            	<td><?php echo $idioma['FechaCuota1']?></td>
                <td><input type="text" class="span6 fecha" name="FechaCuota1" value="<?php echo fecha2Str(dato("FechaCuota1"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['FechaCuota2']?></td>
                <td><input type="text" class="span6 fecha" name="FechaCuota2" value="<?php echo fecha2Str(dato("FechaCuota2"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['FechaCuota3']?></td>
                <td><input type="text" class="span6 fecha" name="FechaCuota3" value="<?php echo fecha2Str(dato("FechaCuota3"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['FechaCuota4']?></td>
                <td><input type="text" class="span6 fecha" name="FechaCuota4" value="<?php echo fecha2Str(dato("FechaCuota4"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['FechaCuota5']?></td>
                <td><input type="text" class="span6 fecha" name="FechaCuota5" value="<?php echo fecha2Str(dato("FechaCuota5"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['FechaCuota6']?></td>
                <td><input type="text" class="span6 fecha" name="FechaCuota6" value="<?php echo fecha2Str(dato("FechaCuota6"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['FechaCuota7']?></td>
                <td><input type="text" class="span6 fecha" name="FechaCuota7" value="<?php echo fecha2Str(dato("FechaCuota7"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['FechaCuota8']?></td>
                <td><input type="text" class="span6 fecha" name="FechaCuota8" value="<?php echo fecha2Str(dato("FechaCuota8"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['FechaCuota9']?></td>
                <td><input type="text" class="span6 fecha" name="FechaCuota9" value="<?php echo fecha2Str(dato("FechaCuota9"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['FechaCuota10']?></td>
                <td><input type="text" class="span6 fecha" name="FechaCuota10" value="<?php echo fecha2Str(dato("FechaCuota10"))?>"></td>
            </tr>
            <tr>
            	<td class="centrar" colspan="2"><input type="submit" class="btn btn-success" value="<?php echo $idioma['Guardar']?>"></td>
            </tr>
        </table>
    </div>
    <div class="box-header"><h2><?php echo $idioma['PosicionBoletin']?><a name="posicionboletin"></a></h2></div>
    <div class="box-content">
    	<div class="centrar"><img src="../../imagenes/configuracion/posicionboletin.jpg" class="img-polaroid"></div>
    	<table class="table table-bordered table-hover">
        	<tr>
            	<td><?php echo $idioma['BoletinPosicion1X']?>→<div class="pequeno"><?php echo $idioma['Area1X']?></div></td>
                <td><input type="text" class="span12" name="BoletinPosicion1X" value="<?php echo (dato("BoletinPosicion1X"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['BoletinPosicion1Y']?>↓<div class="pequeno"><?php echo $idioma['Area1Y']?></div></td>
                <td><input type="text" class="span12" name="BoletinPosicion1Y" value="<?php echo (dato("BoletinPosicion1Y"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['BoletinPosicion2X']?>→<div class="pequeno"><?php echo $idioma['Area2X']?></div></td>
                <td><input type="text" class="span12" name="BoletinPosicion2X" value="<?php echo (dato("BoletinPosicion2X"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['BoletinPosicion2Y']?>↓<div class="pequeno"><?php echo $idioma['Area2Y']?></div></td>
                <td><input type="text" class="span12" name="BoletinPosicion2Y" value="<?php echo (dato("BoletinPosicion2Y"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['BoletinPosicion3X']?>→<div class="pequeno"><?php echo $idioma['Area3X']?></div></td>
                <td><input type="text" class="span12" name="BoletinPosicion3X" value="<?php echo (dato("BoletinPosicion3X"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['BoletinPosicion3Y']?>↓<div class="pequeno"><?php echo $idioma['Area3Y']?></div></td>
                <td><input type="text" class="span12" name="BoletinPosicion3Y" value="<?php echo (dato("BoletinPosicion3Y"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['BoletinPosicion4X']?>→<div class="pequeno"><?php echo $idioma['Area4X']?></div></td>
                <td><input type="text" class="span12" name="BoletinPosicion4X" value="<?php echo (dato("BoletinPosicion4X"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['BoletinPosicion4Y']?>↓<div class="pequeno"><?php echo $idioma['Area4Y']?></div></td>
                <td><input type="text" class="span12" name="BoletinPosicion4Y" value="<?php echo (dato("BoletinPosicion4Y"))?>"></td>
            </tr>
        	<tr>
            	<td class="centrar" colspan="2"><input type="submit" class="btn btn-success" value="<?php echo $idioma['Guardar']?>"></td>
            </tr>
        </table>
	</div>
	<div class="box-header"><h2><?php echo $idioma['Agenda']?><a name="agenda"></a></h2></div>
    <div class="box-content">
    	<table class="table table-bordered table-hover">
        	<tr>
            	<td><?php echo $idioma['AtrasoAgenda']?></td>
                <td><select class="span12" name="AtrasoAgenda">
                	<option value="0" <?php echo (dato("AtrasoAgenda"))==0?'selected':''?>><?php echo $idioma['No']?></option>
                    <option value="1" <?php echo (dato("AtrasoAgenda"))==1?'selected':''?>><?php echo $idioma['Si']?></option>
                </select></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['FaltaAgenda']?></td>
                <td><select class="span12" name="FaltaAgenda">
                	<option value="0" <?php echo (dato("FaltaAgenda"))==0?'selected':''?>><?php echo $idioma['No']?></option>
                    <option value="1" <?php echo (dato("FaltaAgenda"))==1?'selected':''?>><?php echo $idioma['Si']?></option>
                </select></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['TipoEstadisticaAsistenciaInicio']?></td>
                <td><select class="span12" name="TipoEstadisticaAsistenciaInicio">
                	<option value="Agenda" <?php echo (dato("TipoEstadisticaAsistenciaInicio"))=="Agenda"?'selected':''?>><?php echo $idioma['Agenda']?></option>
                    <option value="Asistencia" <?php echo (dato("TipoEstadisticaAsistenciaInicio"))=="Asistencia"?'selected':''?>><?php echo $idioma['Asistencia']?></option>
                </select></td>
            </tr>
        	<tr>
            	<td class="centrar" colspan="2"><input type="submit" class="btn btn-success" value="<?php echo $idioma['Guardar']?>"></td>
            </tr>
        </table>
	</div>
    <div class="box-header"><h2><?php echo $idioma['Sms']?><a name="sms"></a></h2></div>
    <div class="box-content">
    	<table class="table table-bordered table-hover">
        	<tr>
            	<td width="60%"><?php echo $idioma['EstadoSms']?></td>
                <td><select class="span12" name="EstadoSms">
                	<option value="NoEnviar" <?php echo (dato("EstadoSms"))=="NoEnviar"?'selected':''?>><?php echo $idioma['NoEnviar']?></option>
                    <option value="PorCadaObservacion" <?php echo (dato("EstadoSms"))=="PorCadaObservacion"?'selected':''?>><?php echo $idioma['PorCadaObservacion']?></option>
                    <!--<option value="GeneralCadaDia" <?php echo (dato("EstadoSms"))=="GeneralCadaDia"?'selected':''?>><?php echo $idioma['GeneralCadaDia']?></option>-->
                </select></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['PuertoUsb']?><br><small><?php echo $idioma['NadaPuerto']?></small>
					<script language="javascript">
                    $(document).on("ready",function(){
						cargandoG(".msgusb");
						$.post("usb.php",{'PuertoUsb':<?php echo dato("PuertoUsb")?>},function(data){$(".msgusb").html(data)});
					});
                    </script> 
                    <div class="msgusb"></div>              	
                </td>
                <td><input type="text" class="span12" name="PuertoUsb" value="<?php echo (dato("PuertoUsb"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['ComunicadoSMS']?></td>
                <td><textarea class="span12" name="ComunicadoSMS" rows="6"><?php echo (dato("ComunicadoSMS"))?></textarea></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['CitacionSMS']?></td>
                <td><textarea class="span12" name="CitacionSMS" rows="6"><?php echo (dato("CitacionSMS"))?></textarea></td>
            </tr>
        	<tr>
            	<td class="centrar" colspan="2"><input type="submit" class="btn btn-success" value="<?php echo $idioma['Guardar']?>"></td>
            </tr>
        </table>
	</div>
</div>
<div class="span6 box">
	<div class="box-header"><h2><?php echo $idioma['Notas']?><a name="notas"></a></h2></div>
    <div class="box-content">
    	<table class="table table-bordered table-hover">
        	<tr>
            	<td><?php echo $idioma['RegistroNotaHabilitado']?><div class="pequeno"><?php echo $idioma['RegistroNotaHabilitadoE']?></div></td>
                <td><select class="span12" name="RegistroNotaHabilitado">
                	<option value="0" <?php echo (dato("RegistroNotaHabilitado"))==0?'selected':''?>><?php echo $idioma['No']?></option>
                    <option value="1" <?php echo (dato("RegistroNotaHabilitado"))==1?'selected':''?>><?php echo $idioma['Si']?></option>
                </select></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['PeriodoNotaHabilitado']?><div class="pequeno"><?php echo $idioma['PeriodoNotaHabilitadoE']?></div></td>
                <td><select class="span12" name="PeriodoNotaHabilitado">
                	<?php for($i=1;$i<=dato("TotalPeriodo");$i++){
					?><option value="<?php echo $i;?>" class="der" <?php echo dato("PeriodoNotaHabilitado")==$i?'selected':''?>><?php echo $i?></option><?php	
					}?>
                </select></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['PeriodoNotaHabilitadoBimestre']?><div class="pequeno"><?php echo $idioma['PeriodoNotaHabilitadoE']?></div></td>
                <td><select class="span12" name="PeriodoNotaHabilitadoBimestre">
                	<?php for($i=1;$i<=dato("TotalPeriodo");$i++){
					?><option value="<?php echo $i;?>" class="der" <?php echo dato("PeriodoNotaHabilitadoBimestre")==$i?'selected':''?>><?php echo $i?></option><?php	
					}?>
                </select></td>
            </tr>
            <tr>
            	<td class="centrar" colspan="2"><input type="submit" class="btn btn-success" value="<?php echo $idioma['Guardar']?>"></td>
            </tr>
        </table>
    </div>
    <div class="box-header"><h2><?php echo $idioma['NotasCualitativas']?><a name="notascualitativas"></a></h2></div>
    <div class="box-content">
    	<table class="table table-bordered table-hover">
	        <tr><td colspan="2" class="resaltar"><?php echo $idioma['Bimestre']?></td></tr>
        	<tr>
            	<td><?php echo $idioma['Limite1Bimestre']?></td>
                <td><input type="text" class="span5" name="LimiteInicio1Bimestre" value="<?php echo (dato("LimiteInicio1Bimestre"))?>"> - <input type="text" class="span5" name="LimiteFin1Bimestre" value="<?php echo (dato("LimiteFin1Bimestre"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['Limite2Bimestre']?></td>
                <td><input type="text" class="span5" name="LimiteInicio2Bimestre" value="<?php echo (dato("LimiteInicio2Bimestre"))?>"> - <input type="text" class="span5" name="LimiteFin2Bimestre" value="<?php echo (dato("LimiteFin2Bimestre"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['Limite3Bimestre']?></td>
                <td><input type="text" class="span5" name="LimiteInicio3Bimestre" value="<?php echo (dato("LimiteInicio3Bimestre"))?>"> - <input type="text" class="span5" name="LimiteFin3Bimestre" value="<?php echo (dato("LimiteFin3Bimestre"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['Limite4Bimestre']?></td>
                <td><input type="text" class="span5" name="LimiteInicio4Bimestre" value="<?php echo (dato("LimiteInicio4Bimestre"))?>"> - <input type="text" class="span5" name="LimiteFin4Bimestre" value="<?php echo (dato("LimiteFin4Bimestre"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['LimiteLetrasBimestre']?></td>
                <td><input type="text" class="span5" name="LimiteLetrasBimestre" value="<?php echo (dato("LimiteLetrasBimestre"))?>"> <?php echo $idioma['Letras']?></td>
            </tr>
            <tr><td colspan="2" class="resaltar"><?php echo $idioma['Trimestre']?></td></tr>
            <tr>
            	<td><?php echo $idioma['Limite1Trimestre']?></td>
                <td><input type="text" class="span5" name="LimiteInicio1Trimestre" value="<?php echo (dato("LimiteInicio1Trimestre"))?>"> - <input type="text" class="span5" name="LimiteFin1Trimestre" value="<?php echo (dato("LimiteFin1Trimestre"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['Limite2Trimestre']?></td>
                <td><input type="text" class="span5" name="LimiteInicio2Trimestre" value="<?php echo (dato("LimiteInicio2Trimestre"))?>"> - <input type="text" class="span5" name="LimiteFin2Trimestre" value="<?php echo (dato("LimiteFin2Trimestre"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['Limite3Trimestre']?></td>
                <td><input type="text" class="span5" name="LimiteInicio3Trimestre" value="<?php echo (dato("LimiteInicio3Trimestre"))?>"> - <input type="text" class="span5" name="LimiteFin3Trimestre" value="<?php echo (dato("LimiteFin3Trimestre"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['Limite4Trimestre']?></td>
                <td><input type="text" class="span5" name="LimiteInicio4Trimestre" value="<?php echo (dato("LimiteInicio4Trimestre"))?>"> - <input type="text" class="span5" name="LimiteFin4Trimestre" value="<?php echo (dato("LimiteFin4Trimestre"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['LimiteLetrasTrimestre']?></td>
                <td><input type="text" class="span5" name="LimiteLetrasTrimestre" value="<?php echo (dato("LimiteLetrasTrimestre"))?>"> <?php echo $idioma['Letras']?></td>
            </tr>
            <tr>
            	<td class="centrar" colspan="2"><input type="submit" class="btn btn-success" value="<?php echo $idioma['Guardar']?>"></td>
            </tr>
        </table>
    </div>
	<div class="box-header"><h2><?php echo $idioma['DatosInstitucion']?><a name="datosinstitucion"></a></h2></div>
    <div class="box-content">
    	<table class="table table-bordered table-hover">
        	<tr>
            	<td width="50%"><?php echo $idioma['TipoUnidadEducativa']?></td>
                <td><select name="TipoUnidadEducativa">
                	<option value="Privada" <?php echo dato('TipoUnidadEducativa')=="Privada"?'selected="selected"':''?>><?php echo $idioma['Privada']?></option>
                    <option value="Convenio" <?php echo dato('TipoUnidadEducativa')=="Convenio"?'selected="selected"':''?>><?php echo $idioma['Convenio']?></option>
                    <option value="Comunitaria" <?php echo dato('TipoUnidadEducativa')=="Comunitaria"?'selected="selected"':''?>><?php echo $idioma['Comunitaria']?></option>
                    <option value="Publica" <?php echo dato('TipoUnidadEducativa')=="Publica"?'selected="selected"':''?>><?php echo $idioma['Publica']?></option>
                </select>
                </td>
            </tr>
            <tr>
            	<td width="50%"><?php echo $idioma['TurnoUnidad']?></td>
                <td><select name="TurnoUnidad">
                	<option value="Manana" <?php echo dato('TurnoUnidad')=="Manana"?'selected="selected"':''?>><?php echo $idioma['Manana']?></option>
                    <option value="Tarde" <?php echo dato('TurnoUnidad')=="Tarde"?'selected="selected"':''?>><?php echo $idioma['Tarde']?></option>
                    <option value="Noche" <?php echo dato('TurnoUnidad')=="Noche"?'selected="selected"':''?>><?php echo $idioma['Noche']?></option>
                </select>
                </td>
            </tr>
        	<tr>
            	<td width="50%"><?php echo $idioma['TituloSistemaA']?><div class="pequeno"><?php echo $idioma['TituloSistemaE']?></div></td>
                <td><input type="text" class="span12" name="Titulo" value="<?php echo (dato("Titulo"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['Sigla']?></td>
                <td><input type="text" class="span12" name="Sigla" value="<?php echo (dato("Sigla"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['Lema']?><div class="pequeno"><?php echo $idioma['LemaE']?></div></td>
                <td><input type="text" class="span12" name="Lema" value="<?php echo (dato("Lema"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['Gestion']?></td>
                <td><input type="text" class="span12" name="Gestion" value="<?php echo (dato("Gestion"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['Año']?></td>
                <td><input type="text" class="span12" name="Anio" value="<?php echo (dato("Anio"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['NombreUnidadEducativa']?></td>
                <td><input type="text" class="span12" name="NombreUnidad" value="<?php echo (dato("NombreUnidad"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['NucleoRed']?></td>
                <td><input type="text" class="span12" name="NucleoRed" value="<?php echo (dato("NucleoRed"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['Localidad']?></td>
                <td><input type="text" class="span12" name="Localidad" value="<?php echo (dato("Localidad"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['DistritoEscolar']?></td>
                <td><input type="text" class="span12" name="DistritoEscolar" value="<?php echo (dato("DistritoEscolar"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['Departamento']?></td>
                <td><input type="text" class="span12" name="Departamento" value="<?php echo (dato("Departamento"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['DiaLibreta']?></td>
                <td><input type="text" class="span12" name="DiaLibreta" value="<?php echo (dato("DiaLibreta"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['MesLibreta']?></td>
                <td><input type="text" class="span12" name="MesLibreta" value="<?php echo (dato("MesLibreta"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['Sie']?></td>
                <td><input type="text" class="span12" name="Sie" value="<?php echo (dato("Sie"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['DistritoEducativo']?></td>
                <td><input type="text" class="span12" name="DistritoEducativo" value="<?php echo (dato("DistritoEducativo"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['TextoCodigoBarra']?></td>
                <td><input type="text" class="span12" name="CodBarra" value="<?php echo (dato("CodBarra"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['Telefono']?></td>
                <td><input type="text" class="span12" name="Telefono" value="<?php echo (dato("Telefono"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['TipoUnidadLogin']?><br>Ej: <small><?php echo $idioma['EjemploTipoUnidadLogin']?></small></td>
                <td><input type="text" class="span12" name="TipoUnidadLogin" value="<?php echo (dato("TipoUnidadLogin"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['NombreUnidadLogin']?><br><small><?php echo $idioma['PantallaInicio']?></small></td>
                <td><input type="text" class="span12" name="NombreUnidadLogin" value="<?php echo (dato("NombreUnidadLogin"))?>"></td>
            </tr>
        	<tr>
            	<td class="centrar" colspan="2"><input type="submit" class="btn btn-success" value="<?php echo $idioma['Guardar']?>"></td>
            </tr>
        </table>
    </div>
    
    <div class="box-header"><h2><?php echo $idioma['Facturacion']?><a name="facturacion"></a></h2></div>
    <div class="box-content">
    	<table class="table table-bordered table-hover">
        	<tr>
            	<td width="50%"><?php echo $idioma['NumeroAutorizacion']?>
                <div class="pequeno"><?php echo $idioma['NumeroAutorizacionT']?></div></td>
                <td><input type="text" class="span12" name="NumeroAutorizacion" value="<?php echo (dato("NumeroAutorizacion"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['FechaLimiteEmision']?></td>
                <td><input type="text" class="span12 fecha" name="FechaLimiteEmision" value="<?php echo (fecha2Str(dato("FechaLimiteEmision")))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['LlaveDosificacion']?><div class="pequeno"><?php echo $idioma['LlaveDosificacionT']?></div></td>
                <td><textarea class="span12" name="LlaveDosificacion" rows="4"><?php echo (dato("LlaveDosificacion"))?></textarea></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['ImagenFondo']?><div class="pequeno"><?php echo $idioma['ImagenFondoT']?></div></td>
                <td><select class="span12" name="ImagenFondoFactura">
                	<option value="0" <?php echo (dato("ImagenFondoFactura"))==0?'selected':''?>><?php echo $idioma['No']?></option>
                    <option value="1" <?php echo (dato("ImagenFondoFactura"))==1?'selected':''?>><?php echo $idioma['Si']?></option>
                </select></td>
            </tr>
            <tr class="info">
            	<td><?php echo $idioma['SistemaFacturacion']?><div class="pequeno"><?php echo $idioma['SistemaFacturacionT']?></div></td>
                <td><select class="span12" name="SistemaFacturacion">
                	<option value="Antiguo" <?php echo (dato("SistemaFacturacion"))=='Antiguo'?'selected':''?>><?php echo $idioma['SistemaFacturacionComputarizada']?></option>
                    <option value="NuevoQR" <?php echo (dato("SistemaFacturacion"))=='NuevoQR'?'selected':''?>><?php echo $idioma['NuevoSistemaFacturacion']?></option>
                </select></td>
            </tr>
            <tr class="success resaltar">
                <td colspan="2"><hr class="separador"><br><?php echo $idioma['NuevoSistemaFacturacion']?></td>
            </tr>
            <tr>
            	<td width="50%"><?php echo $idioma['NitEmisor']?>
                <div class="pequeno"><?php echo $idioma['NitEmisorT']?></div></td>
                <td><input type="text" class="span12" name="NitEmisor" value="<?php echo (dato("NitEmisor"))?>"></td>
            </tr>
            <tr>
            	<td width="50%"><?php echo $idioma['RazonSocialEmisor']?>
                <div class="pequeno"><?php echo $idioma['RazonSocialEmisorT']?></div></td>
                <td><input type="text" class="span12" name="RazonSocialEmisor" value="<?php echo (dato("RazonSocialEmisor"))?>"></td>
            </tr>
            <tr>
            	<td width="50%"><?php echo $idioma['ActividadEconomica']?>
                <div class="pequeno"><?php echo $idioma['ActividadEconomicaT']?></div></td>
                <td><input type="text" class="span12" name="ActividadEconomica" value="<?php echo (dato("ActividadEconomica"))?>"></td>
            </tr>
            <tr>
            	<td width="50%"><?php echo $idioma['LeyendaPiePagina']?>
                <div class="pequeno"><?php echo $idioma['LeyendaPiePaginaT']?></div></td>
                <td><input type="text" class="span12" name="LeyendaPiePagina" value="<?php echo (dato("LeyendaPiePagina"))?>"></td>
            </tr>
            
            
        	<tr>
            	<td class="centrar" colspan="2"><input type="submit" class="btn btn-success" value="<?php echo $idioma['Guardar']?>"></td>
            </tr>
        </table>
    </div>
    <?php if($_SESSION['Nivel']==1):?>
    <div class="box-header"><h2><?php echo $idioma['Avanzado']?><a name="avanzado"></a></h2></div>
    <div class="box-content">
    	<table class="table table-bordered table-hover">
        	<tr>
            	<td width="150"><?php echo $idioma['UrlInternet']?></td>
                <td><input type="text" class="span12" name="UrlInternet" value="<?php echo (dato("UrlInternet"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['DirectorioInternet']?><div class="pequeno"><?php echo $idioma['DirectorioInternetE']?></div></td>
                <td><input type="text" class="span12" name="DirectorioInternet" value="<?php echo (dato("DirectorioInternet"))?>"></td>
            </tr>
            <tr>
            	<td colspan="2" class="resaltar"><?php echo $idioma['BaseDatos']?></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['IpInternet']?></td>
                <td><input type="text" class="span12" name="IpInternet" value="<?php echo (dato("IpInternet"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['PuertoInternet']?></td>
                <td><input type="text" class="span12" name="PuertoInternet" value="<?php echo (dato("PuertoInternet"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['UsuarioInternet']?></td>
                <td><input type="text" class="span12" name="UsuarioInternet" value="<?php echo (dato("UsuarioInternet"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['ContrasenaInternet']?></td>
                <td><input type="text" class="span12" name="ContrasenaInternet" value="<?php echo (dato("ContrasenaInternet"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['BaseDatosInternet']?></td>
                <td><input type="text" class="span12" name="BaseDatosInternet" value="<?php echo (dato("BaseDatosInternet"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['CodigoSeguimientoNotasDocente']?></td>
                <td><textarea class="span12" name="CodigoSeguimientoNotasDocente" rows="10"><?php echo (dato("CodigoSeguimientoNotasDocente"))?></textarea></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['ActualizacionNavegador']?></td>
                <td><input type="text" class="span12" name="ActualizacionNavegador" value="<?php echo (dato("ActualizacionNavegador"))?>"></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['CodigoSeguimientoSistema']?></td>
                <td><textarea class="span12" name="CodigoSeguimientoSistema" rows="10"><?php echo (dato("CodigoSeguimientoSistema"))?></textarea></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['CodigoAdicionalSistemaLogin']?></td>
                <td><textarea class="span12" name="CodigoAdicionalSistemaLogin" rows="10"><?php echo (dato("CodigoAdicionalSistemaLogin"))?></textarea></td>
            </tr>
        	<tr>
            	<td class="centrar" colspan="2"><input type="submit" class="btn btn-success" value="<?php echo $idioma['Guardar']?>"></td>
            </tr>
        </table>
	</div>
    <?php endif;?>
</div>
</form>
<?php include_once($folder."pie.php");?>