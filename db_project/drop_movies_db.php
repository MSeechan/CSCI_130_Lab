<?php
include "connect_db.php";

// Drop the database
if(isset($_POST["drop_db"])){
    $db_name="movies_db";
    $sql = "DROP DATABASE ".$db_name;
    if ($conn->query($sql) === TRUE) {
        echo "Database ". $db_name ." created successfully<br>";
    } else {
        echo "Error creating database: " . $conn->error ."<br>";
    }
}
$conn->close();
?>
