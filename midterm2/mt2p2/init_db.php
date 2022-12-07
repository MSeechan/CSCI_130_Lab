<?php
// db credentials
$db_server = "localhost";
$db_username="myuser";
$db_password="mypass";
$db_name="DB";

// connect to db 
$conn = mysqli_connect($db_server, $db_username, $db_password);



//-----------CREATE NEW DB
// sql str to build <db_name>
$sql = "CREATE DATABASE ".$db_name;
if ($conn->query($sql) === TRUE) {
    echo "Database ". $db_name ." created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error ."<br>";
}
$conn->close();



//-------------MAKE TABLE IN NEW DB
// open connection again with newly created db
$conn = mysqli_connect($db_server, $db_username, $db_password, $db_name);

// sql str to create tbl with headers


$sql = "CREATE TABLE house_tbl (
pkey INT(6) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
LivingSpace   INT(8) NOT NULL,
Beds   INT(4) NOT NULL,
Baths   VARCHAR(4) NOT NULL,
Zip   INT(5) NOT NULL
)";

// run tbl create str confirm table creation
if ($conn->query($sql) === TRUE) {
    echo "New Table created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error ."<br>";
}



// create column headers
$stmt = $conn->prepare("INSERT INTO house_tbl (LivingSpace, Beds, Baths, Zip) VALUES (?,?,?,?)");
if ($stmt==FALSE) {
	echo "There is a problem with prepare <br>";
	echo $conn->error; // Need to connect/reconnect before the prepare call otherwise it doesnt work
}
// bind parameters in prepare
$stmt->bind_param("iisi", $LivingSpace, $Beds, $Baths, $Zip);

// load json data into table
$json_str = file_get_contents('houses.json');
$data_arr = json_decode($json_str);
$count = count($data_arr);

// get json->data and put bind to stmt
for ($i=0;$i<$count;$i++) {
    $LivingSpace = $data_arr[$i]->{'Living Space (sq ft)'} ;
    $Beds = $data_arr[$i]->Beds;
    $Baths = $data_arr[$i]->Baths;
    $Zip = $data_arr[$i]->Baths;
    $stmt->execute();
    echo "New record ". $i ." created successfully<br>";
}

$stmt->close();

// close the connection
$conn->close();


?>
