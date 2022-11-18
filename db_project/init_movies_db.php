<?php
include "create_movie_class.php";
include "connect_db.php";

/* Create the database and movies_tbl. The table's column header types will be set 
and the fields will be populated using data from the json from previous labs. */

// $sql = "CREATE DATABASE ". $dbname;
// if ($conn->query($sql) === TRUE) {
//     echo "Database ". $dbname ." created successfully<br>";
// } else {
//     echo "Error creating database: " . $conn->error ."<br>";
// }
// // close the connection
// $conn->close();

// set table header types
$sql = "CREATE TABLE movies_tbl (
pkey INT(6) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
title  VARCHAR(30) NOT NULL,
year   INT(4) NOT NULL,
length   VARCHAR(30) NOT NULL,
rating  FLOAT(2,1) NOT NULL,
synopsis VARCHAR(1000) NOT NULL,
recommended TINYINT NOT NULL,
img_path VARCHAR(100)
)";

// confirm table creation
if ($conn->query($sql) === TRUE) {
    echo "Table Person created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error ."<br>";
}

// create column headers
$stmt = $conn->prepare("INSERT INTO movies_tbl (title, year, length, rating, synopsis, recommended, img_path) VALUES (?,?,?,?,?,?,?)");
if ($stmt==FALSE) {
	echo "There is a problem with prepare <br>";
	echo $conn->error; // Need to connect/reconnect before the prepare call otherwise it doesnt work
}
// bind parameters
$stmt->bind_param("sisdsbs", $title, $year, $length, $rating, $synopsis, $recommended, $img_path);

// load json data into table
$json_str = file_get_contents('movies_data.json');
$movies_arr = json_decode($json_str);
$count = count($movies_arr);

for ($i=0;$i<$count;$i++) {
    $title = $movies_arr[$i]->title;
    $year = $movies_arr[$i]->year;
    $length = $movies_arr[$i]->length;
    $rating = $movies_arr[$i]->rating;
    $synopsis =$movies_arr[$i]->synopsis;
    $recommended=$movies_arr[$i]->recommended;
    $img_path=$movies_arr[$i]->img_path;
    $stmt->execute();
    echo "New record ". $i ." created successfully<br>";
}

$stmt->close();

// close the connection
$conn->close();


?>
