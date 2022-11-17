<?php
include "create_movie_class.php";

// open and load the content of the database
$servername = "localhost"; 
$username = "mseechan"; 
$password = "heIEUlFcaMTugj!K"; 
$dbname = "movies_db";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 

// get single movie from db 
if (isset($_POST["Index"])) {
	$index =(int)$_POST["Index"];


	// Selection of data 
	$sql = "SELECT pkey, title, year, length, rating, synopsis, recommended, img_path FROM movies_tbl WHERE pkey=". $index;
	// $sql = "SELECT title, year, length, rating, synopsis, recommended, movie_id FROM movies_tbl WHERE pkey=". $index;
	$result = $conn->query($sql);

   
	//if row exists from query, get it and assign row's col-name 
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
		$newMovie=new Movie();
		$newMovie->movie_id=($row["pkey"]);
		$newMovie->title=($row["title"]);
		$newMovie->year=($row["year"]);
		$newMovie->length=($row["length"]);
		$newMovie->rating=($row["rating"]);
		$newMovie->synopsis=$row["synopsis"];
		$newMovie->recommended=($row["recommended"]);
		$newMovie->img_path=($row["img_path"]);
		}

		$movie = json_encode([$newMovie]);
		echo $movie;
	}else {
		$bad1=[ 'bad' => 1];
		echo json_encode($bad1);	
	}
}

// get entire db of movies
if (isset($_POST["array"])) {

	$sql = "SELECT COUNT(*) AS Total FROM movies_tbl;";
	$result = $conn->query($sql);
	$total = $result->fetch_assoc();
	$total = $total["Total"];
	
	// Selection of data 
	$sql = "SELECT pkey, title, year, length, rating, synopsis, recommended, img_path FROM movies_tbl";
	$result = $conn->query($sql);

   
	$i=0;
	$movies_arr= Array();
	//if row exists from query, get it and assign row's col-name 
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
		$newMovie=new Movie();
		$newMovie->movie_id=($row["pkey"]);
		$newMovie->title=($row["title"]);
		$newMovie->year=($row["year"]);
		$newMovie->length=($row["length"]);
		$newMovie->rating=($row["rating"]);
		$newMovie->synopsis=$row["synopsis"];
		$newMovie->recommended=($row["recommended"]);
		$newMovie->img_path=($row["img_path"]);
		$movies_arr[$i]=$newMovie;
		$i+=1;
		}
		$movies_arr[$i]= $total;
		$movies = json_encode($movies_arr);
		echo $movies;
	}else {
		$bad1=[ 'bad' => 1];
		echo json_encode($bad1);	
	}

	$conn->close();
}

?>