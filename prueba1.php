<?php
$name="best-powerpoint.-templates-for-presentation1.jpg";
$cortado=explode(".",$name);
$tipoarchivo=array_pop($cortado);
$nombre=implode(".",$cortado);
echo $nombre.".".$tipoarchivo;
?>