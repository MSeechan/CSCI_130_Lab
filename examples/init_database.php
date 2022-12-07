<?php
// CSci 130 - Web Programming

// Initialize the database

// Include the definition of the class person and student
include 'student.php';

echo "Create some students<br>";
$n=10;
$a0=array();
for ($i=0;$i<$n;$i++) {
	$a0[$i]=new Student();
}

$servername = "localhost"; // default server name
$username = "hubert"; // user name that you created
$password = "Rc8piTPGijEkPKds"; // password that you created
$dbname = "myDB1";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error ."<br>");
} 
echo "Connected successfully <br>";

// Creation of the database
$sql = "CREATE DATABASE ". $dbname;
if ($conn->query($sql) === TRUE) {
    echo "Database ". $dbname ." created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error ."<br>";
}

// close the connection
$conn->close();
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// $lvar=get_object_vars($a0[0]);
// print_r ($lvar);

	
$sql = "CREATE TABLE Student (
pkey INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 

first_name  VARCHAR(30) NOT NULL,
last_name   VARCHAR(30) NOT NULL,
dob VARCHAR(20) NOT NULL,
address VARCHAR(100) NOT NULL,
id INT(10) NOT NULL,
current_gpa FLOAT(2,1) NOT NULL,
current_units TINYINT NOT NULL,
reg_date TIMESTAMP
)";


if ($conn->query($sql) === TRUE) {
    echo "Table Person created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error ."<br>";
}


$stmt = $conn->prepare("INSERT INTO Student (first_name, last_name, dob, address, id ,current_gpa, current_units) VALUES (?,?,?,?,?,?,?)");
if ($stmt==FALSE) {
	echo "There is a problem with prepare <br>";
	echo $conn->error; // Need to connect/reconnect before the prepare call otherwise it doesnt work
}
$stmt->bind_param("ssssidi", $firstname, $lastname,$dob,$address,$id, $current_gpa,$current_units);

for ($i=0;$i<$n;$i++) {
// set parameters and execute
$firstname = $a0[$i]->GetFirstName();
$lastname = $a0[$i]->GetLastName();
$dob = $a0[$i]->GetDOB();
$address=$a0[$i]->address; 
$id=$a0[$i]->GetID();
$current_gpa=$a0[$i]->GetGPA();
$current_units=$a0[$i]->current_units;
$stmt->execute();
echo "New record ". $i ." created successfully<br>";
}

$stmt->close();

// close the connection
$conn->close();


?>