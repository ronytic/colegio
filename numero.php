<?php
$valores=array(1,1,0,0,0,2,2,2,0,3,3,0,0,4);
echo "<pre>";
print_r($valores);
echo "</pre>";

$i=0;
$anterior=0;
$total=count($valores);
$cantidad=array();
foreach($valores as $v){$cont++;
    if($v==0){
        if($anterior!=0){
            array_push($cantidad,$i);
        }
            $i=1;
            array_push($cantidad,$i); 
            $i=0; 
            $anterior=$v; 
        
    }else{
        $i++;
        if($total==$cont){
            array_push($cantidad,$i);
        }
        $anterior=$v;
        continue;
    }
}
echo "<pre>";
print_r($cantidad);
echo "</pre>";
?>
