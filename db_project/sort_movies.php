<?php

        include "create_movie_class.php";
        include "connect_db.php";
        // $servername = "localhost"; 
        // $username = "mseechan"; 
        // $password = "heIEUlFcaMTugj!K"; 
        // $dbname = "movies_db";

        // // Create connection
        // $conn = new mysqli($servername, $username, $password, $dbname);

        // // Check connection
        // if ($conn->connect_error) {
        //     die("Connection failed: " . $conn->connect_error);
        // }

        $sql = "SELECT COUNT(*) AS Total FROM movies_tbl;";
        $result = $conn->query($sql);
        $total = $result->fetch_assoc();
        $total = $total["Total"];

        if (isset($_POST['Title'])){
            $sql = "SELECT pkey, title, year, length, rating, synopsis, recommended FROM movies_tbl ORDER BY title ASC";
        
        }
        if (isset($_POST['Index'])){
            $sql = "SELECT pkey, title, year, length, rating, synopsis, recommended FROM movies_tbl ORDER BY movies_tbl.pkey ASC";
        }
        $result = $conn->query($sql);

        // get the sort results back 
        $i=0;
	    $movies_arr= Array();
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
            $movies_arr[$i]=$newMovie;
            $i+=1;
        }
            $movies_arr[$i]= $total;
            $movies = json_encode($movies_arr);
            echo $movies;
        } else {
            echo "name sorting Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();

        // header("Location: http://localhost/mysite/db_project/movies.html");
        
    

?>