<?php

// To go to the next line 
function NL() {
echo "<br>";
}

function ArrayRand($n) {
	// create an array of size n
	$some_data=0;
	$array = array_fill(0,$n,$some_data);
	for ($i=2;$i<$n;$i++) { // first 2 elements are 0
	$array[$i]=rand(0,1000);
	}
	return $array;
}

function ArraySortedRand($n) {
	// create an array of size n
	$some_data=0;
	$array = array_fill(0,$n,$some_data);
	$array[0]=rand(0,10);
	for ($i=1;$i<$n;$i++) {
		$array[$i]=$array[$i-1]+rand(0,10);
	}
	return $array;
}

// Display an array a
function DisplayArray($a) {
	for ($i=0;$i<count($a);$i++)
		echo $a[$i] .'_';
	NL();
}
 
// Example of the binary search in PHP
// search the value x in the array list
function iterative_binary_search($x, $list) {
	$left = 0;
	$right = count($list)-1;
	while ($left <= $right) {
		$mid = ($left + $right) >> 1;
 
		if ($list[$mid] == $x) {
			return $mid;
		} elseif ($list[$mid] > $x) {
			$right = $mid - 1;
		} elseif ($list[$mid] < $x) {
			$left = $mid + 1;
		}
	}
	return -1;
}
 
function FibArray($n){
	$fibarr = array();
	$fibarr = fibonacci($n);
	return $fibarr;

}
// Example of the Fibonacci function in PHP with a recursive function
function fibonacci($n) {
	if (( $n == 0 ) || ( $n == 1 )) {
     return $n;
	}
	return fibonacci( $n-2 ) + fibonacci( $n-1 );
}

// Determine if a number is prime or not
function isPrime($num) {
    //1 is not prime
    if($num == 1)
        return false;
    //2 is prime (the only even number that is prime)
    if($num == 2)
        return true;
    //*if the number is divisible by two, then it's not prime and it's no longer needed to check other even numbers
    if($num % 2 == 0) {
        return false;
    }
    // Checks the odd numbers. If any of them is a factor, then it returns false.
    // The sqrt can be an aproximation, rounds it to the next highest integer value.
    $ceil = ceil(sqrt($num));
    for($i = 3; $i <= $ceil; $i = $i + 2) {
        if($num % $i == 0)
            return false;
    }
    return true;
}

// Find the prime number 
function FindPrime($a) {
	$k=0;
	$out=array();
	for ($i=0;$i<count($a);$i++) {
	if (isPrime($a[$i])) {
		    $out[$k]=$a[$i];
			$k=$k+1;
		}
	}
	return $out;
}

// Compute the average value in the array x
function Average($x) {
	if (sizeof($x)>0)
	{
		$a=0;
		for ($i=0;$i<sizeof($x);$i++)
			$a+=$x[$i];
		return $a/sizeof($x);
	}
	else
		return 0;
}

// Compute the standard deviation of the values in the array x
function StandardDeviation($x) {
	if (sizeof($x)>0)
	{
		$a=Average($x);
		$s=0;
		for ($i=0;$i<sizeof($x);$i++)
			$s+= ($x[$i]-$a)**2;
		 return  sqrt($s/sizeof($x));
	}
	else
		return 0;
}

// Compute the median of the values in the array x
function Median($x) {	
	if (sizeof($x)>0)
	{
		$count = count($x); // determine the number of elements in the array
		sort($x); // sort the array
		$mid = floor(($count-1)/2); // position in the middle of the array
		return $x[$mid];
	}
	else
		return 0;
}

// Return the maximum value from the array x
function Maximum($x) {
	return (sizeof($x)>0) ? max($x) : 0;
}

// Return the minimum value from the array x
function Minimum($x) {
	return (sizeof($x)>0) ? min($x) : 0;
}

?>