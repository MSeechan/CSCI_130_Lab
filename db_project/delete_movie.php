<?php
    include "connect_db.php";

    // get id of current movie that matches pkey in db. access db and delete the row
    if (isset($_POST['movie_id'])){$input_movie_id = $_POST['movie_id'];};

    $sql = "DELETE FROM movies_tbl WHERE pkey = $input_movie_id";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
      } else {
        echo "delete movie Error: " . $sql . "<br>" . $conn->error;
      }
    $conn->close();

    header("Location:./movies.html");
?>
