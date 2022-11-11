<?php
include "create_movie.php";

// if (isset($_POST["Index"])) {
// 	$index =(int)$_POST["Index"];

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
		
	// Selection of data 
	$sql = "SELECT title, year, length, rating, synopsis, recommended, movie_id FROM movies_tbl";
	// -- WHERE pkey=". $index;
	$result = $conn->query($sql);

   
	$i=0;
	$movies_arr= Array();
	//if row exists from query, get it and assign row's col-name 
	if ($result->num_rows > 0) {
		echo('result found:  ');
		while($row = $result->fetch_assoc()) {
		$newMovie=new Movie();
		$newMovie->title=($row["title"]);
		$newMovie->year=($row["year"]);
		$newMovie->length=($row["length"]);
		$newMovie->rating=($row["rating"]);
		$newMovie->synopsis=$row["synopsis"];
		$newMovie->recommended=($row["recommended"]);
		$newMovie->movie_id=($row["movie_id"]);
		$movies_arr[$i]=$newMovie;
		$i+=1;
		
		}

		$response = json_encode($movies_arr);
		echo $response;
	}else {
		$bad1=[ 'bad' => 1];
		echo json_encode($bad1);	
	}
// }


    
   
    
?>