<?php
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

    if (isset($_POST['movie_id'])){$input_movie_id = $_POST['movie_id'];};

    $sql = "DELETE FROM movies_tbl WHERE pkey = $input_movie_id";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
      } else {
        echo "add_item Error: " . $sql . "<br>" . $conn->error;
      }
    $conn->close();

    header("Location: http://localhost/mysite/db_project/movies.html");
?>
