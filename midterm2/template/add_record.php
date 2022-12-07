<?php
    $conn = mysqli_connect("localhost", "myuser", "mypass", "new_db");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error ."<br>");
    } 

  // take care of apostrophes and other special characters using mysqli_real_escape_string()
  if (isset($_POST['col1'])){$set_col1 = $_POST['col1'];};
  if (isset($_POST['col2'])){$set_col2 = $_POST['col2'];};
  if (isset($_POST['col3'])){$set_col3 = $_POST['col3'];};
  
  $sql = "INSERT INTO new_tbl VALUES (NULL, '$set_col1', '$set_col2', '$set_col3');"; 

  if ($conn->query($sql) === TRUE) {
      echo $set_title . " created successfully" ;
    } else {
      echo "add record Error: " . $sql . "<br>" . $conn->error;
    }
  $conn->close();
  header("Location: ./form.html");

?>