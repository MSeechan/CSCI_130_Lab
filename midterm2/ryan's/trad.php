<?php
$factorial = "";
$fact_array = Array();
function getFactorial($val){
    $sum = $val;
    $val-=1;
    while($val > 0){
        $sum *= $val;
        $val -=1;
    }
    return $sum;
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


if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!isset($_POST["input"])){
        $factorial = 1;
        $fact_array = get_FactArray(1);
    }else{
        $factorial = getFactorial($_POST["input"]);
        $fact_array = get_FactArray($_POST["input"]);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
        <label for="input"></label>
        <input type="number" id="input" name="input">
        <input type="submit" value="Submit">
    </form>

    <?php
    echo "Factorial: <br>";
    echo $factorial;
    echo "<br><br>";
    echo "Json Rep of Fact Array: <br>";
    echo json_encode($fact_array, JSON_PRETTY_PRINT);
    ?>
</body>
</html>