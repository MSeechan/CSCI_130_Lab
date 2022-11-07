<?php
    // check if input was set, update to new value. if not, don't replace
    if($_POST['title']){$set_title = $_POST['title'];};
    if($_POST['year']){$set_year = $_POST['year'];};
    if($_POST['rating']){$set_rating = $_POST['rating'];};
    if($_POST['length']){$set_length = $_POST['length'];};
    if($_POST['recommended']){$set_recommended = $_POST['recommended'];};
    if($_POST['synopsis']){$set_synopsis = $_POST['synopsis'];};
    $id = $_POST['movie_id']; // movie id will not change
   
    $recv_json = file_get_contents('movies_data.json');  
    $json_arr = json_decode($recv_json);
    
    // loop through json array to find matching movie id, then update the json with new form data
    foreach ($json_arr as $movie){
        if($movie->movie_id == $id){
            $movie->title = $set_title;   
            $movie->year = $set_year;
            $movie->length = $set_length;
            $movie->rating = $set_rating;
            $movie->recommended = $set_recommended;
            $movie->synopsis = $set_synopsis; 
            // $json_str =  $movie->title.' '.$movie->year.' '.$movie->rating.' '.$movie->length.' '.$movie->synopsis.' '.$id;  
            // echo $json_str;        
        }
    }
    // write to (filename, encoded json)
    file_put_contents('movies_data.json', json_encode($json_arr));
    // reroute to the same site after saving the updated movie data
    header("Location: http://localhost/mysite/db_project/movies.html");

    


?>