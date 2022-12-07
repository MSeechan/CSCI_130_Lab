<?php
include "create_class.php";
$conn = mysqli_connect("localhost", "myuser", "mypass", "new_db");

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error ."<br>");
} 



// get single record from db 
if (isset($_POST["Index"])) {
	$index =(int)$_POST["Index"];

	// Selection of data 
	$sql = " SELECT pkey, col1, col2, col3 FROM new_tbl WHERE pkey=". $index; 
	$result = $conn->query($sql);

	//if row exists from query, get it and assign row's col-name 
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$newClass=new NewClass();
			$newClass->id=($row["pkey"]);
			$newClass->col1=($row["col1"]);
			$newClass->col2=($row["col2"]);
			$newClass->col3=($row["col3"]);
			// each row becomes a class inst
		}

		$record = json_encode([$newClass]);
		echo $record;
	}else {
		$bad1=[ 'bad' => 1];
		echo json_encode($bad1);	
	}
}


// get entire tbl of movies
if (isset($_POST["get_all_records"])) {

	$sql = "SELECT COUNT(*) AS Total FROM new_tbl;";
	$result = $conn->query($sql);
	$total = $result->fetch_assoc();
	$total = $total["Total"];
	
	// Selection of data 
	$sql = "SELECT pkey, col1, col2, col3 FROM new_tbl";
	$result = $conn->query($sql);

   
	$i=0;
	$new_arr= Array();
	//if row exists from query, get it and assign row's col-name 
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
		$newClass=new NewClass();
		$newClass->id=($row["pkey"]);
		$newClass->col1=($row["col1"]);
		$newClass->col2=($row["col2"]);
		$newClass->col3=($row["col3"]);
		// each row becomes a class inst
		$new_arr[$i]=$newClass;
		$i+=1;
		}// send back array of classes and add total to the arr end
		$new_arr[$i]= $total;
		$all_ret_data = json_encode($new_arr);
		echo $all_ret_data;
	}else {
		$bad1=[ 'bad' => 1];
		echo json_encode($bad1);	
	}

	$conn->close();
}

?>