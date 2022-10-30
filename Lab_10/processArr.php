<?php
// Get Input
if (isset($_POST["Array"])){
    $arr = json_decode($_POST["Array"]);
}
else {
    $arr = Array();
    $arr[0] = 1;
    $arr[1] = 2;
    $arr[2] = 3;
}
// Process Array
$minVal = min($arr);
$maxVal = max($arr);
// Use sort to get median
$medianVal = 0;
$meanVal = array_sum($arr) / count($arr);
$stdVal = 0;
// Return Response
$response = ['min' => $minVal, 'max' => $maxVal, 'median' => $medianVal, 'mean' => $meanVal, 'std' => $stdVal];
echo json_encode($response);
?>