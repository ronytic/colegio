<?php
function dato($Campo){
	global $folder;
	include_once($folder."class/config.php");
	$config=new config;
	$cnf=$config->mostrarConfig($Campo);	
	return htmlspecialchars($cnf['Valor']);
}
?>