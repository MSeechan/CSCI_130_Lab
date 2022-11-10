<?php
// CSci 130 - Web Programming
if (isset($_POST["index"])) {
	/* if (is_int($_POST["index"])) {
		$index = $_POST["index"];
		// echo 'Index value='. $index .'<br>';
	}
	else
	{
		$index = -1;
		echo "not an int";
	}*/
	$index =(int)$_POST["index"];
	//echo 'Index value='. $index .'<br>';	
} 
else 
{
  $index = -1;
  //echo "no data supplied";
}

// Should add tests to avoid code injection !!
$myobj=$_POST["newdata"];
$myobj=json_decode($myobj);

if ($index!=-1) {
	// open and load the content of the database
	
	//$f = fopen("mydatabase.json","r");
	//$mydata=fgets($f);
	//fclose($f);
	
	$mydata=file_get_contents("mydatabase.json");
	
	// convert the string into JSON
	$mydata=json_decode($mydata);
	$l=count($mydata);
	//echo 'Number of elements '. $l; 
	if ($l>0) {
		if (($index>=0) && ($index<$l)) {		
			// update the content of the right index
			$mydata[$index]=$myobj;
			$mydata=json_encode($mydata,JSON_PRETTY_PRINT);
			$f = fopen("mydatabase.json","w");
			fwrite($f,$mydata);
			fclose($f);	
		}
	}
}
?>

