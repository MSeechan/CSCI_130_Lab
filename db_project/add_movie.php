<?php
  include "connect_db.php";
  include "upload_file.php";

  // take care of apostrophes and other special characters using mysqli_real_escape_string()
  if (isset($_POST['title'])){$set_title = mysqli_real_escape_string($conn, $_POST['title']);};
  if (isset($_POST['year'])){$set_year = $_POST['year'];};
  if (isset($_POST['rating'])){$set_rating = $_POST['rating'];};
  if (isset($_POST['length'])){$set_length = $_POST['length'];};
  if (isset($_POST['recommended'])){$set_recommended = $_POST['recommended'];};
  if (isset($_POST['synopsis'])){$set_synopsis = mysqli_real_escape_string($conn, $_POST['synopsis']);};

  // ternary to check if image is selected when adding a record
  basename($_FILES["img_path"]["name"] == NULL) ? $set_img_path = NULL : $set_img_path = 'assets/'.basename($_FILES["img_path"]["name"]);

  $sql = "INSERT INTO movies_tbl VALUES (NULL, '$set_title', '$set_year', '$set_length', '$set_rating', '$set_synopsis', '$set_recommended', '$set_img_path');"; 

  if ($conn->query($sql) === TRUE) {
      echo $set_title . " created successfully" ;
    } else {
      echo "add movie Error: " . $sql . "<br>" . $conn->error;
    }
  $conn->close();
  header("Location: ./movies.html");

?>