<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Web Programming - CSci 130</title>
</head>
<body>

<?php include 'TP_arrayfunctions.php';?>


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
	function Add() {
		x.push(document.getElementById('item').value);
		Display();
	}
  
    // Reset the content of the array
	function Reset() {
		x=new Array();
		Display();
	}
	  
	// Create a array of size 10 with random values
	function RandArray() {
		x=[];
		for (let i=0;i<10;i++)
			x[i]=Math.floor(Math.random()*100);
		Display();
	}
	
	
</script>

<!-- Basic form: -->
<section>
<h1>Input form</h1>
<p><label>Number: <input type="text" id="item"/> </label></p>
<p id="myinputarray"></p>
<p><input  type="button" id="bt01" type="button" onclick="Add()" value="Add Number"></p>
<p><input  type="button" id="bt02" type="button" onclick="Reset()" value="Reset Array"></p>
<p><input  type="button" id="bt03" type="button" onclick="RandArray()" value="Random Array"></p>
<p><input  type="button" id="bt04" type="button" onclick="FibArray()" value="Fib Array"></p>
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

<section>
<h1>Results</h1>
<p id="result"> 
<!-- This part will contain the response sent by the server -->
Average: <?php echo strval(Average($myarray)) ?><br>
Median: <?php  echo strval(Median($myarray)) ?><br>
StandardDeviation: <?php echo strval(StandardDeviation($myarray)) ?><br>
Maximum: <?php echo strval(Maximum($myarray)) ?><br>
Minimum:<?php echo strval(Minimum($myarray)) ?><br>
Prime Numbers: <?php echo json_encode(FindPrime($myarray)) ?>
</p>
</section>

</body>
</html>