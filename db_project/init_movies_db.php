<?php
include "create_movie_class.php";

/* Create the database and movies_tbl. The table's column header types will be set 
and the fields will be populated using data from the json from previous labs. */
if(isset($_POST["init_db"])){
    $db_params = parse_ini_file("db_credentials.ini");
    define('DB_SERVER',  $db_params['server']);
    define('DB_USERNAME',  $db_params['username']);
    define('DB_PASSWORD',  $db_params['password']);

    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
    $db_name="movies_db";
    $sql = "CREATE DATABASE ".$db_name;
    if ($conn->query($sql) === TRUE) {
        echo "Database ". $db_name ." created successfully<br>";
    } else {
        echo "Error creating database: " . $conn->error ."<br>";
    }
    $conn->close();

    //open connection again with the newly created db
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, $db_name);

    // set table header types
    $sql = "CREATE TABLE movies_tbl (
    pkey INT(6) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title  VARCHAR(30) NOT NULL,
    year   INT(4) NOT NULL,
    length   VARCHAR(30) NOT NULL,
    rating  VARCHAR(5) NOT NULL,
    synopsis VARCHAR(1000) NOT NULL,
    recommended TINYINT(1) NOT NULL,
    img_path VARCHAR(100)
    )";

    // confirm table creation
    if ($conn->query($sql) === TRUE) {
        echo "Table Person created successfully<br>";
    } else {
        echo "Error creating table: " . $conn->error ."<br>";
    }

    // create column headers
    $stmt = $conn->prepare("INSERT INTO movies_tbl (title, year, length, rating, synopsis, recommended, img_path) VALUES (?,?,?,?,?,?,?)");
    if ($stmt==FALSE) {
        echo "There is a problem with prepare <br>";
        echo $conn->error; // Need to connect/reconnect before the prepare call otherwise it doesnt work
    }
    // bind parameters
    $stmt->bind_param("sisssis", $title, $year, $length, $rating, $synopsis, $recommended, $img_path);

    // load json data into table
    $json_str = file_get_contents('movies_data.json');
    $movies_arr = json_decode($json_str);
    $count = count($movies_arr);

    for ($i=0;$i<$count;$i++) {
        $title = $movies_arr[$i]->title;
        $year = $movies_arr[$i]->year;
        $length = $movies_arr[$i]->length;
        $rating = $movies_arr[$i]->rating;
        $synopsis =$movies_arr[$i]->synopsis;
        $recommended = $movies_arr[$i]->recommended;
        $img_path=$movies_arr[$i]->img_path;
        $stmt->execute();
        echo "New record ". $i ." created successfully<br>";
    }

    $stmt->close();

    // close the connection
    $conn->close();  
}  
?>
