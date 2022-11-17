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

    if (isset($_POST['title'])){$input_title = $_POST['title'];};
    if (isset($_POST['year'])){$input_year = $_POST['year'];};
    if (isset($_POST['rating'])){$input_rating = $_POST['rating'];};
    if (isset($_POST['length'])){$input_length = $_POST['length'];};
    if (isset($_POST['recommended'])){$input_rec = $_POST['recommended'];};
    if (isset($_POST['synopsis'])){$input_synopsis = $_POST['synopsis'];};
    if (isset($_POST['movie_id'])){$input_movie_id = $_POST['movie_id'];};

    $sql = "UPDATE movies_tbl SET title ='$input_title', year='$input_year', rating='$input_rating', length='$input_length', recommended='$input_rec', synopsis='$input_synopsis' WHERE pkey = $input_movie_id";

    if ($conn->query($sql) === TRUE) {
        echo $input->title . " record updated successfully";
      } else {
        echo "add_item Error: " . $sql . "<br>" . $conn->error;
      }
    $conn->close();

    // header("Location: http://localhost/mysite/db_project/movies.html");
    header("Location: ./movies.html");

?>