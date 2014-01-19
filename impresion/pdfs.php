<?php
include_once("fpdf_protection.php");
	if(!defined("Config")){
		include_once("../../class/config.php");
	}
	if(!isset($config)){
		$config=new config;
	}
	$cnf=$config->mostrarConfig("Titulo");
	$title=$cnf['Valor'];
	$cnf=$config->mostrarConfig("Gestion");
	$gestion=$cnf['Valor'];
	$cnf=$config->mostrarConfig("Lema");
	$lema=$cnf['Valor'];
	$cnf=$config->mostrarConfig("Logo");
	$logo=$cnf['Valor'];
	class PPDF extends FPDF_Protection{
		function Header(){
			global $idioma;
			$this->SetTitle(utf8_decode("Sistema Académico Administrativo para Colegios"),true);
			$this->SetAuthor(utf8_decode("Sistema Académico Administrativo para Colegios Desarrollado por Ronald Nina Layme. Cel: 73230568 - www.facebook.com/ronaldnina"),true);
			$this->SetSubject(utf8_decode("Sistema Académico Administrativo para Colegios Desarrollado por Ronald Nina Layme. Cel: 73230568 - www.facebook.com/ronaldnina"),true);
			$this->SetCreator(utf8_decode("Sistema Académico Administrativo para Colegios Desarrollado por Ronald Nina Layme. Cel: 73230568 - www.facebook.com/ronaldnina"),true);
			$this->SetProtection(array('print'));
			
		}

	}
?>