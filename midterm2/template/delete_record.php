<?php
    $conn = mysqli_connect("localhost", "myuser", "mypass", "new_db");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error ."<br>");
    } 

    // get id of current record that matches pkey in db. access db and delete the row
    if (isset($_POST['id'])){$input_id = $_POST['id'];};

    $sql = "DELETE FROM new_tbl WHERE pkey = $input_id";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
      } else {
        echo "delete movie Error: " . $sql . "<br>" . $conn->error;
      }
    $conn->close();

    header("Location:./form.html");
?>
