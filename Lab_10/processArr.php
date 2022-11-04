<?php
// Get Input w/Array key and decode str to get array back
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
// Return Response str
$response = ['min_key' => $minVal, 'max_key' => $maxVal, 'median_key' => $medianVal, 'mean_key' => $meanVal, 'std_key' => $stdVal];
echo json_encode($response);
?>