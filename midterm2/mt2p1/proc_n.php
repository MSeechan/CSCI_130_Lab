<?php
$n;
$myarray = (isset($_POST['my_n'])) ? $n = ($_POST['my_n']) : $n=1;
// if(isset($GET['my_n'])) {
//      $n = ($_GET['my_n']) 
//     }else{ $n=1;}



$m = intval($n);

$factorial=1;
for ($i = 1; $i <= $m; $i++){
    
$factorial = $factorial * $i;
}
echo $factorial;

?>