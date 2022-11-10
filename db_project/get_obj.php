<?php
include "init_movies.php";
$index=$_GET['index'];


if ($index!=-1) {
	// open and load the content of the database
	$servername = "localhost"; // default server name
	$username = "mseechan"; // user name that you created
	$password = "heIEUlFcaMTugj"; // password that you created
	$dbname = "myMoviesDB";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
		
    
    $sql = "SELECT COUNT (*) AS Total FROM moviesDB;
    $result = $conn->query($sql);
    $total = result->fetch _assoc();
    $total = $total["Total"];
    echo $total;

	// Selection of data 
	$sql = "SELECT title, year, length, synopsis, recommended, movie_id  FROM moviesDB WHERE pkey=". $index;
	// $sql = "SELECT title, year, length, synopsis, recommended, movie_id  FROM moviesDB;
	$result = $conn->query($sql);



    $arr = Array();
    $i=0;


	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc(); 
		
		$newMovie=new Movie();
		$newMovie->title=($row["title"]);
		$newMovie->year=($row["year"]);
		$newMovie->length=($row["length"]);
		$newMovie->synopsis=$row["synopsis"];
		$newMovie->recommended=($row["recommended"]);
		$newMovie->movie_id=($row["movie_id"]);
		$arr[i] = $newMovie;
		$i+=1;
		echo json_encode($arr);
	} else {
		$bad1=[ 'bad' => 1];
		echo json_encode($bad1);	
	}
    }
   
    
?>