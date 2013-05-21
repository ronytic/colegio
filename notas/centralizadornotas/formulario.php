<?php
include_once("../../login/check.php");
if(isset($_POST))
{
	$CodCurso=$_POST['CodCurso'];
	include_once("../../class/config.php");
	include_once("../../class/curso.php");
	/// esto hay que cambiar con la tabla de configuracion
	$config=new config;
	$curso=new curso;
	$cnf=($config->mostrarConfig("TotalPeriodo"));
	$TotalPeriodo=$cnf['Valor'];
	$cur=$curso->mostrarCurso($CodCurso);
	$cur=array_shift($cur);
	if($cur['Bimestre']){
		$cnf=$config->mostrarConfig("InicioBimestre1");
		$fechaInicioBimestre1=$cnf['Valor'];
		$cnf=$config->mostrarConfig("FinBimestre1");
		$fechaFinBimestre1=$cnf['Valor'];
		$cnf=$config->mostrarConfig("InicioBimestre2");
		$fechaInicioBimestre2=$cnf['Valor'];
		$cnf=$config->mostrarConfig("FinBimestre2");
		$fechaFinBimestre2=$cnf['Valor'];
		$cnf=$config->mostrarConfig("InicioBimestre3");
		$fechaInicioBimestre3=$cnf['Valor'];
		$cnf=$config->mostrarConfig("FinBimestre3");
		$fechaFinBimestre3=$cnf['Valor'];
		$cnf=$config->mostrarConfig("InicioBimestre4");
		$fechaInicioBimestre4=$cnf['Valor'];
		$cnf=$config->mostrarConfig("FinBimestre4");
		$fechaFinBimestre4=$cnf['Valor'];
	}else{
		$cnf=$config->mostrarConfig("InicioTrimestre1");
		$fechaInicioTrimestre1=$cnf['Valor'];
		$cnf=$config->mostrarConfig("FinTrimestre1");
		$fechaFinTrimestre1=$cnf['Valor'];
		$cnf=$config->mostrarConfig("InicioTrimestre2");
		$fechaInicioTrimestre2=$cnf['Valor'];
		$cnf=$config->mostrarConfig("FinTrimestre2");
		$fechaFinTrimestre2=$cnf['Valor'];
		$cnf=$config->mostrarConfig("InicioTrimestre3");
		$fechaInicioTrimestre3=$cnf['Valor'];
		$cnf=$config->mostrarConfig("FinTrimestre3");
		$fechaFinTrimestre3=$cnf['Valor'];
	}
	$FechaActual=date("Y-m-d");
	if($cur['Bimestre']){
		if(strtotime($FechaActual)>=strtotime($fechaInicioBimestre1) and strtotime($FechaActual)<=strtotime($fechaFinBimestre1)){$tipo=1;}
		if(strtotime($FechaActual)>=strtotime($fechaInicioBimestre2) and strtotime($FechaActual)<=strtotime($fechaFinBimestre2)){$tipo=2;}
		if(strtotime($FechaActual)>=strtotime($fechaInicioBimestre3) and strtotime($FechaActual)<=strtotime($fechaFinBimestre3)){$tipo=3;}
		if(strtotime($FechaActual)>=strtotime($fechaInicioBimestre4) and strtotime($FechaActual)<=strtotime($fechaFinBimestre4)){$tipo=4;}
	}else{
		if(strtotime($FechaActual)>=strtotime($fechaInicioTrimestre1) and strtotime($FechaActual)<=strtotime($fechaFinTrimestre1)){$tipo=1;}
		if(strtotime($FechaActual)>=strtotime($fechaInicioTrimestre2) and strtotime($FechaActual)<=strtotime($fechaFinTrimestre2)){$tipo=2;}
		if(strtotime($FechaActual)>=strtotime($fechaInicioTrimestre3) and strtotime($FechaActual)<=strtotime($fechaFinTrimestre3)){$tipo=3;}
	}
	?>
	<?php echo $idioma['Periodo']?>:
    <input type="search" name="tPeriodo" placeholder="<?php echo $idioma['BuscarPeriodoPor']?>" class="span12"/>
	<select name="Periodo">
		<?php for($i=1;$i<=$TotalPeriodo;$i++){?>
		<option <?php echo $i==$tipo?'selected="selected"':'';?> value="<?php echo $i;?>"  ><?php echo $i;?></option>
		<?php }?>
    </select>
	<input type="submit" id="generar" value="<?php echo $idioma['VerReporte']?>" class="btn btn-success"/>
<?php	
}
?>