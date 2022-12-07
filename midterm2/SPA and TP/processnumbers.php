<?php

include 'arrayfunctions.php';

// Solution for the POST and GET

// If there is no variable myarray in POST, we consider an array [0].
$myarray = (isset($_POST['myarray'])) ? json_decode($_POST['myarray']) : ['0'];

// If we get nothing from the POST, let's see if we can get something from the GET
if (count($myarray)==1 && $myarray[0]==0) 
{
	$myarray = (isset($_GET['myarray'])) ? json_decode($_GET['myarray']) : ['0'];
}

// If we get also nothing from the GET, then we will consider the default example
if (count($myarray)==1 && $myarray[0]==0) 
{
	echo "Nothing from the GET or POST <BR>";
	$do_example=1;
}
else
{
	$do_example=0;
}

// It is worthwhile to have some test functions to verify that what you have is working
// without calling the function from the client side via a GET or SET

if ($do_example) {
	// To verify the functions are working
	// It is a good practice to test your functions on the PHP side before you test them with incoming data from the client
	$list = array(0, 1, 1, 2, 3, 5, 8, 13, 21, 34, 57, 90, 144);
	
	echo DisplayArray(ArrayRand(10));
	NL();
	echo DisplayArray(ArraySortedRand(10));
	NL();
	
	$x = 57; // element to search
	echo iterative_binary_search($x, $list);
	NL();
	$x = 19; // element to search
	echo iterative_binary_search($x, $list);
	NL();

	echo "List of Fibonacci <br>";
	for ($i=1;$i<=20;$i++) {	
		echo "Element ". $i . " with value ". fibonacci($i) ."<br>";
	}

	$a[0]=5;
	$a[1]=7;
	$a[2]=14;
	echo DisplayArray(FindPrime($a));
	echo DisplayArray(FindPrime(ArraySortedRand(500)));
}
else
{
	$prime=FindPrime($myarray);	
	$array = ['average' => Average($myarray),
	  'standarddeviation' => StandardDeviation($myarray),
	  'median' => Median($myarray),
	  'max' => Maximum($myarray),
	  'min' => Minimum($myarray),
	  'prime' => FindPrime($myarray) ];		 		  
	echo json_encode($array);
}

?>