<?php
$i=$_GET['i'];
setcookie("Idioma",$i);
$dir=$_SERVER['HTTP_REFERER'];
header("Location: $dir"); 
?>