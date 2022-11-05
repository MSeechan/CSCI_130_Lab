<?php
    isset($_POST['title'])? $set_title = $_POST['title']:$set_title ='';
    isset($_POST['year'])? $set_year = $_POST['year']:$set_year ='';
    isset($_POST['rating'])? $set_rating = $_POST['rating']:$set_rating ='';
    isset($_POST['length'])? $set_length = $_POST['length']:$set_length ='';
    isset($_POST['recommended'])? $set_recommended = $_POST['recommended']:$set_recommended ='';
    isset($_POST['synopsis'])? $set_synopsis = $_POST['synopsis']:$set_synopsis ='';
    $id = $_POST['movie_id'];
   
    $recv_json = file_get_contents('movies_data.json');  
    $json_arr = json_decode($recv_json);
    
    foreach ($json_arr as $movie){
        if($movie->movie_id == $id){
            $movie->title = $set_title;   
            $movie->year = $set_year;
            $movie->length = $set_length;
            $movie->rating = $set_rating;
            $movie->recommended = $set_recommended;
            $movie->synopsis = $set_synopsis; 
            // $json_str =  $movie->title.' '.$movie->year.' '.$movie->rating.' '.$movie->length.' '.$movie->synopsis.' '.$id;           
        }
    }
    
    file_put_contents('movies_data.json', json_encode($json_arr));
    header("Location: http://localhost/mysite/Lab_9/movies.html");

    


?>