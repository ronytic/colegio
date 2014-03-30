<?php
session_start();
@set_magic_quotes_runtime(0);
//header("Content-Type: text/html;charset=utf-8");
if(!empty($_POST)){
	
/*	require_once('php-local-browscap.php');
	$navegador=get_browser_local(null,true,"lite_php_browscap.ini",true);
	print_r($navegador);*/

	include_once("../configuracion.php");
	include_once("../class/usuario.php");
	include_once("../class/alumno.php");
	include_once("../class/docente.php");
	include_once("../class/logusuario.php");
	$usu=new usuario;
	$alumno=new alumno;
	$docente=new docente;
	$logusuario=new logusuario;
	
	$url=$_POST['u'];
	if(empty($directory) || $directory==""){
		$u=$url;	
		$direccion="..".$u;
	}else{
		$u=explode($directory,$_POST['u']);
		$direccion="../".$u[1];
	}
	
	
	if(isset($_POST['usuario'],$_POST['pass']) && $_POST['usuario']!="" && $_POST['pass']!=""){
		
		$usuario=($_POST['usuario']);
		$pass=$_POST['pass'];
		
//		$usuario=str_replace("ñ","n",$usuario);
		$usuarioAl=str_replace(array("ñ","Ñ"),array("n","N"),$usuario);
		$usuarioAl=strtolower($usuarioAl);
	//	echo $usuarioAl;
	
		$agente=$_SERVER['HTTP_USER_AGENT'];
		$ip=$_SERVER['REMOTE_ADDR'];
		$lenguaje=$_SERVER['HTTP_ACCEPT_LANGUAGE'];
		$referencia= $_SERVER['HTTP_REFERER'];
		$fecha=date("Y-m-d");
		$hora=date("H:i:s");
		//$reg=$alumno->loginAlumno($usuario,$pass);
		if(ereg('^[a-z]*[a-z]$',$usuario)){
			//Administrador 1 2 3 4
			$reg=$usu->loginUsuarios($usuario,$pass);
			$reg=array_shift($reg);
			$sw=1;
		}elseif(ereg('^[0-9]{4,9}[0-9]$',$usuario)){
			//Padre de familia
			$reg=$alumno->loginPadre($usuario,$pass);
			$reg=array_shift($reg);
			$Nivel=6;
		
		}elseif(ereg('^([a-z])*[0-9]{1,4}$',$usuarioAl)){
			//Alumno
			//echo $usuario;
			$reg=$alumno->loginAlumno($usuario,$pass);
			$reg=array_shift($reg);
			$Nivel=7;
		}elseif(ereg('^[0-9]+[a-z]*$',$usuario)){
			//Docente

			$reg=$docente->loginDocente($usuario,$pass);
			$reg=array_shift($reg);
			$Nivel=3;
		}else{
			//echo $sql;
			header("Location:./?u=".$url.'&error=1');		
		}
		//echo $Nivel;
		/**/
		
		//$res=mysql_query($sql);
		//@$reg=mysql_fetch_array($res);
		$codUsuario=$reg['CodUsuario'];
		
		if($sw){
			$Nivel=$reg['Nivel'];
		}
		
		if($reg['Can']==1){
			$valuesLog=array(
				"CodUsuario"=>$codUsuario,
				"Nivel"=>$Nivel,
				"Url"=>"'$url'",
				"FechaLog"=>"'$fecha'",
				"HoraLog"=>"'$hora'",
				"Agente"=>"'$agente'",
				"Ip"=>"'$ip'",
				"Referencia"=>"'$referencia'",
				"Lenguaje"=>"'$lenguaje'"
			);
			$logusuario->insertarRegistro($valuesLog,0);
			//mysql_query("INSERT INTO logusuarios VALUES(NULL,$codUsuario,$Nivel,'$url','$fecha','$hora','$agente','$ip','$referencia','$lenguaje')");
			$_SESSION['CodUsuarioLog']=$codUsuario;
			$_SESSION['LoginSistemaColegio']=1;
			$_SESSION['Nivel']=$Nivel;
			$_SESSION['Idioma']=$reg['Idioma'];
			echo $logusuario->optimizarTablas();
			header("Location:".$direccion);
		}
		else{
			header("Location:./?u=".$url.'&error=1');
		}
	}else{
		header("Location:./?u=".$url.'&incompleto=1');	
	}
}
?>
