<?php
    // $servername = "localhost"; // default server name
    // $username = "mseechan"; // user name that you created
    // $password = "heIEUlFcaMTugj!K"; // password that you created
    // $dbname = "movies_db";
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'mseechan');
    define('DB_PASSWORD', 'heIEUlFcaMTugj!K');
    define('DB_NAME', 'movies_db'); 
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Create connection
    // $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error ."<br>");
    } 
?>