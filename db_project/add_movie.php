<?php
  include "connect_db.php";
  include "upload_file.php";

  // take care of apostrophes and other special characters using mysqli_real_escape_string()
  if (isset($_POST['title'])){$set_title = mysqli_real_escape_string($conn, $_POST['title']);};
  if (isset($_POST['year'])){$set_year = $_POST['year'];};
  if (isset($_POST['rating'])){$set_rating = $_POST['rating'];};
  if (isset($_POST['length'])){$set_length = $_POST['length'];};
  if (isset($_POST['recommended'])){$set_recommended = $_POST['recommended'];};
  if (isset($_POST['movie_id'])){$set_movie_id = $_POST['movie_id'];};
  if (isset($_POST['synopsis'])){$set_synopsis = mysqli_real_escape_string($conn, $_POST['synopsis']);};

  $input_path = basename($_FILES["img_path"]["name"]);

  $sql = "SELECT img_path AS Img_path FROM movies_tbl WHERE pkey = $set_movie_id";
  $result = $conn->query($sql);
  $curr_img = $result->fetch_assoc();
  $curr_img = $curr_img["Img_path"];

  // no img chosen
  if($input_path == NULL){
    $set_img_path = NULL;
  }
  // if img chosen, but already exists in the local folder or it was uploaded correctly
  else if(file_exists('assets/'.$input_path) || $uploadOk == 1){
    echo '<br> img already in folder or it was uploaded correctly:'.'assets/'.$input_path.'<br>';
    $set_img_path = 'assets/'.$input_path;
  }
  else{
    // img to folder upload failed
    if ($uploadOk == 0){echo ($message);} 
  }

  $sql = "INSERT INTO movies_tbl VALUES (NULL, '$set_title', '$set_year', '$set_length', '$set_rating', '$set_synopsis', '$set_recommended', '$set_img_path');"; 

  if ($conn->query($sql) === TRUE) {
      echo $set_title . " created successfully" ;
    } else {
      echo "add movie Error: " . $sql . "<br>" . $conn->error;
    }
  $conn->close();
  header("Location: ./movies.html");

?>