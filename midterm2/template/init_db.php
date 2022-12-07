<?php
// db credentials
$db_server = "localhost";
$db_username="myuser";
$db_password="mypass";
$db_name="new_db";

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
$sql = "CREATE TABLE new_tbl (
pkey INT(6) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
col1  VARCHAR(30) NOT NULL,
col2   INT(4) NOT NULL,
col3   VARCHAR(30) NOT NULL
)";

// run tbl create str confirm table creation
if ($conn->query($sql) === TRUE) {
    echo "New Table created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error ."<br>";
}

// create column headers
$stmt = $conn->prepare("INSERT INTO new_tbl (col1, col2, col3) VALUES (?,?,?)");
if ($stmt==FALSE) {
	echo "There is a problem with prepare <br>";
	echo $conn->error; // Need to connect/reconnect before the prepare call otherwise it doesnt work
}
// bind parameters in prepare
$stmt->bind_param("sis", $col1, $col2, $col3);

// load json data into table
$json_str = file_get_contents('json_data.json');
$data_arr = json_decode($json_str);
$count = count($data_arr);

// get json->data and put bind to stmt
for ($i=0;$i<$count;$i++) {
    $col1 = $data_arr[$i]->col1;
    $col2 = $data_arr[$i]->col2;
    $col3 = $data_arr[$i]->col3;
    $stmt->execute();
    echo "New record ". $i ." created successfully<br>";
}

$stmt->close();

// close the connection
$conn->close();


?>
