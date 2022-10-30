<?php 
//get input
if isset($_POST["Array"]){
    $arr = json_decode($_POST["Array"]);
}
else{
    $arr = Array();
    for(i=0;i<4;i++){
        $arr[i]=i;
    }
}

//proc arr
$min_val = min($arr);
$max_val = max($arr);
$med_val = 0; //use sort
$std_val=0;

$response = ['Min' => $min_val, 'Max' => $max_val, 'Med'=>$med_val, 'Std'=>$std_val];
//return res as str
echo json_encode($response)
?>