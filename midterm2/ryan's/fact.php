<?php
//
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!isset($_POST["val"])){
        echo 1;
        exit;
    }
    echo getFactorial($_POST["val"]);
}


if ($_SERVER["REQUEST_METHOD"] == "GET"){
    if(!isset($_GET["val"])){
        echo 1;
        exit;
    }
    if(isset($_GET["arr"])){
        echo json_encode(get_FactArray($_GET["val"]), JSON_PRETTY_PRINT);
        exit;
    }
    echo getFactorial($_GET["val"]);
}



function get_FactArray($val){
    $ret = Array();
    $sum = 1;
    array_push($ret, ["n" => 1, "f" => 1]);
    for($i = 2; $i <= $val; $i+=1){
        $sum *= $i;
        array_push($ret, ["n" => $i, "f" => $sum]);
    }
    return $ret;
}

function getFactorial($val){
    $sum = $val;
    $val-=1;
    while($val > 0){
        $sum *= $val;
        $val -=1;
    }
    return $sum;
}