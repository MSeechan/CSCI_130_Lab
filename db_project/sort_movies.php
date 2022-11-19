<?php
    include "connect_db.php";
    include "create_movie_class.php";
    
    $sql = "SELECT COUNT(*) AS Total FROM movies_tbl;";
    $result = $conn->query($sql);
    $total = $result->fetch_assoc();
    $total = $total["Total"];
    
    // sort by movie title
    if (isset($_POST['Title'])){
        $sql = "SELECT pkey, title, year, length, rating, synopsis, recommended, img_path FROM movies_tbl ORDER BY title ASC";
    
    }
    // sort by pkey/index
    if (isset($_POST['Index'])){
        $sql = "SELECT pkey, title, year, length, rating, synopsis, recommended, img_path FROM movies_tbl ORDER BY movies_tbl.pkey ASC";
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
        $newMovie->img_path=($row["img_path"]);
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
?>