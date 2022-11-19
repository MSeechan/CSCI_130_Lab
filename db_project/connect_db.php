<?php
    $db_params = parse_ini_file("db_credentials.ini");
    define('DB_SERVER',  $db_params['server']);
    define('DB_USERNAME',  $db_params['username']);
    define('DB_PASSWORD',  $db_params['password']);
    define('DB_NAME',  $db_params['dbname']); 
    
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error ."<br>");
    } 
?>