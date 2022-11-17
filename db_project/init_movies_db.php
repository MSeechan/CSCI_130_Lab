<?php
include "create_movie_class.php";
$servername = "localhost"; // default server name
$username = "mseechan"; // user name that you created
$password = "heIEUlFcaMTugj!K"; // password that you created
$dbname = "movies_db";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error ."<br>");
} 
echo "Connected successfully <br>";

//Create the database
/*
$sql = "CREATE DATABASE ". $dbname;
if ($conn->query($sql) === TRUE) {
    echo "Database ". $dbname ." created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error ."<br>";
}
*/

// close the connection
$conn->close();


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


//create str to create table w/col headers

$sql = "CREATE TABLE movies_tbl (
pkey INT(6) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
title  VARCHAR(30) NOT NULL,
year   INT(4) NOT NULL,
length   VARCHAR(30) NOT NULL,
rating  FLOAT(2,1) NOT NULL,
synopsis VARCHAR(1000) NOT NULL,
recommended TINYINT NOT NULL,
img_path VARCHAR(100) NOT NULL
)";

// confirm table creation
if ($conn->query($sql) === TRUE) {
    echo "Table Person created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error ."<br>";
}



// create column headers
$stmt = $conn->prepare("INSERT INTO movies_tbl (title, year, length, rating, synopsis, recommended, img_path) VALUES (?,?,?,?,?,?,?)");
// $stmt = $conn->prepare("INSERT INTO movies_tbl (title, year, length, rating, synopsis, recommended, movie_id) VALUES (?,?,?,?,?,?,?)");
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
    
    // $movie = new Movie();
    $title = $movies_arr[$i]->title;
    $year = $movies_arr[$i]->year;
    $length = $movies_arr[$i]->length;
    $rating = $movies_arr[$i]->rating;
    $synopsis =$movies_arr[$i]->synopsis;
    $recommended=$movies_arr[$i]->recommended;
    $img_path=$movies_arr[$i]->img_path;


    // set parameters and execute
    // $title = $movie->title;
    // $year = $movie->year;
    // $length = $movie->length;
    // $rating = $movie->rating;
    // $synopsis = $movie->synopsis;
    // $recommended=$movie->recommended;
    // $movie_id=$movie->movie_id;
    $stmt->execute();
    echo "New record ". $i ." created successfully<br>";
}

$stmt->close();

// close the connection
$conn->close();


?>
