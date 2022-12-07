<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
</head>
<body>

<?php include 'arrayfunctions.php';?>


<script>

var x=new Array(); // the array where we store values

   // Display the different elements that we have in the array
	function Display() {
		let str="";
		for (let i=0;i<x.length;i++)
			str+=x[i] + ",";
		document.getElementById('myinputarray').innerHTML=str;
		str="";
		
		var tablepost=document.getElementById('inputtable_post');
		var tableget=document.getElementById('inputtable_get');
		document.getElementById('npost').value=x.length;
		document.getElementById('nget').value=x.length;
		for (let i=0;i<x.length;i++)
		{
		    strname='v'+i;
			str+='<tr><td><input type="text" id="' + strname 
			                            + '" name="' + strname  
                                        + '" value="' + x[i] + '" </td></tr>';
		}
		tablepost.innerHTML=str;	
		tableget.innerHTML=str;			
	}

	// Add an element in the array
	function factorial() {
        x = (document.getElementById('npost').value);
        var factorial=1;
        for (i = 1; i <= x; i++){
            
        factorial = factorial * i;
    }
		
		alert(factorial);}
	
	
	
</script>

<!-- Basic form: -->
<section>
<h1>Input form</h1>

<p id="myinputarray"></p>
<p><label>Number: <input type="text" id="n_input"/> </label></p>
<p><input  type="button" id="bt04" type="button" onclick="factorial()" value="Factorial"></p>
</section>

<?php
$myarray=array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	echo 'Request with a POST <br>';
	$n=(isset($_POST['npost'])) ? $_POST['npost'] : 0;
	$v0=(isset($_POST['v0'])) ? $_POST['v0'] : 0;
	// Retrieve the array
	echo 'Array of size ' . $n . '<br>';
	echo 'v0 ' . $v0 . '<br>';
	if ($n>0)
	{
		for ($i=0;$i<$n;$i++)
		{
			$name= 'v' . strval($i);
			$myarray[$i]=(isset($_POST[$name])) ? $_POST[$name] : 0;
		}
	}
	echo json_encode($myarray) . '<br>';
}


if ($_SERVER["REQUEST_METHOD"] == "GET") {
	echo 'Request with a GET <br>';
	$n=(isset($_GET['nget'])) ? $_GET['nget'] : 0;
	$v0=(isset($_GET['v0'])) ? $_GET['v0'] : 0;
	// Retrieve the array
	echo 'Array of size ' . $n . '<br>';
	echo 'v0 ' . $v0 . '<br>';
	if ($n>0)
	{
		for ($i=0;$i<$n;$i++)
		{
			$name= 'v' . strval($i);
			$myarray[$i]=(isset($_GET[$name])) ? $_GET[$name] : 0;
		}
	}
	echo json_encode($myarray) . '<br>';
}
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<section>
Number of elements in the array: <input type="text" id="npost" name="npost" value="" readonly="readonly">
<table id="inputtable_post">
<!-- This part will display the table -->
</table>
<input type="submit" name="submit" value="Submit - POST">  
</section>
</form>

<form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<section>
Number of elements in the array: <input type="text" id="nget" name="nget" value="" readonly="readonly">
<table id="inputtable_get">
<!-- This part will display the table -->
</table>
<input type="submit" name="submit" value="Submit - GET">  
</section>
</form>




</body>
</html>