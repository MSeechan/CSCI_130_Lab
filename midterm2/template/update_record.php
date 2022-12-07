<?php
    $conn = mysqli_connect("localhost", "myuser", "mypass", "new_db");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error ."<br>");
    } 

    // get form post inputs
    if (isset($_POST['col1'])){$set_col1 = $_POST['col1'];};
    if (isset($_POST['col2'])){$set_col2 = $_POST['col2'];};
    if (isset($_POST['col3'])){$set_col3 = $_POST['col3'];};
    if (isset($_POST['id'])){$set_id = $_POST['id'];};

    $sql = "UPDATE new_tbl SET col1 ='$set_col1', col2='$set_col2', col3='$set_col3' WHERE pkey = $set_id";
    
    if ($conn->query($sql) === TRUE) {
      echo $set_col1 . " record updated successfully";
    } else {
        echo "add_item Error: " . $sql . "<br>" . $conn->error;
    }
  
    $conn->close();
    header("Location: ./form.html");
?>