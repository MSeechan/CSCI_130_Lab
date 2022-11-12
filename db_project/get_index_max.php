<?php 
include "create_movie.php";
 
if (isset($_GET["get_max"])){
        // open and load the content of the database
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
            
        $sql = "SELECT COUNT(*) AS Total FROM movies_tbl";
        $result = $conn->query($sql);
        $total = $result->fetch_assoc();
        $total = $total["Total"];
        echo ($total);

        $conn->close();
    }
?>