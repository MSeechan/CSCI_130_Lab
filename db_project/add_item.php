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
    // $recv_json = file_get_contents('movies_data.json');  
    // $json_arr = json_decode($recv_json);
    // $last_obj = end($json_arr);
    // $last_id = $last_obj->id;
    // check if input was set, update to new value. if not, don't replace

    $sql = "SELECT COUNT(*) AS Total FROM movies_tbl";
    $result = $conn->query($sql);
    $total = $result->fetch_assoc();
    $movie_id = $total["Total"];
    // echo $total;
  
    
    if (isset($_POST['title'])){$set_title = $_POST['title'];};
    if (isset($_POST['year'])){$set_year = $_POST['year'];};
    if (isset($_POST['rating'])){$set_rating = $_POST['rating'];};
    if (isset($_POST['length'])){$set_length = $_POST['length'];};
    if (isset($_POST['recommended'])){$set_recommended = $_POST['recommended'];};
    if (isset($_POST['synopsis'])){$set_synopsis = $_POST['synopsis'];};
   
    // $sql = 'INSERT INTO movies_tbl VALUES ("title", "set_year","set_length", "set_rating", "set_synopsis", "set_recommended","movie_id")'; 
    $sql = "INSERT INTO movies_tbl VALUES ('9','$set_title', '$set_year', '$set_length', '$set_rating', '$set_synopsis', '$set_recommended', '$movie_id')"; 
    
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "OH NO Error: " . $sql . "<br>" . $conn->error;
      }
    $conn->close();
?>