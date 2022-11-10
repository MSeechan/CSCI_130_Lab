<?php
// CSci 130 - Web Programming

// Check the variable sent by the client
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
else {
  $index = -1;
  //echo "no data supplied";
}

if ($index!=-1) {
	// Open and load the content of the database
	
	// if the whole object is in a single line
	//$f = fopen("mydatabase.json","r"); // READ
	//$mydata=fgets($f);
	//fclose($f);
	
	$mydata=file_get_contents("mydatabase.json");
	
	// convert the string into JSON object
	$mydata=json_decode($mydata);
	$l=count($mydata); // number of elements in the collection
	//echo 'Number of elements '. $l; 
	if ($l>0) { // there is at least an element in the exsisting collection
		if (($index>=0) && ($index<$l)) // the element we want to access is present
			echo json_encode($mydata[$index],JSON_PRETTY_PRINT);
		else {
			$bad1=[ 'bad' => 1];
			echo json_encode($bad1,JSON_PRETTY_PRINT); // we return something anyways, it is up to the client to interpret the problem (there is no first name)
		}
	}
}
?>