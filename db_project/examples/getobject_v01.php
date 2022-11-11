<?php

include "student.php";

$index=1;


if ($index!=-1) {
	// open and load the content of the database
	$servername = "localhost"; // default server name
		$username = "root"; // user name that you created
		$password = ""; // password that you created
		$dbname = "db";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
		
	// Selection of data 
	$sql = "SELECT first_name, last_name, dob, address, id, current_gpa, current_units  FROM Student WHERE pkey=". $index;
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		$row = $result->fetch_assoc(); // Fetch a result row as an associative array
		
		$newstudent=new Student();
		$newstudent->SetFirstName($row["first_name"]);
		$newstudent->SetLastName($row["last_name"]);
		$newstudent->SetDOB($row["dob"]);
		$newstudent->address=$row["address"];
		$newstudent->SetID($row["last_name"]);
		$newstudent->SetGPA($row["current_gpa"]);
		$newstudent->current_units=$row["current_units"];
		
		echo json_encode($newstudent);
	} else {
		$bad1=[ 'bad' => 1];
		echo json_encode($bad1);	
	}
}

?>