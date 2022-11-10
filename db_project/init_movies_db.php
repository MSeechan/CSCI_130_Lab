<?php
include "create_movie.php";
$servername = "localhost"; // default server name
$username = "mseechan"; // user name that you created
$password = "heIEUlFcaMTugj!K"; // password that you created
$dbname = "movies_DB";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error ."<br>");
} 
echo "Connected successfully <br>";

// Creation of the database
// $sql = "CREATE DATABASE ". $dbname;
// if ($conn->query($sql) === TRUE) {
//     echo "Database ". $dbname ." created successfully<br>";
// } else {
//     echo "Error creating database: " . $conn->error ."<br>";
// }

// close the connection
$conn->close();




// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


//create table with all fields
$sql = "CREATE TABLE movies_tbl (
pkey INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
title  VARCHAR(30) NOT NULL,
year   VARCHAR(30) NOT NULL,
length   VARCHAR(30) NOT NULL,
rating VARCHAR(30) NOT NULL,
synopsis VARCHAR(30) NOT NULL,
recommended VARCHAR(30) NOT NULL,
movie_id VARCHAR(30) NOT NULL
-- title  VARCHAR(30) NOT NULL,
-- year   INT(4) NOT NULL,
-- length   VARCHAR(10) NOT NULL,
-- rating FLOAT(2,1) NOT NULL,
-- synopsis VARCHAR(500) NOT NULL,
-- recommended BOOLEAN(2) NOT NULL,
-- movie_id INT(50) NOT NULL
)";


// if ($conn->query($sql) === TRUE) {
//     echo "Table Person created successfully<br>";
// } else {
//     echo "Error creating table: " . $conn->error ."<br>";
// }



$stmt = $conn->prepare("INSERT INTO movies_tbl (title, year, length, rating, synopsis, recommended, movie_id) VALUES (?,?,?,?,?,?,?)");
if ($stmt==FALSE) {
	echo "There is a problem with prepare <br>";
	echo $conn->error; // Need to connect/reconnect before the prepare call otherwise it doesnt work
}
$stmt->bind_param("sssssss", $title, $year, $length, $rating, $synopsis, $recommended, $movie_id);
$n=5;
for ($i=0;$i<$n;$i++) {
    $movie = new Movie();
    echo $movie->Display() .  "<br>";
    
// set parameters and execute
$title = $movie->title;
$year = $movie->year;
$length = $movie->length;
$rating = $movie->rating;
$synopsis = $movie->synopsis;
$recommended=$movie->recommended;
$movie_id=$movie->movie_id;
$stmt->execute();
echo "New record ". $i ." created successfully<br>";
}

$stmt->close();

// close the connection
$conn->close();


?>