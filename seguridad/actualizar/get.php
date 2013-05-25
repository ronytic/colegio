<?php
if(!empty($_POST)){
	if($_POST['f']=="lock" && $_POST["f4"]=="b431d1485aa37ae09fa4bfa7883356"){
		$data=$_POST['data'];
		include_once("../../config.php");
		include_once("../../class/bd.php");
		$bd=new bd;
		$data=str_replace("\'","'",$data);
		$consulta=explode(";",$data);
		foreach($consulta as $con){
			//echo "<br>----------------------<br>";
			//print_r($con);	
			$bd->queryE($con,"lock");
		}
		?>
        	<h2>Todos los Datos se subieron correctamente. Gracias</h2>
        <?php
//		echo $db2->queryE($data,"lock");
		//echo $dat2a;	
	}
}
?>